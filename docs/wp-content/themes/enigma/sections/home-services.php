<?php
if ( enigma_theme_is_companion_active() ) {
	$service_home = absint(get_theme_mod( 'service_home','1' )) ;
	if ( $service_home == "1" ) {
    	/* Executes the action for services section hook named 'wl_companion_cservice' */
        do_action( 'wl_companion_service_enigma');
    }
}