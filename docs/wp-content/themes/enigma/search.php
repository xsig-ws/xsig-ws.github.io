<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package enigma
 */

get_header();
$page_header = absint(get_theme_mod( 'page_header', 1 ));
$class = '';
if ($page_header == 1) {
    ?>
    <div class="enigma_header_breadcrum_title">
        <div class="container">
            <div class="row">
                <?php if (have_posts()) : ?>
                    <div class="col-md-12">
                        <?php /* translators: %s: search item. */ ?>
                        <h1><?php printf(esc_html__('Search Results for: %s', 'enigma'), '<span>' . get_search_query() . '</span>'); ?>
                        </h1>
                    </div>
                <?php endif; ?>
               
            </div>
        </div>
    </div>
<?php } else {
    $class = 'no-page-header';
} ?>
    <div class="container">
        <div class="row enigma_blog_wrapper <?php echo esc_attr($class); ?>">
            <div class="col-md-8">
                <?php
                if (have_posts()):
                    while (have_posts()): the_post();
                        get_template_part('template-parts/post', 'content'); ?>
                    <?php endwhile;
                    ?>
                    <div class="text-center wl-theme-pagination">
                        <?php the_posts_pagination() ; ?>
                        <div class="clearfix"></div>
                    </div>
                <?php
                else :
                    get_template_part('template-parts/nocontent');
                endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>