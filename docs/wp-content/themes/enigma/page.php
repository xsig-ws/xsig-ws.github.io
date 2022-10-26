<?php get_header();
if(is_home() || is_front_page()){
	the_content();
}else{
	$page_header = absint(get_theme_mod( 'page_header', 1 ));
	$class = '';  
	if ( $page_header == 1 ) {
		get_template_part('breadcrums'); 
	} else {
		$class = 'no-page-header';
	} ?>
	<div class="container">
		<div class="row enigma_blog_wrapper  <?php echo esc_attr($class); ?>">
			<?php if (!is_page_template('fullwidth.php')) { ?>
				<div class="col-md-8">
			<?php }else{ ?>
				<div class="col-md-12">
			<?php } ?>
				<?php get_template_part('template-parts/post','page'); ?>	
			
			</div>
			<?php if (!is_page_template('fullwidth.php')) { ?>
				<?php get_sidebar(); ?>	
			<?php } ?>
		</div>
	</div>	
<?php 
}
get_footer(); ?>