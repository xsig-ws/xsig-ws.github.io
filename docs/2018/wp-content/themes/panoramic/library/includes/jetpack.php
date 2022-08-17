<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package panoramic
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function panoramic_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'panoramic_infinite_scroll_render',
		'footer'    => false,
		'wrapper'	=> false
	) );
}
add_action( 'after_setup_theme', 'panoramic_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function panoramic_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'library/template-parts/content' );
	}
}

/**
 * Remove default Related Posts | Custom added to single.php.
 */
function panoramic_remove_default_related_posts() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp     = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
 
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_action( 'wp', 'panoramic_remove_default_related_posts', 20 );
