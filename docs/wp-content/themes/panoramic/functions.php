<?php
/**
 * panoramic functions and definitions
 *
 * @package panoramic
 */
define( 'PANORAMIC_THEME_VERSION' , '1.1.25' );

if ( ! function_exists( 'panoramic_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function panoramic_theme_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 800; /* pixels */
	}
	
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,600,600italic,700,700italic' );
	add_editor_style( $font_url );
	
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,400,300' );
	add_editor_style( $font_url );
	
	add_editor_style('editor-style.css');

	if ( !get_theme_mod( 'otb_panoramic_dot_org' ) ) set_theme_mod( 'otb_panoramic_dot_org', true );
	if ( !get_theme_mod( 'otb_panoramic_activated' ) ) set_theme_mod( 'otb_panoramic_activated', date('Y-m-d') );
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on panoramic, use a find and replace
	 * to change 'panoramic' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'panoramic', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'panoramic' ),
        'footer' => __( 'Footer Menu', 'panoramic' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'navigation-widgets'
		)
	);

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	/*
	 * Setup Custom Logo Support for theme
	 * Supported from WordPress version 4.5 onwards
	 * More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
	 */
	if ( function_exists( 'has_custom_logo' ) ) {
		add_theme_support( 'custom-logo' );
	}
	
	// The custom header is used if no slider is enabled
	add_theme_support( 'custom-header', array(
        'default-image' => get_template_directory_uri() . '/library/images/headers/default.jpg',
		'width'         => 1500,
		'height'        => 445,
		'flex-width'    => true,
		'flex-height'   => true,
		'header-text'   => false,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'panoramic_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    add_theme_support( 'title-tag' );
    
	// Gutenberg Support
    add_theme_support( 'align-wide' );
	
	// Toggle WordPress 5.8+ block-based widgets
	if ( !get_theme_mod( 'panoramic-gutenberg-enable-block-based-widgets', customizer_library_get_default( 'panoramic-gutenberg-enable-block-based-widgets' ) ) ) {
		remove_theme_support( 'widgets-block-editor' );
	}
    
 	add_theme_support( 'woocommerce', array(
 		'gallery_thumbnail_image_width' => 300
 	) );
	
	if ( get_theme_mod( 'panoramic-woocommerce-product-image-zoom', true ) ) {	
		add_theme_support( 'wc-product-gallery-zoom' );
	}	
	
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-spacing' );
}
endif; // panoramic_theme_setup
add_action( 'after_setup_theme', 'panoramic_theme_setup' );

/**
 * Enqueue admin scripts and styles.
 */
function panoramic_admin_scripts() {
	wp_enqueue_style( 'panoramic-admin', get_template_directory_uri() . '/library/css/admin.css', array(), PANORAMIC_THEME_VERSION );
	wp_enqueue_script( 'panoramic-admin', get_template_directory_uri() . '/library/js/admin.js', PANORAMIC_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'panoramic_admin_scripts' );

// Adjust content_width for full width pages
function panoramic_adjust_content_width() {
    global $content_width;

	if ( panoramic_is_woocommerce_activated() && is_woocommerce() ) {
		$is_woocommerce = true;
	} else {
		$is_woocommerce = false;
	}

    if ( is_page_template( 'template-full-width.php' ) ) {
    	$content_width = 1096;
	} else if ( ( is_page_template( 'template-left-sidebar.php' ) || basename( get_page_template() ) === 'page.php' ) && !is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1096;
	} else if ( panoramic_is_woocommerce_activated() && is_shop() && get_theme_mod( 'panoramic-layout-woocommerce-shop-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-shop-full-width' ) ) ) {
		$content_width = 1096;
	} else if ( panoramic_is_woocommerce_activated() && is_product() && get_theme_mod( 'panoramic-layout-woocommerce-product-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-product-full-width' ) ) ) {
		$content_width = 1096;
	} else if ( panoramic_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) && get_theme_mod( 'panoramic-layout-woocommerce-category-tag-page-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-category-tag-page-full-width' ) ) ) {
		$content_width = 1096;
	} else if ( $is_woocommerce && !is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1096;
	}
}
add_action( 'template_redirect', 'panoramic_adjust_content_width' );

function panoramic_review_notice() {
	$user_id = get_current_user_id();
	$message = 'Thank you for using Panoramic! We hope you\'re enjoying the theme, please consider <a href="https://wordpress.org/support/theme/panoramic/reviews/#new-post" target="_blank">rating it on wordpress.org</a> :)';
	
	if ( !get_user_meta( $user_id, 'panoramic_review_notice_dismissed' ) ) {
		$class = 'notice notice-success is-dismissible';
		printf( '<div class="%1$s"><p>%2$s</p><p><a href="?panoramic-review-notice-dismissed">Dismiss this notice</a></p></div>', esc_attr( $class ), $message );
	}
}
$today = new DateTime( date( 'Y-m-d' ) );
$activate  = new DateTime( date( get_theme_mod( 'otb_panoramic_activated' ) ) );
if ( $activate->diff($today)->d >= 14 ) {
	add_action( 'admin_notices', 'panoramic_review_notice' );
}

function panoramic_review_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['panoramic-review-notice-dismissed'] ) ) {
		add_user_meta( $user_id, 'panoramic_review_notice_dismissed', 'true', true );
	}
}
add_action( 'admin_init', 'panoramic_review_notice_dismissed' );

function panoramic_admin_notice() {
	$user_id = get_current_user_id();
	
	$message = array (
		'id' => 15,
		'heading' => 'Christmas Sale',
		'text' => '<a href="https://www.outtheboxthemes.com/go/theme-notification-christmas-2021-wordpress-themes/">Get 20% off any of our Premium WordPress Themes until Christmas Day</a>',
		'link' => 'https://www.outtheboxthemes.com/go/theme-notification-christmas-2021-wordpress-themes/'
	);
	
	if ( !empty( $message['text'] ) && !get_user_meta( $user_id, 'panoramic_admin_notice_' .$message['id']. '_dismissed' ) ) {
		$class = 'notice otb-notice notice-success is-dismissible';
		printf( '<div class="%1$s"><img src="https://www.outtheboxthemes.com/wp-content/uploads/2020/12/logo-red.png" class="logo" /><h3>%2$s</h3><p>%3$s</p><p style="margin:0;"><a class="button button-primary" href="%4$s" target="_blank">Read More</a> <a class="button button-dismiss" href="?panoramic-admin-notice-dismissed&panoramic-admin-notice-id=%5$s">Dismiss</a></p></div>', esc_attr( $class ), $message['heading'], $message['text'], $message['link'], $message['id'] );
	}
}

if ( date('Y-m-d') <= '2021-12-25' ) {
	add_action( 'admin_notices', 'panoramic_admin_notice' );
}

function panoramic_admin_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['panoramic-admin-notice-dismissed'] ) ) {
    	$panoramic_admin_notice_id = $_GET['panoramic-admin-notice-id'];
		add_user_meta( $user_id, 'panoramic_admin_notice_' .$panoramic_admin_notice_id. '_dismissed', 'true', true );
	}
}
add_action( 'admin_init', 'panoramic_admin_notice_dismissed' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function panoramic_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'panoramic' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	) );
	
	register_sidebar(array(
		'name' => __( 'Footer', 'panoramic' ),
		'id' => 'footer',
        'description' => ''
	));
}
add_action( 'widgets_init', 'panoramic_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function panoramic_theme_scripts() {
	wp_enqueue_style( 'panoramic-site-title-font-default', '//fonts.googleapis.com/css?family=Kaushan+Script:400', array(), PANORAMIC_THEME_VERSION );
    wp_enqueue_style( 'panoramic-body-font-default', '//fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,600,600italic,700,700italic', array(), PANORAMIC_THEME_VERSION );
    wp_enqueue_style( 'panoramic-heading-font-default', '//fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,400,300', array(), PANORAMIC_THEME_VERSION );
    
    if ( get_theme_mod( 'panoramic-header-layout', 'panoramic-header-layout-standard' ) == 'panoramic-header-layout-centered' ) {
    	wp_enqueue_style( 'panoramic-header-centered', get_template_directory_uri().'/library/css/header-centered.css', array(), PANORAMIC_THEME_VERSION );
    } else {
    	wp_enqueue_style( 'panoramic-header-standard', get_template_directory_uri().'/library/css/header-standard.css', array(), PANORAMIC_THEME_VERSION );
    }
    
	wp_enqueue_style( 'otb-font-awesome-otb-font-awesome', get_template_directory_uri().'/library/fonts/otb-font-awesome/css/otb-font-awesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'otb-font-awesome-font-awesome-min', get_template_directory_uri().'/library/fonts/otb-font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
	wp_enqueue_style( 'panoramic-style', get_stylesheet_uri(), array(), PANORAMIC_THEME_VERSION );
	
	if ( panoramic_is_woocommerce_activated() ) {	
    	wp_enqueue_style( 'panoramic-woocommerce-custom', get_template_directory_uri().'/library/css/woocommerce-custom.css', array(), PANORAMIC_THEME_VERSION );
	}

	wp_enqueue_script( 'panoramic-navigation', get_template_directory_uri() . '/library/js/navigation.js', array(), PANORAMIC_THEME_VERSION, true );
	wp_enqueue_script( 'panoramic-caroufredsel', get_template_directory_uri() . '/library/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), PANORAMIC_THEME_VERSION, true );
	wp_enqueue_script( 'panoramic-touchswipe', get_template_directory_uri() . '/library/js/jquery.touchSwipe.min.js', array('jquery'), PANORAMIC_THEME_VERSION, true );
	
	wp_enqueue_script( 'panoramic-custom', get_template_directory_uri() . '/library/js/custom.js', array('jquery'), PANORAMIC_THEME_VERSION, true );

    $variables = array(
    	'sliderTransitionSpeed' => intval( get_theme_mod( 'panoramic-slider-transition-speed', customizer_library_get_default( 'panoramic-slider-transition-speed' ) ) )
    );
	
	wp_localize_script( 'panoramic-custom', 'variables', $variables );
	
	wp_enqueue_script( 'panoramic-skip-link-focus-fix', get_template_directory_uri() . '/library/js/skip-link-focus-fix.js', array(), PANORAMIC_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'panoramic_theme_scripts' );

function panoramic_set_elementor_default_schemes( $config ) {
	
	// Primary
	$config['schemes']['items']['color']['items']['1']['value'] = get_theme_mod( 'panoramic-heading-font-color', customizer_library_get_default( 'panoramic-heading-font-color' ) );
	
	// Secondary
	$config['schemes']['items']['color']['items']['2']['value'] = get_theme_mod( 'panoramic-primary-color', customizer_library_get_default( 'panoramic-primary-color' ) );
	
	// Text
	$config['schemes']['items']['color']['items']['3']['value'] = get_theme_mod( 'panoramic-body-font-color', customizer_library_get_default( 'panoramic-body-font-color' ) );
	
	// Accent
	$config['schemes']['items']['color']['items']['4']['value'] = get_theme_mod( 'panoramic-primary-color', customizer_library_get_default( 'panoramic-primary-color' ) );

	// Primary Headline
	$config['schemes']['items']['typography']['items']['1']['value'] = [
		'font-family' => get_theme_mod( 'panoramic-heading-font', customizer_library_get_default( 'panoramic-heading-font' ) ),
		//'font-weight' => get_theme_mod( 'panoramic-heading-font-weight', customizer_library_get_default( 'panoramic-heading-font-weight' ) )
		'font-weight' => '400'
	];
	
	// Secondary Headline
	$config['schemes']['items']['typography']['items']['2']['value'] = [
		'font-family' => get_theme_mod( 'panoramic-heading-font', customizer_library_get_default( 'panoramic-heading-font' ) ),
		//'font-weight' => get_theme_mod( 'panoramic-heading-font-weight', customizer_library_get_default( 'panoramic-heading-font-weight' ) )
		'font-weight' => '400'
	];

	// Body Text
	$config['schemes']['items']['typography']['items']['3']['value'] = [
		'font-family' => get_theme_mod( 'panoramic-body-font', customizer_library_get_default( 'panoramic-body-font' ) ),
		'font-weight' => get_theme_mod( 'panoramic-body-font-weight', customizer_library_get_default( 'panoramic-body-font-weight' ) )
	];

	// Accent Text
	$config['schemes']['items']['typography']['items']['4']['value'] = [
		'font-family' => get_theme_mod( 'panoramic-heading-font', customizer_library_get_default( 'panoramic-heading-font' ) ),
		//'font-weight' => get_theme_mod( 'panoramic-heading-font-weight', customizer_library_get_default( 'panoramic-heading-font-weight' ) )
		'font-weight' => '400'
	];

	$config['schemes']['items']['color-picker']['items']['1']['value'] = get_theme_mod( 'panoramic-primary-color', customizer_library_get_default( 'panoramic-primary-color' ) );
	$config['schemes']['items']['color-picker']['items']['2']['value'] = get_theme_mod( 'panoramic-secondary-color', customizer_library_get_default( 'panoramic-secondary-color' ) );
	$config['schemes']['items']['color-picker']['items']['3']['value'] = get_theme_mod( 'panoramic-body-font-color', customizer_library_get_default( 'panoramic-body-font-color' ) );
	$config['schemes']['items']['color-picker']['items']['4']['value'] = get_theme_mod( 'panoramic-footer-color', customizer_library_get_default( 'panoramic-footer-color' ) );
	$config['schemes']['items']['color-picker']['items']['5']['value'] = '';
	$config['schemes']['items']['color-picker']['items']['6']['value'] = '';
	$config['schemes']['items']['color-picker']['items']['7']['value'] = '';
	$config['schemes']['items']['color-picker']['items']['8']['value'] = '';
	
	return $config;
};
add_filter('elementor/editor/localize_settings', 'panoramic_set_elementor_default_schemes', 100);

/**
 * Load Gutenberg stylesheet.
*/
function panoramic_gutenberg_assets() {
	wp_enqueue_style( 'panoramic-gutenberg-editor', get_theme_file_uri( '/library/css/gutenberg-editor-style.css' ), false, PANORAMIC_THEME_VERSION );
	
	// Output inline styles based on theme customizer selections
	require get_template_directory() . '/library/includes/gutenberg-editor-styles.php';
}
add_action( 'enqueue_block_editor_assets', 'panoramic_gutenberg_assets' );

// Recommended plugins installer
require_once get_template_directory() . '/library/includes/class-tgm-plugin-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/library/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/library/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/library/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/library/includes/jetpack.php';

// Helper library for the theme customizer.
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/customizer/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/customizer/mods.php';

// Include TRT Customize Pro library
require_once( get_template_directory() . '/trt-customize-pro/class-customize.php' );

/**
 * Premium Upgrade Page
 */
if ( !class_exists( 'otb_theme_upgrader' ) ) {
	include get_template_directory() . '/upgrade/upgrade.php';
}

/**
 * Enqueue panoramic custom customizer styling.
 */
function panoramic_load_customizer_script() {
    wp_enqueue_script( 'panoramic-customizer-custom', get_template_directory_uri() . '/customizer/customizer-library/js/customizer-custom.js', array('jquery'), PANORAMIC_THEME_VERSION, true );

    $upgrade_button = array(
    	'link' => admin_url( 'themes.php?page=premium_upgrade' ),
    	'text' => __( 'Upgrade To Premium &raquo;', 'panoramic' )
    );
    
    wp_localize_script( 'panoramic-customizer-custom', 'upgrade_button', $upgrade_button );
    
    wp_enqueue_style( 'panoramic-customizer', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css' );
}    
add_action( 'customize_controls_enqueue_scripts', 'panoramic_load_customizer_script' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function panoramic_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'panoramic_pingback_header' );

if ( ! function_exists( 'panoramic_load_dynamic_css' ) ) :
	/**
	 * Add Dynamic CSS
	 */
	function panoramic_load_dynamic_css() {
		$panoramic_slider_has_min_width = get_theme_mod( 'panoramic-slider-has-min-width', customizer_library_get_default( 'panoramic-slider-has-min-width' ) );
		$panoramic_slider_min_width 	= floatVal( get_theme_mod( 'panoramic-slider-min-width', customizer_library_get_default( 'panoramic-slider-min-width' ) ) );
		
		// Activate the mobile menu when on a mobile device
		//if ( wp_is_mobile() ) {
		//	$mobile_menu_breakpoint = 10000000;
		//} else {
			$mobile_menu_breakpoint = 960;
		//}
		
		require get_template_directory() . '/library/includes/dynamic-css.php';
	}
endif;
add_action( 'wp_head', 'panoramic_load_dynamic_css' );

// Create function to check if WooCommerce exists.
if ( ! function_exists( 'panoramic_is_woocommerce_activated' ) ) :
	function panoramic_is_woocommerce_activated() {
    	if ( class_exists( 'woocommerce' ) ) {
    		return true;
    	} else {
    		return false;
    	}
	}
endif; // panoramic_is_woocommerce_activated

if ( panoramic_is_woocommerce_activated() ) {
    require get_template_directory() . '/library/includes/woocommerce-inc.php';
}

// Add CSS class to body by filter
function panoramic_add_body_class( $classes ) {

	if( wp_is_mobile() ) {
		$classes[] = 'mobile-device';
	}
	
	if ( get_theme_mod( 'panoramic-media-crisp-images', customizer_library_get_default( 'panoramic-media-crisp-images' ) ) ) {
		$classes[] = 'crisp-images';
	}
	
	if ( get_theme_mod( 'panoramic-content-links-have-underlines', customizer_library_get_default( 'panoramic-content-links-have-underlines' ) ) ) {
		$classes[] = 'content-links-have-underlines';
	}
	
	if ( get_theme_mod( 'panoramic-page-builders-use-theme-styles', customizer_library_get_default( 'panoramic-page-builders-use-theme-styles' ) ) ) {
		$classes[] = 'panoramic-page-builders-use-theme-styles';
	}
	
	if ( panoramic_is_woocommerce_activated() && is_shop() && get_theme_mod( 'panoramic-layout-woocommerce-shop-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-shop-full-width' ) ) ) {
		$classes[] = 'panoramic-shop-full-width';
	}

	if ( panoramic_is_woocommerce_activated() && is_product() && get_theme_mod( 'panoramic-layout-woocommerce-product-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-product-full-width' ) ) ) {
		$classes[] = 'panoramic-product-full-width';
	}
	
	if ( panoramic_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) && get_theme_mod( 'panoramic-layout-woocommerce-category-tag-page-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-category-tag-page-full-width' ) ) ) {
		$classes[] = 'panoramic-shop-full-width';
	}
	
	if ( panoramic_is_woocommerce_activated() && is_woocommerce() ) {
		$is_woocommerce = true;
	} else {
		$is_woocommerce = false;
	}
	
	if ( $is_woocommerce && !is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'full-width';
	}	

	return $classes;
}
add_filter( 'body_class', 'panoramic_add_body_class' );

/**
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 */
		do_action( 'wp_body_open' );
	}
endif;

/*
TODO: Remove the woocommerce_get_sidebar action on the product catalog if set to full width
if ( panoramic_is_woocommerce_activated() && is_shop() && get_theme_mod( 'panoramic-layout-woocommerce-shop-full-width', customizer_library_get_default( 'panoramic-layout-woocommerce-shop-full-width' ) ) ) {
	remove_action( 'woocommerce_get_sidebar', 'action_woocommerce_get_sidebar', 10, 2 );
}
*/

add_action( 'woocommerce_before_shop_loop_item_title', function() {
	if ( get_theme_mod( 'panoramic-woocommerce-shop-display-thumbnail-loader-animation', customizer_library_get_default( 'panoramic-woocommerce-shop-display-thumbnail-loader-animation' ) ) ) {
		echo '<div class="hiddenUntilLoadedImageContainer loading">';
	}
}, 9 );

add_action( 'woocommerce_before_shop_loop_item_title', function() {
	if ( get_theme_mod( 'panoramic-woocommerce-shop-display-thumbnail-loader-animation', customizer_library_get_default( 'panoramic-woocommerce-shop-display-thumbnail-loader-animation' ) ) ) {
		echo '</div>';
	}
}, 11 );

// Set the number or products per page
function panoramic_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$cols = get_theme_mod( 'panoramic-woocommerce-products-per-page' );
	
	return $cols;
}
add_filter( 'loop_shop_per_page', 'panoramic_loop_shop_per_page', 20 );

if (!function_exists('panoramic_woocommerce_product_thumbnails_columns')) {
	function panoramic_woocommerce_product_thumbnails_columns() {
		return 3;
	}
}
add_filter ( 'woocommerce_product_thumbnails_columns', 'panoramic_woocommerce_product_thumbnails_columns' );

/**
 * Replace Read more buttons for out of stock items
 */
// Display an Out of Stock label on out of stock products
add_action( 'woocommerce_after_shop_loop_item_title', 'panoramic_out_of_stock_notice', 10 );
function panoramic_out_of_stock_notice() {
    global $product;
    if ( !$product->is_in_stock() ) {
		echo '<p class="stock out-of-stock">';
		echo __( 'Out of Stock', 'panoramic' );
		echo '</p>';
    }
}

/*
if (!function_exists('woocommerce_template_loop_add_to_cart')) {
	function woocommerce_template_loop_add_to_cart( $args = array() ) {
		global $product;

		if (!$product->is_in_stock()) {
			echo '<p class="stock out-of-stock">';
			echo __( 'Out of Stock', 'panoramic' );
			echo '</p>';
		} else {
			$defaults = array(
				'quantity' => 1,
				'class' => implode( ' ', array_filter( array(
				'button',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) )
			);
			
			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
			wc_get_template( 'loop/add-to-cart.php', $args );
		}
	}
}
*/

function panoramic_excerpt_length( $length ) {
	if ( is_admin() || ( !is_home() && !is_category() && !is_tag() && !is_search() ) ) {
		return $length;
	} else {
		return intval( get_theme_mod( 'panoramic-blog-excerpt-length', customizer_library_get_default( 'panoramic-blog-excerpt-length' ) ) );
	}
}
add_filter( 'excerpt_length', 'panoramic_excerpt_length', 999 );

if ( ! function_exists( 'panoramic_excerpt_more' ) ) {
	function panoramic_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		} else {
			return ' <a class="read-more" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . wp_kses_post( pll__( get_theme_mod( 'panoramic-blog-read-more-text', customizer_library_get_default( 'panoramic-blog-read-more-text' ) ) ) ) . '</a>';
		}
	}
}
add_filter( 'excerpt_more', 'panoramic_excerpt_more' );

/**
 * Adjust is_home query if panoramic-slider-categories is set
 */
function panoramic_set_blog_queries( $query ) {
    
    $slider_categories = get_theme_mod( 'panoramic-slider-categories', '' );
    $slider_type = get_theme_mod( 'panoramic-slider-type', customizer_library_get_default( 'panoramic-slider-type' ) );
    
    if ( $slider_categories != '' && $slider_type == 'panoramic-slider-default' ) {
    	
    	$is_front_page = ( $query->get('page_id') == get_option('page_on_front') || is_front_page() );
    	
	    if ( count($slider_categories) > 0) {
	        // do not alter the query on wp-admin pages and only alter it if it's the main query
	        if ( !is_admin() && !$is_front_page || !is_admin() && $is_front_page && $query->get('id') != 'slider' ){
                $query->set( 'category__not_in', $slider_categories );
	        }
	    }
	}
	    
}
add_action( 'pre_get_posts', 'panoramic_set_blog_queries' );

function panoramic_filter_recent_posts_widget_parameters( $params ) {

	$slider_categories = get_theme_mod( 'panoramic-slider-categories', '' );
    $slider_type = get_theme_mod( 'panoramic-slider-type', customizer_library_get_default( 'panoramic-slider-type' ) );
	
	if ( $slider_categories != '' && $slider_type == 'panoramic-slider-default' ) {
		if ( count($slider_categories) > 0) {
			// do not alter the query on wp-admin pages and only alter it if it's the main query
			$params['category__not_in'] = $slider_categories;
		}
	}
	
	return $params;
}
add_filter('widget_posts_args','panoramic_filter_recent_posts_widget_parameters');

/**
 * Adjust the widget categories query if panoramic-slider-categories is set
 */
function panoramic_set_widget_categories_args($args){
	$slider_categories = get_theme_mod( 'panoramic-slider-categories', '' );
    $slider_type = get_theme_mod( 'panoramic-slider-type', customizer_library_get_default( 'panoramic-slider-type' ) );
	
	if ( $slider_categories != '' && $slider_type == 'panoramic-slider-default' ) {
		if ( count($slider_categories) > 0) {
			$exclude = implode(',', $slider_categories);
			$args['exclude'] = $exclude;
		}
	}

	return $args;
}
add_filter('widget_categories_args', 'panoramic_set_widget_categories_args');

function panoramic_set_widget_categories_dropdown_arg($args){
	$slider_categories = get_theme_mod( 'panoramic-slider-categories', '' );
    $slider_type = get_theme_mod( 'panoramic-slider-type', customizer_library_get_default( 'panoramic-slider-type' ) );
	
	if ( $slider_categories != '' && $slider_type == 'panoramic-slider-default' ) {
		if ( count($slider_categories) > 0) {
			$exclude = implode(',', $slider_categories);
			$args['exclude'] = $exclude;
		}
	}

	return $args;
}
add_filter('widget_categories_dropdown_args', 'panoramic_set_widget_categories_dropdown_arg');

function panoramic_allowed_tags() {
	global $allowedtags;
	$allowedtags["h1"] = array();
	$allowedtags["h2"] = array();
	$allowedtags["h3"] = array();
	$allowedtags["h4"] = array();
	$allowedtags["h5"] = array();
	$allowedtags["h6"] = array();
	$allowedtags["p"] = array();
	$allowedtags["br"] = array();
	$allowedtags["a"] = array(
		'href' => true,
		'class' => true,
	);
	$allowedtags["i"] = array(
		'class' => true,
	);
}
add_action('init', 'panoramic_allowed_tags', 10);

function panoramic_register_required_plugins() {
	
	$plugins = array(
		array(
			'name'      => __( 'Elementor Page Builder', 'panoramic' ),
			'slug'      => 'elementor',
			'required'  => false
		),
		array(
			'name'      => __( 'You can quote me on that', 'panoramic' ),
			'slug'      => 'you-can-quote-me-on-that',
			'required'  => false
		),
		array(
			'name'      => __( 'SiteOrigin Widgets Bundle', 'panoramic' ),
			'slug'      => 'so-widgets-bundle',
			'required'  => false
		),
		array(
			'name'      => __( 'Recent Posts Widget Extended', 'panoramic' ),
			'slug'      => 'recent-posts-widget-extended',
			'required'  => false
		),
		array(
			'name'      => __( 'Beam me up Scotty', 'panoramic' ),
			'slug'      => 'beam-me-up-scotty',
			'required'  => false
		),
		array(
			'name'      => __( 'WPForms', 'panoramic' ),
			'slug'      => 'wpforms-lite',
			'required'  => false
		),
		array(
			'name'      => __( 'Photo Gallery by Supsystic', 'panoramic' ),
			'slug'      => 'gallery-by-supsystic',
			'required'  => false
		),
		array(
			'name'      => __( 'Breadcrumb NavXT', 'panoramic' ),
			'slug'      => 'breadcrumb-navxt',
			'required'  => false
		),
		array(
			'name'      => __( 'WooCommerce', 'panoramic' ),
			'slug'      => 'woocommerce',
			'required'  => false
		),
		array(
			'name'      => __( 'Instagram Slider Widget', 'panoramic' ),
			'slug'      => 'instagram-slider-widget',
			'required'  => false
		),
		array(
			'name'      => __( 'Anti-Spam', 'panoramic' ),
			'slug'      => 'anti-spam',
			'required'  => false
		),
		array(
			'name'      => __( 'Yoast SEO', 'panoramic' ),
			'slug'      => 'wordpress-seo',
			'required'  => false
		)
	);

	$config = array(
		'id'           => 'panoramic',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => get_stylesheet_directory() .'/library/plugins/', // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => ''                       // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'panoramic_register_required_plugins' );

/**
 * Determine if Custom Post Type
 * usage: if ( is_this_a_custom_post_type() )
 *
 * References/Modified from:
 * @link https://codex.wordpress.org/Function_Reference/get_post_types
 * @link http://wordpress.stackexchange.com/users/73/toscho <== love this person!
 * @link http://wordpress.stackexchange.com/a/95906/64742
 */
function panoramic_is_this_a_custom_post_type( $post = NULL ) {

    $all_custom_post_types = get_post_types( array ( '_builtin' => false ) );

    //* there are no custom post types
    if ( empty ( $all_custom_post_types ) ) return false;

    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );

    //* could not detect current type
    if ( ! $current_post_type )
        return false;

    return in_array( $current_post_type, $custom_types );
}

/**
 * Remove blog menu link class 'current_page_parent' when on an unrelated CPT
 * or search results page
 * or 404 page
 * dep: is_this_a_custom_post_type() function
 * modified from: https://gist.github.com/ajithrn/1f059b2201d66f647b69
 */
function panoramic_if_cpt_or_search_or_404_remove_current_page_parent_on_blog_page_link( $classes, $item, $args ) {
    if ( panoramic_is_this_a_custom_post_type() || is_search() || is_404() ) {
        $blog_page_id = intval( get_option('page_for_posts') );

        if ( $blog_page_id != 0 && $item->object_id == $blog_page_id ) {
			unset( $classes[array_search( 'current_page_parent', $classes )] );
        }

	}

    return $classes;
}
add_filter( 'nav_menu_css_class', 'panoramic_if_cpt_or_search_or_404_remove_current_page_parent_on_blog_page_link', 10, 3 );

if ( function_exists( 'pll_register_string' ) ) {
	/**
	* Register some string from the customizer to be translated with Polylang
	*/
	function panoramic_pll_register_string() {
		// Header
		pll_register_string( 'panoramic-header-info-text-one', get_theme_mod( 'panoramic-header-info-text-one', customizer_library_get_default( 'panoramic-header-info-text-one' ) ), 'panoramic', false );
		
		// Search
		pll_register_string( 'panoramic-search-placeholder-text', get_theme_mod( 'panoramic-search-placeholder-text', customizer_library_get_default( 'panoramic-search-placeholder-text' ) ), 'panoramic', false );
		pll_register_string( 'panoramic-website-text-no-search-results-heading', get_theme_mod( 'panoramic-website-text-no-search-results-heading', customizer_library_get_default( 'panoramic-website-text-no-search-results-heading' ) ), 'panoramic', false );
		pll_register_string( 'panoramic-website-text-no-search-results-text', get_theme_mod( 'panoramic-website-text-no-search-results-text', customizer_library_get_default( 'panoramic-website-text-no-search-results-text' ) ), 'panoramic', true );
		
		// Header media
		pll_register_string( 'panoramic-header-image-text', get_theme_mod( 'panoramic-header-image-text', customizer_library_get_default( 'panoramic-header-image-text' ) ), 'panoramic', true );
		
		// Blog read more
		pll_register_string( 'panoramic-blog-read-more-text', get_theme_mod( 'panoramic-blog-read-more-text', customizer_library_get_default( 'panoramic-blog-read-more-text' ) ), 'panoramic', true );
		
		// 404
		pll_register_string( 'panoramic-website-text-404-page-heading', get_theme_mod( 'panoramic-website-text-404-page-heading', customizer_library_get_default( 'panoramic-website-text-404-page-heading' ) ), 'panoramic', true );
		pll_register_string( 'panoramic-website-text-404-page-text', get_theme_mod( 'panoramic-website-text-404-page-text', customizer_library_get_default( 'panoramic-website-text-404-page-text' ) ), 'panoramic', true );
	}
	add_action( 'admin_init', 'panoramic_pll_register_string' );
}

/**
 * A fallback function that outputs a non-translated string if Polylang is not active
 *
 * @param $string
 *
 * @return  void
 */
if ( !function_exists( 'pll_e' ) ) {
	function pll_e( $str ) {
		echo $str;
	}
}

/**
 * A fallback function that returns a non-translated string if Polylang is not active
 *
 * @param $string
 *
 * @return string
 */
if ( !function_exists( 'pll__' ) ) {
	function pll__( $str ) {
		return $str;
	}
}
