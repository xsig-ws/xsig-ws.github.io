<?php
/**
 * Styles and scripts registration and enqueuing
 *
 * @package Fluida
 */

/**
 * Loading main styles and scripts
 */
function fluida_enqueue_styles() {
	// HTML5 Shiv
	wp_enqueue_script( 'fluida-html5shiv', get_template_directory_uri() . '/resources/js/html5shiv.min.js', null, _CRYOUT_THEME_VERSION );
	if ( function_exists( 'wp_script_add_data' ) ) wp_script_add_data( 'fluida-html5shiv', 'conditional', 'lt IE 9' );

	$cryout_theme_structure = cryout_get_theme_structure();
	$options = cryout_get_option();

	wp_enqueue_style( 'fluida-themefonts', get_template_directory_uri() . '/resources/fonts/fontfaces.css', null, _CRYOUT_THEME_VERSION ); // fontfaces.css

	// Google fonts
	$gfonts = array();
	$roots = array();
	foreach ( $cryout_theme_structure['google-font-enabled-fields'] as $item ) {
		$itemg = $item . 'google';
		$itemw = $item . 'weight';
		// custom font names
		if ( ! empty( $options[$itemg] ) && ! preg_match( '/custom\sfont/i', $options[$item] ) ) {
				if ( $item == _CRYOUT_THEME_PREFIX . '_fgeneral' ) {
					$gfonts[] = cryout_gfontclean( $options[$itemg], ":100,200,300,400,500,600,700,800,900" ); // include all weights for general font
				} else {
					$gfonts[] = cryout_gfontclean( $options[$itemg], ":".$options[$itemw] );
				};
				$roots[] = cryout_gfontclean( $options[$itemg] );
		}
		// preset google fonts
		if ( preg_match('/^(.*)\/gfont$/i', $options[$item], $bits ) ) {
				if ( $item == _CRYOUT_THEME_PREFIX . '_fgeneral' ) {
					$gfonts[] = cryout_gfontclean( $bits[1], ":100,200,300,400,500,600,700,800,900" ); // include all weights for general font
				} else {
					$gfonts[] = cryout_gfontclean( $bits[1], ":".$options[$itemw] );
				};
				$roots[] = cryout_gfontclean( $bits[1] );
		}
	};

	// Enqueue google fonts with subsets separately
	if ( !empty($gfonts) ) foreach( $gfonts as $i => $gfont ) {
		if ( strpos( $gfont, "&" ) !== false ):
			wp_enqueue_style( 'fluida-googlefont' . $i, '//fonts.googleapis.com/css?family=' . $gfont, null, _CRYOUT_THEME_VERSION );
			unset( $gfonts[$i] );
			unset( $roots[$i] );
		endif;
	};

	// Merged google fonts
	if ( !empty($gfonts) ){ 
		wp_enqueue_style( 'fluida-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique( array_merge( $roots, $gfonts ) ) ), null, _CRYOUT_THEME_VERSION );
	};
	// Main theme style
	wp_enqueue_style( 'fluida-main', get_stylesheet_uri(), null, _CRYOUT_THEME_VERSION );
	// RTL style
	if ( is_RTL() ) wp_enqueue_style( 'fluida-rtl', get_template_directory_uri() . '/resources/styles/rtl.css', null, _CRYOUT_THEME_VERSION );
	// Theme generated style
	wp_add_inline_style( 'fluida-main', preg_replace( "/[\n\r\t\s]+/", " ", fluida_custom_styles() ) ); // includes/custom-styles.php
	// User custom style
	/* this functionality has been removed in v1.8.3
	   temporarily output the existing value (if set) as comment to allow users to migrate custom CSS to WordPress */
	if ( !empty($options['fluida_customcss']) && ( "/* Fluida Custom CSS */" != $options['fluida_customcss'] ) ) {
		wp_add_inline_style( 'fluida-main', sprintf( "/* %s\n*/", str_replace( "/* Fluida Custom CSS */", "Fluida Custom CSS - disabled in v1.8.3\n", preg_replace( "/[\n\r\t\s]+/", " ", htmlspecialchars_decode( $options['fluida_customcss'], ENT_QUOTES ) ) ) ) );
	};
} // fluida_enqueue_styles
add_action( 'wp_enqueue_scripts', 'fluida_enqueue_styles' );

/* Outputs the author meta link in header */
function fluida_author_link() {
	global $post;
	if ( is_single() && get_the_author_meta( 'user_url', $post->post_author ) ) {
		echo '<link rel="author" href="' . esc_url( get_the_author_meta( 'user_url', $post->post_author ) ) . '">';
	}
} //fluida_author_link()
add_action ( 'wp_head', 'fluida_author_link' );


/**
 * Main theme scripts
 */
function fluida_scripts_method() {
	// Boxes aspect ratio
	list(
		$lpboxheight1,
		$lpboxwidth1,
		$lpboxheight2,
		$lpboxwidth2,
	) = array_values( cryout_get_option( array(
		'fluida_lpboxheight1',
		'fluida_lpboxwidth1',
		'fluida_lpboxheight2',
		'fluida_lpboxwidth2',
	) ) );

	// Failsafes
	if ( empty( $lpboxheight1 ) ) $lpboxheight1 = 1;
	if ( empty( $lpboxheight2 ) ) $lpboxheight2 = 1;

	$js_options = apply_filters( 'fluida_js_options', array(
		'masonry' => cryout_get_option('fluida_masonry'),
		'rtl' => ( is_rtl() ? true : false ),
		'magazine' => cryout_get_option('fluida_magazinelayout'),
		'fitvids' => cryout_get_option('fluida_fitvids'),
		'autoscroll' => cryout_get_option('fluida_autoscroll'),
		'articleanimation' => cryout_get_option('fluida_articleanimation'),
		'lpboxratios' => array( round( $lpboxwidth1/$lpboxheight1, 3 ), round( $lpboxwidth2/$lpboxheight2, 3 ) ),
		'is_mobile' => ( wp_is_mobile() ? true : false ),
		'menustyle' => cryout_get_option('fluida_menustyle'),
	) );

	wp_enqueue_script( 'fluida-frontend', get_template_directory_uri() . '/resources/js/frontend.js', array( 'jquery' ), _CRYOUT_THEME_VERSION );
	wp_localize_script( 'fluida-frontend', 'cryout_theme_settings', $js_options );
	if ($js_options['masonry']) wp_enqueue_script( 'jquery-masonry' );

	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
} //fluida_scripts_method()
add_action( 'wp_footer', 'fluida_scripts_method' );

/**
 * Add defer/sync to scripts
 */
function fluida_scripts_filter($tag) {
	$defer = cryout_get_option('fluida_defer');
    $scripts_to_defer = array( 'frontend.js', 'masonry.min.js' );
    foreach( $scripts_to_defer as $defer_script ) {
        if( (true == strpos( $tag, $defer_script )) && $defer )
            return str_replace( ' src', ' defer src', $tag ); // ' async defer src' causes issues with masonry
    }
    return $tag;
} //fluida_scripts_filter()
if ( ! is_admin() ) add_filter( 'script_loader_tag', 'fluida_scripts_filter', 10, 2 );

/**
 * Add responsive meta
 */
function fluida_responsive_meta() {
	echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">' . PHP_EOL;
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
} //fluida_responsive_meta()
add_action( 'cryout_meta_hook', 'fluida_responsive_meta' );

/*
 * fluida_editor_styles() is located in custom-styles.php
 */
function fluida_add_editor_styles() {
	$editorstyles = cryout_get_option('fluida_editorstyles');
	if ( ! $editorstyles ) return;

	add_editor_style( 'resources/styles/editor-style.css' );
	add_editor_style( add_query_arg( 'action', 'fluida_editor_styles_output', admin_url( 'admin-ajax.php' ) ) );
	add_action( 'wp_ajax_fluida_editor_styles_output', 'fluida_editor_styles_output' );
}//fluida_add_editor_styles
fluida_add_editor_styles();

/* FIN */
