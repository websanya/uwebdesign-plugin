<?php

/**
 * Class Taxonomier, adds custom taxonomies.
 * Class PostTyper, adds custom post types.
 */
class Taxonomier {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of post types that this plugin registers.
	 */
	protected $taxonomies;

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->taxonomies = array(
			'video_type'         => array(
				'post_type' => 'videos',
				'args'      => array(
					'labels'            => array(
						'name'                       => 'Жанры',
						'singular_name'              => 'Жанр',
						'menu_name'                  => 'Жанры',
						'all_items'                  => 'Все жанры',
						'edit_item'                  => 'Редактировать жанр',
						'view_item'                  => 'Просмотреть жанр',
						'update_item'                => 'Обновить жанр',
						'add_new_item'               => 'Добавить новый жанр',
						'new_item_name'              => 'Название нового жанра',
						'parent_item'                => 'Родительский жанр',
						'parent_item_colon'          => 'Родительский жанр:',
						'search_items'               => 'Искать жанры',
						'popular_items'              => 'Популярные жанры',
						'separate_items_with_commas' => 'Разделите жанры запятыми',
						'add_or_remove_items'        => 'Добавить или удалить жанр',
						'choose_from_most_used'      => 'Выберите из самых используемых жанров',
						'not_found'                  => 'Жанры не найдены',
					),
					'public'            => true,
					'show_admin_column' => true,
					'hierarchical'      => true,
					'description'       => 'Жанры выкладываемых видосов.',
					'rewrite'           => array(
						'slug' => 'video-type',
					),
				),
			),
			'book_publisher'        => array(
				'post_type' => 'books',
				'args'      => array(
					'labels'            => array(
						'name'                       => 'Издательства',
						'singular_name'              => 'Издательство',
						'menu_name'                  => 'Издательства',
						'all_items'                  => 'Все издательства',
						'edit_item'                  => 'Редактировать издательство',
						'view_item'                  => 'Просмотреть издательство',
						'update_item'                => 'Обновить издательство',
						'add_new_item'               => 'Добавить новое издательство',
						'new_item_name'              => 'Название нового издательства',
						'parent_item'                => 'Родительское издательство',
						'parent_item_colon'          => 'Родительское издательство:',
						'search_items'               => 'Искать издательства',
						'popular_items'              => 'Популярные издательства',
						'separate_items_with_commas' => 'Разделите издательства запятыми',
						'add_or_remove_items'        => 'Добавить или удалить издательства',
						'choose_from_most_used'      => 'Выберите из самых используемых издательств',
						'not_found'                  => 'Издательства не найдены',
					),
					'public'            => true,
					'show_admin_column' => true,
					'hierarchical'      => false,
					'description'       => 'Издательства, которые печатают и издают выложенные книги.',
					'rewrite'           => array(
						'slug' => 'book-publisher',
					),
				),
			),
			'testimonial_source' => array(
				'post_type' => 'testimonials',
				'args'      => array(
					'labels'            => array(
						'name'                       => 'Источники',
						'singular_name'              => 'Источник',
						'menu_name'                  => 'Источники',
						'all_items'                  => 'Все источники',
						'edit_item'                  => 'Редактировать источник',
						'view_item'                  => 'Просмотреть источник',
						'update_item'                => 'Обновить источник',
						'add_new_item'               => 'Добавить новый источник',
						'new_item_name'              => 'Название нового источника',
						'parent_item'                => 'Родительский источник',
						'parent_item_colon'          => 'Родительский источник:',
						'search_items'               => 'Искать источники',
						'popular_items'              => 'Популярные источники',
						'separate_items_with_commas' => 'Разделите источники запятыми',
						'add_or_remove_items'        => 'Добавить или удалить источник',
						'choose_from_most_used'      => 'Выберите из самых используемых источников',
						'not_found'                  => 'Источники не найдены',
					),
					'public'            => true,
					'show_admin_column' => true,
					'hierarchical'      => true,
					'description'       => 'Издательства, которые печатают и издают выложенные книги.',
					'rewrite'           => array(
						'slug' => 'testimonial-source',
					),
				),
			),
		);

		foreach ( $this->taxonomies as $taxonomy => $array ) {
			register_taxonomy( $taxonomy, $array['post_type'], $array['args'] );
		}

	}

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new Taxonomier();
		}

		return self::$instance;

	}

}

