<?php
if ( enigma_theme_is_companion_active() ) {
	$portfolio_home = absint(get_theme_mod( 'portfolio_home','1') );
    if ( $portfolio_home == "1" ) {
       /* Executes the action for portfolios section hook named 'wl_companion_portfolio' */
        do_action( 'wl_companion_portfolio_enigma');
    }
}