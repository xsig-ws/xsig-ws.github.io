<?php
/**
 * The Sidebar that is normally displayed on the right side (Secondary).
 *
 * @package Fluida
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) || current_user_can( 'edit_theme_options' ) ): ?>
<aside id="secondary" class="widget-area sidey" <?php cryout_schema_microdata( 'sidebar' );?>>
	<?php cryout_before_secondary_widgets_hook(); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ):
				dynamic_sidebar( 'sidebar-1' );
		  else:
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
			<section class="widget-container widget-placeholder">
				<h2 class="widget-title"><?php _e( 'Right Sidebar', 'fluida' ); ?></h2>
				<p>
					<?php
						printf( __( 'You currently have no widgets set in this sidebar. You can add widgets via the <a href="%s">Dashboard</a>.', 'fluida' ), esc_url( admin_url() . "widgets.php" ) ); echo "<br/>";
						printf( __( 'To hide this sidebar, switch to a different Layout via the <a href="%s">Theme Customizations</a>.', 'fluida' ), esc_url( admin_url() . "customize.php" ) );
					?>
				</p>
			</section>

			<?php }
		  endif; ?>

	<?php cryout_after_primary_widgets_hook(); ?>
</aside>
<?php endif;