class PostTyper {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of post types that this plugin registers.
	 */
	protected $post_types;

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->post_types = array(
			'videos'       => array(
				'label'       => 'Видео',
				'labels'      => array(
					'name'                  => 'Видео',
					'singular_name'         => 'Видео',
					'add_new'               => 'Добавить новое',
					'add_new_item'          => 'Добавить новое видео',
					'edit_item'             => 'Редактировать видео',
					'new_item'              => 'Новое видео',
					'view_item'             => 'Просмотреть видео',
					'search_items'          => 'Искать видео',
					'not_found'             => 'Видео не найдены.',
					'not_found_in_trash'    => 'Видео в корзине не найдены.',
					'parent_item_colon'     => 'Родительское видео:',
					'all_items'             => 'Все видео',
					'archives'              => 'Архив видео',
					'insert_into_item'      => 'Вставить в видео',
					'uploaded_to_this_item' => 'Добавлено в это видео',
					'name_admin_bar'        => 'Видео',
				),
				'description' => 'Видео, которые мы заливаем на YouTube.',
				'public'      => true,
				'has_archive' => true,
				'menu_icon'   => 'dashicons-video-alt',
				'supports'    => array( 'title', 'editor', 'author', 'comments', 'thumbnail' ),
				'taxonomies'  => array( 'post_tag' ),
			),
			'weeklies'      => array(
				'label'       => 'Еженедельники',
				'labels'      => array(
					'name'                  => 'Еженедельники',
					'singular_name'         => 'Еженедельник',
					'add_new'               => 'Добавить новый',
					'add_new_item'          => 'Добавить новый еженедельник',
					'edit_item'             => 'Редактировать еженедельник',
					'new_item'              => 'Новый еженедельник',
					'view_item'             => 'Просмотреть еженедельник',
					'search_items'          => 'Искать еженедельники',
					'not_found'             => 'Еженедельники не найдены.',
					'not_found_in_trash'    => 'Еженедельники в корзине не найдены.',
					'parent_item_colon'     => 'Родительский еженедельник:',
					'all_items'             => 'Все еженедельники',
					'archives'              => 'Архив еженедельников',
					'insert_into_item'      => 'Вставить в еженедельник',
					'uploaded_to_this_item' => 'Добавлено в этот еженедельник',
					'name_admin_bar'        => 'Еженедельник',
				),
				'description' => 'Еженедельники, в которых находится только самое лучшее.',
				'public'      => true,
				'has_archive' => true,
				'menu_icon'   => 'dashicons-calendar',
				'supports'    => array( 'title', 'editor', 'author', 'comments', 'thumbnail' ),
				'taxonomies'  => array( 'post_tag' ),
			),
			'books'        => array(
				'label'       => 'Книги',
				'labels'      => array(
					'name'                  => 'Книги',
					'singular_name'         => 'Книга',
					'add_new'               => 'Добавить новую',
					'add_new_item'          => 'Добавить новую книгу',
					'edit_item'             => 'Редактировать книгу',
					'new_item'              => 'Новая книга',
					'view_item'             => 'Просмотреть книгу',
					'search_items'          => 'Искать книги',
					'not_found'             => 'Книги не найдены.',
					'not_found_in_trash'    => 'Книги в корзине не найдены.',
					'parent_item_colon'     => 'Родительская книга:',
					'all_items'             => 'Все книги',
					'archives'              => 'Архив книг',
					'insert_into_item'      => 'Вставить в книгу',
					'uploaded_to_this_item' => 'Добавлено в эту книгу',
					'name_admin_bar'        => 'Книгу',
				),
				'description' => 'Книги, которым мы делимся на сайте uWebDesign. Только для ознакомления.',
				'public'      => true,
				'has_archive' => true,
				'menu_icon'   => 'dashicons-book',
				'supports'    => array( 'title', 'editor', 'author', 'comments', 'thumbnail' ),
				'taxonomies'  => array( 'post_tag' ),
			),
			'testimonials' => array(
				'label'       => 'Отзывы',
				'labels'      => array(
					'name'                  => 'Отзывы',
					'singular_name'         => 'Отзыв',
					'add_new'               => 'Добавить новый',
					'add_new_item'          => 'Добавить новый отзыв',
					'edit_item'             => 'Редактировать отзыв',
					'new_item'              => 'Новый отзыв',
					'view_item'             => 'Просмотреть отзыв',
					'search_items'          => 'Искать отзывы',
					'not_found'             => 'Отзывы не найдены.',
					'not_found_in_trash'    => 'Отзывы в корзине не найдены.',
					'parent_item_colon'     => 'Родительский отзыв:',
					'all_items'             => 'Все отзывы',
					'archives'              => 'Архив отзывов',
					'insert_into_item'      => 'Вставить в отзыв',
					'uploaded_to_this_item' => 'Добавлено в этот отзыв',
					'name_admin_bar'        => 'Отзыв',
				),
				'description' => 'Отзывы, которые нам оставляют наши подписчики.',
				'public'      => true,
				'has_archive' => false,
				'menu_icon'   => 'dashicons-megaphone',
				'supports'    => array( 'title', 'comments' ),
			),
			'banner'      => array(
				'label'       => 'Баннеры',
				'labels'      => array(
					'name'                  => 'Баннеры',
					'singular_name'         => 'Баннер',
					'add_new'               => 'Добавить новый',
					'add_new_item'          => 'Добавить новый баннер',
					'edit_item'             => 'Редактировать баннер',
					'new_item'              => 'Новый баннер',
					'view_item'             => 'Просмотреть баннер',
					'search_items'          => 'Искать баннеры',
					'not_found'             => 'Баннеры не найдены.',
					'not_found_in_trash'    => 'Баннеры в корзине не найдены.',
					'parent_item_colon'     => 'Родительский баннер:',
					'all_items'             => 'Все баннеры',
					'archives'              => 'Архив баннеров',
					'insert_into_item'      => 'Вставить в баннер',
					'uploaded_to_this_item' => 'Добавлено в этот баннер',
					'name_admin_bar'        => 'Баннер',
				),
				'description' => 'Баннеры, за размещение которых нам платят бабки.',
				'public'      => true,
				'has_archive' => false,
				'menu_icon'   => 'dashicons-money',
				'supports'    => array( 'title', 'thumbnail' ),
			),
		);

		foreach ( $this->post_types as $type => $args ) {
			register_post_type( $type, $args );
		}

	}

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PostTyper();
		}

		return self::$instance;
	}

}

/**
 * Put the callback on 'init' action.
 */
add_action( 'init', array( 'Taxonomier', 'get_instance' ), 0 );
add_action( 'init', array( 'PostTyper', 'get_instance' ), 1 );