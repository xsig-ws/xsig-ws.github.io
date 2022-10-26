<?php
/**
 * The template for displaying all single posts.
 *
 * @package panoramic
 */

get_header(); ?>

    <?php if ( function_exists( 'bcn_display' ) ) : ?>
        <div class="breadcrumbs">
            <?php bcn_display(); ?>
        </div>
    <?php endif; ?>

	<div id="primary" class="content-area <?php echo !is_active_sidebar( 'sidebar-1' ) ? 'full-width' : ''; ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'library/template-parts/content', 'single' );

			panoramic_post_nav();

			if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
				echo do_shortcode( '[jetpack-related-posts]' );
			}
			
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() ) :
				comments_template();
			endif;

		endwhile; // end of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
