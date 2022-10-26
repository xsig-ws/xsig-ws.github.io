<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * Learn more: https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package enigma
 */
get_header();
$page_header = absint(get_theme_mod( 'page_header', 1 ));
$class = '';
if ( $page_header == 1) { ?>
    <div class="enigma_header_breadcrum_title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php esc_html_e('404 Error', 'enigma'); ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'enigma'); ?></a>
                        </li>
                        <li><?php esc_html_e('404 Error', 'enigma'); ?></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    $class = 'no-page-header';
} ?>
    <div class="container">
        <div class="row enigma_blog_wrapper <?php echo esc_attr($class); ?>">
            <div class="col-md-12 hc_404_error_section">
                <div class="error_404">
                    <h2><?php esc_html_e('404', 'enigma'); ?></h2>
                    <h4><?php esc_html_e('Whoops... Page Not Found !!!', 'enigma'); ?></h4>
                    <p><?php esc_html_e('We are sorry, but the page you are looking for does not exist.', 'enigma'); ?></p>
                    <p><a href="<?php echo esc_url(home_url('/')); ?>">
                            <button class="enigma_send_button" type="submit"><?php esc_html_e('Go To Homepage', 'enigma'); ?></button>
                        </a></p>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>