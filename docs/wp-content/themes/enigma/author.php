<?php
/**
 * The template for displaying author's Posts
 *
 * Used to display author's Posts if nothing more specific matches a query.
 * For example, puts together date-based Posts if no date.php file exists.
 *
 * If you'd like to further customize these author's views, you may create a
 * new template file for each one. For example, author.php (Author archives), etc.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package enigma
 */

get_header();
$page_header = absint(get_theme_mod( 'page_header', 1 ));
$class = '';
if ( $page_header == 1 ) {  
?>
<div class="enigma_header_breadcrum_title">	
	<div class="container">
		<div class="row">
		<?php if(have_posts()) :?>
			<div class="col-md-12">
			<?php /* translators: %s: author name. */ ?>
			<h1><?php printf( esc_html__( 'Author Archives: %s', 'enigma' ), '<span class="vcard">'. esc_html(get_the_author()) .'</span>' ) ; ?>
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
	<div class="row enigma_blog_wrapper <?php  echo esc_attr( $class ); ?>">
		<div class="col-md-8">
			<?php if ( have_posts()): while ( have_posts() ): the_post();
				get_template_part('template-parts/post','content'); 
			endwhile; 
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