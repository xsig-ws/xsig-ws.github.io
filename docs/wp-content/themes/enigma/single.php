<?php
/**
 * The Template for displaying all single posts.
 *
 * @package enigma
 */

get_header();
$page_header = absint(get_theme_mod( 'page_header', 1 ));
$class = '';
if ($page_header == 1) {
    get_template_part('breadcrums');
} else {
    $class = 'no-page-header';
}
?>
    <div class="container">
        <div class="row enigma_blog_wrapper <?php echo esc_attr($class); ?>">
            <div class="col-md-8">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/post', 'content');
                endwhile;
                else :
                    get_template_part('template-parts/nocontent');
                endif;
                ?>
                <div class="text-center wl-theme-pagination">
                    <?php the_posts_pagination() ; ?>
                    <div class="clearfix"></div>
                </div>
                <?php 
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div> <!-- row div end here -->
    </div><!-- container div end here -->
<?php get_footer(); ?>