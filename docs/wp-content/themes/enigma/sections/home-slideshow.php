<?php
if ( enigma_theme_is_companion_active() ) {
    $slider_home = absint(get_theme_mod('slider_home','1' )) ;
    if( $slider_home == "1" ) {
        /* Executes the action for sliders section hook named 'wl_companion_slider' */
        do_action( 'wl_companion_slider_enigma');
    } else {
        echo '<div class="margin-110  clearfix"> </div>';
    }
}