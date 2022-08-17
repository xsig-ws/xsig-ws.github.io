<?php
/**
 * The default template for displaying content
 *
 * @package Fluida
 */

$fluidas = cryout_get_option( array( 'fluida_excerptarchive', 'fluida_excerptsticky', 'fluida_excerpthome' ) );

?><?php cryout_before_article_hook(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); cryout_schema_microdata( 'blogpost' ); ?>>

	<?php if ( false == get_post_format() ) { cryout_featured_hook(); } ?>
	<div class="article-inner">
		<header class="entry-header">
			<?php cryout_post_title_hook(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title"' . cryout_schema_microdata( 'entry-title', 0 )  . '><a href="%s" ' . cryout_schema_microdata( 'mainEntityOfPage', 0 ) . ' rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php cryout_meta_format_hook(); ?>

			<div class="entry-meta">
				<?php cryout_post_meta_hook(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<?php cryout_before_inner_hook();

		$fluida_excerpt_mode = 'excerpt'; // default
		if ( $fluidas['fluida_excerptarchive'] == "full" ) { $fluida_excerpt_mode = 'content'; }
		if ( is_sticky() && $fluidas['fluida_excerptsticky'] == "full" ) { $fluida_excerpt_mode = 'content'; }
		if ( $fluidas['fluida_excerpthome'] == "full" && ! is_archive() && ! is_search() ) { $fluida_excerpt_mode = 'content'; }
		if ( false != get_post_format() ) { $fluida_excerpt_mode = 'content'; }

		switch ( $fluida_excerpt_mode ) {
			case 'content': ?>

				<div class="entry-content" <?php cryout_schema_microdata( 'entry-content' ); ?>>
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fluida' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->

			<?php break;

			case 'excerpt':
			default: ?>

				<div class="entry-summary" <?php cryout_schema_microdata( 'entry-summary' ); ?>>
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<footer class="post-continue-container">
					<?php cryout_post_excerpt_hook(); ?>
				</footer>

			<?php break;
		}; ?>

		<?php cryout_after_inner_hook();  ?>
	</div><!-- .article-inner -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php cryout_after_article_hook(); ?>
