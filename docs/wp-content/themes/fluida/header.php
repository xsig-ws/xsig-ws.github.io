<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <main>
 *
 * @package Fluida
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php cryout_meta_hook(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php
	cryout_header_hook();
	wp_head();
?>
</head>

<body <?php body_class(); cryout_schema_microdata( 'body' );?>>
	<?php do_action( 'wp_body_open' ); ?>
	<?php cryout_body_hook(); ?>
	<div id="site-wrapper">

	<header id="masthead" class="cryout" <?php cryout_schema_microdata( 'header' ) ?>>

		<div id="site-header-main">
			<div id="site-header-main-inside">

				<?php if ( has_nav_menu( 'primary' ) || ( true == cryout_get_option('fluida_pagesmenu') ) ) { ?>
				<nav id="mobile-menu">
					<?php cryout_mobilemenu_hook(); ?>
					<button id="nav-cancel"><i class="blicon-cross3"></i></button>
				</nav> <!-- #mobile-menu -->
				<?php } ?>

				<div id="branding">
					<?php cryout_branding_hook();?>
				</div><!-- #branding -->

				<?php cryout_header_socials_hook();?>

				<?php if ( has_nav_menu( 'primary' ) || ( true == cryout_get_option('fluida_pagesmenu') ) ) { ?>
				<a id="nav-toggle" href="#"><span>&nbsp;</span></a>
				<nav id="access" role="navigation"  aria-label="Primary Menu" <?php cryout_schema_microdata( 'menu' ); ?>>
					<?php cryout_access_hook();?>
				</nav><!-- #access -->
				<?php } ?>

			</div><!-- #site-header-main-inside -->
		</div><!-- #site-header-main -->

		<div id="header-image-main">
			<div id="header-image-main-inside">
				<?php cryout_headerimage_hook(); ?>
			</div><!-- #header-image-main-inside -->
		</div><!-- #header-image-main -->

	</header><!-- #masthead -->

	<?php cryout_breadcrumbs_hook(); ?>

	<?php cryout_absolute_top_hook(); ?>

	<div id="content" class="cryout">
		<?php cryout_main_hook(); ?>
