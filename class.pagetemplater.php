<?php

/**
 * Class PageTemplater, adds page templates from a plugin.
 */
class PageTemplater {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();

		/**
		 * Add a filter to the attributes metabox to inject template into the cache.
		 */
		add_filter(
			'page_attributes_dropdown_pages_args',
			array( $this, 'register_project_templates' )
		);


		/**
		 * Add a filter to the save post to inject out template into the page cache.
		 */
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		/**
		 * Add a filter to the template include to determine
		 * if the page has our template assigned and return it's path.
		 */
		add_filter(
			'template_include',
			array( $this, 'view_project_template' )
		);


		/**
		 * Add your templates to this array.
		 */
		$this->templates = array(
			'page-books.php' => '"Books" page template',
		);

	}

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		}

		return self::$instance;

	}

	/**
	 * Merge the existing page templates cache with our new entries,
	 * then re-insert the whole page template cache into WordPress’s system.
	 */
	public function register_project_templates( $atts ) {

		/**
		 * Create the key used for the themes cache.
		 */
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		/**
		 * Retrieve the cache list.
		 * If it doesn't exist, or it's empty prepare an array.
		 */
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		/**
		 * New cache, therefore remove the old one
		 */
		wp_cache_delete( $cache_key, 'themes' );

		/**
		 * Now add our template to the list of templates by merging our templates
		 * with the existing templates array from the cache.
		 */
		$templates = array_merge( $templates, $this->templates );

		/**
		 * Add the modified cache to allow WordPress to pick it up
		 * for listing available templates.
		 */
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page.
	 */
	public function view_project_template( $template ) {

		if ( is_page() ) {
			global $post;

			if ( ! isset( $this->templates[get_post_meta( $post->ID, '_wp_page_template', true )] ) ) {
				return $template;
			}

			$file = plugin_dir_path( __FILE__ ) . 'templates/' . get_post_meta(
					$post->ID, '_wp_page_template', true
				);

			/**
			 * Just to be safe, we check if the file exist first.
			 */
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}

			return $template;
		}

		return $template;

	}

}

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );