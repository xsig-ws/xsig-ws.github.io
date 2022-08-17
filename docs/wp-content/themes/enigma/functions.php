<?php
/** Theme Name    : Enigma
 * Theme Core Functions and Codes
*/

/* Get the plugin */
if ( ! function_exists( 'enigma_theme_is_companion_active' ) ) {
    function enigma_theme_is_companion_active() {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active(  'weblizar-companion/IS-theme-companion.php' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**Includes required resources here**/
require(get_template_directory() . '/core/menu/default_menu_walker.php');
require(get_template_directory() . '/core/menu/enigma_nav_walker.php');
require(get_template_directory() . '/core/scripts/css_js.php'); //Enquiring Resources here
require(get_template_directory() . '/core/comment-function.php');
require(get_template_directory() . '/core/custom-header.php');
require(get_template_directory() . '/class-tgm-plugin-activation.php');
require get_template_directory() . '/upgrade-to-pro/class-customize.php';


/*After Theme Setup*/
add_action('after_setup_theme', 'enigma_head_setup');

function enigma_head_setup()
{
    global $content_width;
    //content width
    if (!isset($content_width)) $content_width = 550; //px

    /* Enable support for Woocommerce */
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    //Blog Thumb Image Sizes
    add_image_size('enigma_home_post_thumb', 340, 210, true);
    //Blogs thumbs
    add_image_size('enigma_page_thumb', 730, 350, true);
    add_image_size('enigma_blog_2c_thumb', 570, 350, true);
    add_theme_support('title-tag');

    // Logo
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Theme Palace, use a find and replace
     * to change 'enigma' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'enigma' );

    add_theme_support('post-thumbnails'); //supports featured image
    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', esc_html__('Primary Menu', 'enigma'));

    // theme support
    $args = array('default-color' => '000000');
    add_theme_support('custom-background', $args);
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('customize-selective-refresh-widgets');


    /* Gutenberg */
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('customize-selective-refresh-widgets');

    /* Add editor style. */
    add_theme_support('editor-styles');
    add_theme_support('dark-editor-style');

    /* Enable support for HTML5 */
    add_theme_support('html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
    */
    add_editor_style('css/editor-style.css');
}

// Read more tag to formatting in blog page
function enigma_content_more($more)
{
    return wp_kses_post('<div class="blog-post-details-item"><a class="enigma_blog_read_btn" href="' . esc_url(get_permalink()) . '"><i class="fa fa-plus-circle"></i>"' . esc_html__('Read More', 'enigma') . '"</a></div>');
}

add_filter('the_content_more_link', 'enigma_content_more');


// Replaces the excerpt "more" text by a link
function enigma_excerpt_more($more)
{
    if ( is_admin() ) {
        $more = '...';
        return $more;
    }
}

add_filter('excerpt_more', 'enigma_excerpt_more');

/*
* Enigma widget area
*/
add_action('widgets_init', 'enigma_widgets_init');
function enigma_widgets_init()
{
    /*sidebar*/
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'enigma'),
        'id'            => 'sidebar-primary',
        'description'   => esc_html__('The primary widget area', 'enigma'),
        'before_widget' => '<div class="enigma_sidebar_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="enigma_sidebar_widget_title"><h2>',
        'after_title'   => '</h2></div>'
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'enigma'),
        'id'            => 'footer-widget-area',
        'description'   => esc_html__('footer widget area', 'enigma'),
        'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="enigma_footer_widget_title">',
        'after_title'   => '<div class="enigma-footer-separator"></div></div>',
    ));
}


/* Breadcrumbs  */
function enigma_breadcrumbs()
{
    $delimiter = '';
    $home = esc_html__('Home', 'enigma'); // text for the 'Home' link
    
    echo '<ul class="breadcrumb">';
    global $post;
    $homeLink = esc_url(home_url());
    echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>' . esc_html($delimiter) . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo get_category_parents($parentCat, TRUE, ' ' . esc_html($delimiter) . ' ');
        echo '<li>' .  esc_html__("Archive by category","enigma")  . single_cat_title('', false) . '"' . '</li>';
    } elseif (is_day()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_time('d')) . '</li>';
    } elseif (is_month()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_time('F')) . '</li>';
    } elseif (is_year()) {
        echo '<li>' . esc_html(get_the_time('Y')) . '</li>';
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . esc_url($homeLink) . '/' . esc_url($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a></li> ' . esc_html($delimiter) . ' ';
            echo '<li>' . esc_html(get_the_title()) . '</li>';
        } else {
            echo '<li>' . wp_kses_post(get_the_title()) . '</li>';
        }

    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo '<li>' . esc_html($post_type->labels->singular_name) . '</li>';
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a></li> ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_page() && !$post->post_parent) {
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo wp_kses_post($crumb) . ' ' . esc_html($delimiter) . ' ';
        echo '<li>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_search()) {
        echo '<li>' . esc_html__("Search results for", "enigma") . get_search_query() . '"' . '</li>';

    } elseif (is_tag()) {
        echo '<li>' . esc_html__('Tag', 'enigma') . single_tag_title('', false) . '</li>';
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo '<li>' . esc_html__("Articles posted by", "enigma") . esc_html($userdata)->display_name . '</li>';
    } elseif (is_404()) {
        echo '<li>' . esc_html__("Error 404", "enigma") . '</li>';
    }
    echo '</ul>';
}

/*===================================================================================
* Add Class Gravtar
* =================================================================================*/
add_filter('get_avatar', 'enigma_gravatar_class');

function enigma_gravatar_class($class)
{
    $class = str_replace("class='avatar", "class='author_detail_img", $class);
    return $class;
}

//Plugin Recommend
add_action('tgmpa_register', 'enigma_plugin_recommend');

function enigma_plugin_recommend()
{
    $plugins = array(
        array(
            'name'     => esc_html__('IS-theme-companion','enigma'),
            'slug'     => 'weblizar-companion',
            'required' => false,
        ),
    );

    tgmpa($plugins);
}

add_action('wp_enqueue_scripts', 'enigna_custom_css');
function enigna_custom_css()
{
    $enigma_color_scheme = get_theme_mod( 'enigma_color_scheme', '#31A3DD' );

    $output = '';

    $output      .= '
    
    a,a:hover,
    .enigma_fuul_blog_detail_padding h2 a,
    .wl-theme-pagination a.page-numbers,
    .wl-theme-pagination span.page-numbers,
    .enigma_service_area:hover .enigma_service_iocn i,
    .enigma_service_area:focus .enigma_service_iocn i,
    .enigma_service_iocn_2 i,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:hover,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:focus,.enigma_proejct_button a:hover,
.enigma_proejct_button a:focus,.enigma-project-detail-sidebar .launch-enigma-project a:hover,
.enigma-project-detail-sidebar .launch-enigma-project a:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a:hover,
.enigma_gallery_showcase .enigma_gallery_showcase_icons a:focus,.enigma_blog_thumb_wrapper h2 a,.enigma_blog_thumb_date li i,.enigma_blog_thumb_wrapper h2:hover a,.enigma_blog_thumb_date li i,.enigma_blog_thumb_wrapper h2:focus a ,.enigma_cats a i,.enigma_tags a i,.enigma_blog_thumb_wrapper span a i,.carousel-text .enigma_blog_read_btn:hover,
.carousel-text .enigma_blog_read_btn:focus,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:hover,
.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:focus,.enigma_blog_comment:hover h6,
.enigma_blog_comment:hover i,
.enigma_blog_comment:focus h6,
.enigma_blog_comment:focus i,
.enigma_fuul_blog_detail_padding h2,
.enigma_fuul_blog_detail_padding h2 a,
.enigma_fuul_blog_detail_padding h2 a:hover,
.enigma_fuul_blog_detail_padding h2 a:focus,
.enigma_recent_widget_post h3 a,
.enigma_sidebar_link p a:hover,.enigma_sidebar_widget ul li a:hover,
.enigma_sidebar_link p a:focus,.enigma_sidebar_widget ul li a:focus,.reply a,.breadcrumb li a,.enigma_testimonial_area i,
.enigma_footer_widget_column ul li a:hover,.enigma_footer_widget_column ul li a:focus,.enigma_carousel-next i,.enigma_carousel-prev i,.enigma_team_showcase .enigma_team_showcase_icons a:hover,
.enigma_team_showcase .enigma_team_showcase_icons a:focus,.enigma_contact_info li .desc,.enigma_dropcape_simple span,.enigma_blog_read_btn:hover, .enigma_blog_read_btn:focus
{
        color: ' . esc_attr( $enigma_color_scheme) . ';
    }';

    $output      .='
    
    #btn-to-top,.wl-theme-pagination span.page-numbers.current,.hd_cover,.collapse ul.nav li.current-menu-item .dropdown-toggle,
.collapse ul.nav li.current-menu-parent .dropdown-toggle,
.collapse ul.nav li.current_page_ancestor .dropdown-toggle,
.navbar-default .navbar-collapse ul.nav li.current-menu-item .dropdown-toggle .collapse ul.nav li.current_page_ancestor .dropdown-toggle,
.navbar-default .navbar-collapse ul.nav li.current-menu-parent .dropdown-toggle,.navbar-default .navbar-collapse ul.nav li.current_page_ancestor .dropdown-toggle,.enigma_service_iocn,.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a,.enigma_home_portfolio_caption:hover,
.enigma_home_portfolio_caption:focus,.img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption,.enigma_carousel-next:hover,
.enigma_carousel-prev:hover,
.enigma_carousel-next:focus,
.enigma_carousel-prev:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a,.enigma_cats a:hover,
.enigma_tags a:hover,
.enigma_cats a:focus,
.enigma_tags a:focus,.enigma_blog_read_btn,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a,
.enigma_post_date,.enigma_sidebar_widget_title,.enigma_widget_tags a:hover,.enigma_widget_tags a:focus,.tagcloud a:hover,.tagcloud a:focus,.enigma_author_detail_wrapper,.btn-search ,#enigma_send_button:hover,#enigma_send_button:focus,.enigma_send_button:hover,.enigma_send_button:focus,.pager a.selected,
.enigma_blog_pagi a.active,.enigma_blog_pagi a:hover,.enigma_blog_pagi a:focus,.nav-pills>li.active>a:focus,.nav-stacked>li.active>a,.nav-stacked>li.active>a:focus,
    .nav-stacked>li.active>a:hover,
    .nav-stacked>li.active>a:focus,.navbar-default .navbar-toggle:focus,
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus,
    .navbar-toggle,.enigma_client_next:hover,.enigma_client_next:focus,.enigma_client_prev:hover,
.enigma_client_prev:focus,.enigma_team_showcase .enigma_team_showcase_icons a,.enigma_team_caption:hover,.enigma_team_caption:focus,.enigma_team_wrapper:hover .enigma_team_caption,.enigma_callout_area,.enigma_footer_area,.enigma_dropcape_square span,.enigma_dropcape_circle span,.progress-bar,.btn-search,.dropdown-menu .active a, .navbar .nav-menu>.active>a, .navbar .nav-menu>.active>a:focus, .navbar .nav-menu>.active>a:hover, .navbar .nav-menu>.open>a, .navbar .nav-menu>.open>a:focus, .navbar .nav-menu>.open>a:hover, .navbar .nav-menu>li>a:focus, .navbar .nav-menu>li>a:hover,.carousel-list li,.main-navigation ul ul
    {
        background-color:' . esc_attr( $enigma_color_scheme) . ';
    }';

    $output      .='
    .enigma_con_textarea_control:focus,.enigma_contact_input_control:focus,.enigma_contact_textarea_control:focus,.enigma_panel-blue,.enigma_panel-blue>.panel-heading,#enigma_send_button,.enigma_send_button
    {
        border-color:' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .navigation_menu
    {
        border-top:2px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption
    {
        border-left:1px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .enigma_sidebar_widget,.enigma_author_detail_wrapper,.enigma_blockquote_section blockquote
    {
        border-left:3px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .enigma_sidebar_widget
    {
        border-right:3px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption
    {
        border-right:1px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .enigma_heading_title h3,.enigma_heading_title2 h3,.enigma_home_portfolio_caption,.img-wrapper:hover .enigma_home_portfolio_caption,
.img-wrapper:focus .enigma_home_portfolio_caption,.enigma_blog_thumb_wrapper,.enigma_sidebar_widget
    {
        border-bottom:4px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .wl-theme-pagination span.page-numbers.current,.wl-theme-pagination a.page-numbers,.enigma_widget_tags a:hover,.enigma_widget_tags a:focus,.tagcloud a:hover,.tagcloud a:focus,.navbar-toggle
    {
        border:1px solid' . esc_attr( $enigma_color_scheme) . ' !important;
    }';

    $output      .='
    .enigma_testimonial_area img
    {
        border:10px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .enigma_send_button , #enigma_send_button,.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a,
    .enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:hover,
.enigma_home_portfolio_showcase .enigma_home_portfolio_showcase_icons a:focus,.enigma_proejct_button a,
.enigma_carousel-next,.enigma_carousel-prev,
.enigma_proejct_button a:hover,
.enigma_carousel-next,.enigma_carousel-prev,
.enigma_proejct_button a:focus,.enigma_portfolio_detail_pagi li a,.enigma_portfolio_detail_pagi li a:hover,
.enigma_portfolio_detail_pagi li a:focus,.enigma-project-detail-sidebar .launch-enigma-project a,.enigma-project-detail-sidebar .launch-enigma-project a:hover,
.enigma-project-detail-sidebar .launch-enigma-project a:focus,.enigma_gallery_showcase .enigma_gallery_showcase_icons a,.enigma_gallery_showcase .enigma_gallery_showcase_icons a:hover,
.enigma_gallery_showcase .enigma_gallery_showcase_icons a:focus,.enigma_blog_read_btn,.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:hover,
.enigma_blog_thumb_wrapper_showcase .enigma_blog_thumb_wrapper_showcase_icons a:focus,#enigma_send_button:hover,#enigma_send_button:focus,.enigma_send_button:hover,.enigma_send_button:focus,.pager a,.pager a.selected,.enigma_client_next,.enigma_client_prev,.enigma_team_showcase .enigma_team_showcase_icons a,.enigma_team_showcase .enigma_team_showcase_icons a:hover,
.enigma_team_showcase .enigma_team_showcase_icons a:focus
    {
        border:2px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    .enigma_service_iocn,.enigma_service_iocn_2 i,.nav-pills>li>a,.nav-stacked>li>a ,.enigma_client_wrapper:hover,.enigma_client_wrapper:focus
    {
        border:4px solid' . esc_attr( $enigma_color_scheme) . ' ;
    }';

    $output      .='
    
    {
        box-shadow: 0px 0px 12px ' . esc_attr( $enigma_color_scheme) . ' ;
    }'; 

    $output      .='
   
    {
        box-shadow: 0 0 14px 0 ' . esc_attr( $enigma_color_scheme) . ' ;
    }';
    
    $output     .='
    .logo img{
        height:'.esc_attr(get_theme_mod('logo_height','100')).'px;
        width:'.esc_attr(get_theme_mod('logo_width','100')).'px;
    }';
    //custom css
    $custom_css = get_theme_mod('custom_css') ; 
    if (!empty ($custom_css)) {
        $output .= get_theme_mod('custom_css') . "\n";
    }

    wp_register_style('custom-header-style', false);
    wp_enqueue_style('custom-header-style', get_template_directory_uri() . '/css/custom-header-style.css');
    wp_add_inline_style('custom-header-style', $output);
}

/*
* Adds starter content to highlight the theme on fresh sites.
* This is done conditionally to avoid loading the starter content on every
* page load, as it is a one-off operation only needed once in the customizer.
*/
if ( is_customize_preview() ) {
    require get_template_directory() . '/starter-content/starter-content.php';
    add_theme_support( 'starter-content', enigma_get_starter_content() );
}