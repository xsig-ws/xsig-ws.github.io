<?php
/**
 * Enigma Starter Content
 *
 * @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 *
 * @package enigma
 * @subpackage enigma
 * @since Enigma

/**
 * Function to return the array of starter content for the theme.
 *
 * Passes it through the `enigma_starter_content` filter before returning.
 *
 * @since enigma
 *
 * @return array A filtered array of args for the starter_content.
*/
function enigma_get_starter_content() {

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'     => array(
			'home' => require get_template_directory() . '/starter-content/home.php',
			'about',
			'contact',
			'blog',
		),

		// Default to a static front page and assign the front and posts pages.
		'options'   => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "primary" location.
			'primary' => array(
				'name'  => esc_html__( 'Primary menu', 'enigma' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),

		'theme_mods'  => array(
			'custom_logo'                              => '{{featured-image-logo}}',
			'blogdescription'                          => '',
			'blogname'                                 => '',
			'blogname'                                 => '',

		),

		'attachments' => array(
			'featured-image-logo' => array(
				'post_title'   => 'Featured Logo',
				'post_content' => 'Attachment Description',
				'post_excerpt' => 'Attachment Caption',
				'file'         => '/starter-content/img/logo.png',
			),
		),

		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'footer-widget-area' => array(
				'text_about',
				'search',
				'recent-posts',
				'text_business_info',
			),
		),
	);

	/**
	 * Filters the array of starter content.
	 *
	 * @since enigma
	 *
	 * @param array $starter_content Array of starter content.
	 */
	return apply_filters( 'enigma_starter_content', $starter_content );
}