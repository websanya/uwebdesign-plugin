<?php
/**
 * Template for books page.
 */

//* Add our custom loop
add_action( 'genesis_loop', 'uwd_books_loop' );
function uwd_books_loop() {
	$args = array(
		'post_type' => 'book',
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
		// loop through posts
		while ( $loop->have_posts() ): $loop->the_post();
			$book_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id() )[0];
			echo '<div class="one-third first">';
			echo '<a href="' . $book_thumbnail . '"><img src="' . $book_thumbnail . '" alt="" /></a>';
			echo '</div>';
			echo '<div class="two-thirds">';
			echo '<h4>' . get_the_title() . '</h4>';
			echo '<p>' . get_the_date() . '</p>';
			echo '</div>';
		endwhile;
	}
	wp_reset_postdata();
}

genesis();