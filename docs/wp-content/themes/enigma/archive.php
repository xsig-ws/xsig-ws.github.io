<?php
 /**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package enigma
 */
 
get_header();
$page_header = absint(get_theme_mod( 'page_header', 1 ));
$class = '';
if ($page_header == 1 ) {  
?>
	<div class="enigma_header_breadcrum_title">	
		<div class="container">
			<div class="row">
			<?php if(have_posts()) :?>
				<div class="col-md-12">
					<h1> <?php the_archive_title(); ?> </h1>
				</div>
			<?php endif; ?>	
			</div>
		</div>	
	</div>
<?php } else {
	$class = 'no-page-header';
} ?>
<div class="container">	
	<div class="row enigma_blog_wrapper <?php echo esc_attr( $class ); ?>">
		<div class="col-md-8">
			<?php 
			if ( have_posts()): 
				while ( have_posts() ): the_post();
					get_template_part('template-parts/post','content'); ?>		
				<?php endwhile; 
			endif; 
			?>
			<div class="text-center wl-theme-pagination">
		        <?php the_posts_pagination() ; ?>
		        <div class="clearfix"></div>
		    </div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>	