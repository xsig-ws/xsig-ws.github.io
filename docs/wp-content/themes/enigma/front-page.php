<?php 
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package enigma
 */

if ( is_page_template( 'home-template.php') ) {
	get_template_part( 'home','template' ); 	
} elseif ( is_page() ) {
	get_template_part( 'page' );
} else {
	get_template_part( 'index' );
} 