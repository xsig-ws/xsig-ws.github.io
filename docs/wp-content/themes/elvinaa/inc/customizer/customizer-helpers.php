<?php
/**
 * Elvinaa Theme Customizer Helper Functions
 *
 * @package elvinaa
 */



/**
* Render callback for el_topbar_phone
*
* 
* @return mixed
*/
if ( ! function_exists( 'elvinaa_topbar_phone_render_callback' ) ) :
function elvinaa_topbar_phone_render_callback(){
    return wp_kses_post( get_theme_mod( 'el_topbar_phone' ) );
}
endif;

/**
* Render callback for el_home_heading_text
*
* 
* @return mixed
*/
if ( ! function_exists( 'elvinaa_home_heading_text_render_callback' ) ) :
function elvinaa_home_heading_text_render_callback() {
    return wp_kses_post( get_theme_mod( 'el_home_heading_text' ) );
}
endif;

/**
* Render callback for el_home_subheading_text
*
* 
* @return mixed
*/
if ( ! function_exists( 'elvinaa_home_subheading_text_render_callback' ) ) :
function elvinaa_home_subheading_text_render_callback() {
    return wp_kses_post( get_theme_mod( 'el_home_subheading_text' ) );
}
endif;

/**
 * Check if the slider radio enabled or not
 */
function elvinaa_slider_settings_slider_enable( $control ) {
	if ( $control->manager->get_setting( 'el_slide_options_radio' )->value() == 'slider')  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social facebook enabled or not
 */
function elvinaa_topbar_social_facebook_enable( $control ) {
	if ( $control->manager->get_setting( 'el_facebook_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social twitter enabled or not
 */
function elvinaa_topbar_social_twitter_enable( $control ) {
	if ( $control->manager->get_setting( 'el_twitter_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social instagram enabled or not
 */
function elvinaa_topbar_social_instagram_enable( $control ) {
	if ( $control->manager->get_setting( 'el_instagram_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social youtube enabled or not
 */
function elvinaa_topbar_social_youtube_enable( $control ) {
	if ( $control->manager->get_setting( 'el_youtube_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social linkedin enabled or not
 */
function elvinaa_topbar_social_linkedin_enable( $control ) {
	if ( $control->manager->get_setting( 'el_linkedin_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social pinterest enabled or not
 */
function elvinaa_topbar_social_pinterest_enable( $control ) {
	if ( $control->manager->get_setting( 'el_pinterest_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the topbar social rss enabled or not
 */
function elvinaa_topbar_social_rss_enable( $control ) {
	if ( $control->manager->get_setting( 'el_rss_icon' )->value() == true)  {
		return true;
	} else {
		return false;
	}
}