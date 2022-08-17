<?php
/**
 * Customizer settings and other theme related settings (fonts arrays, widget areas)
 *
 * @package Fluida
 */

/* active_callback for controls that depend on other controls' values */
function fluida_conditionals( $control ) {

	$conditionals = array(
		array(
			'id'	=> 'fluida_lpsliderimage',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidertitle',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidertext',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidercta1text',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidercta1link',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidercta2text',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidercta2link',
			'parent'=> 'fluida_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpslidershortcode',
			'parent'=> 'fluida_lpslider',
			'value'	=> 2,
		),
		array(
			'id'	=> 'fluida_lpsliderserious',
			'parent'=> 'fluida_lpslider',
			'value' => 4,
		),
		array(
			'id'	=> 'fluida_lpposts',
			'parent'=> 'fluida_landingpage',
			'value'	=> 1,
		),
		array(
			'id'	=> 'fluida_lpposts_more',
			'parent'=> 'fluida_lpposts',
			'value'	=> 1,
		),
		array(
			'id' 	=> 'fluida_titleaccent',
			'parent'=> 'fluida_siteheader',
			'value'	=> 'title',
		),
		array(
			'id' 	=> 'fluida_titleaccent',
			'parent'=> 'fluida_siteheader',
			'value'	=> 'both',
		),
		array(
			'id'    => 'fluida_lppostslayout',
			'parent'=> 'fluida_lpposts',
			'value' => 1,
		),
		array(
			'id'    => 'fluida_lppostscount',
			'parent'=> 'fluida_lpposts',
			'value' => 1,
		),
		array(
			'id'    => 'fluida_lppostscat',
			'parent'=> 'fluida_lpposts',
			'value' => 1,
		),
	);

	foreach ($conditionals as $elem) {
		if ( $control->id == sprintf( '%1$s_settings[%2$s]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), $elem['id'] ) && 
			$control->manager->get_setting( sprintf( '%1$s_settings[%2$s]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), $elem['parent'] ) )->value() == $elem['value'] 
		) return true;
	};

	// handle landing page hint
	if ( ( $control->id == sprintf( '%1$s_settings[%2$s_landingpage_notice]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), _CRYOUT_THEME_PREFIX ) ) && 
		('posts' == get_option('show_on_front')) 
	) return true;
	
	// handle landing page slider banner hint
	if ( ( $control->id == sprintf( '%1$s_settings[%2$s_headerorbannerhint]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), _CRYOUT_THEME_PREFIX ) ) && 
			( $control->manager->get_setting( sprintf( '%1$s_settings[%2$s_landingpage]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), _CRYOUT_THEME_PREFIX ) )->value() == 1 ) && 
			( $control->manager->get_setting( sprintf( '%1$s_settings[%2$s_lpslider]', cryout_sanitize_tn(_CRYOUT_THEME_NAME), _CRYOUT_THEME_PREFIX ) )->value() == 1 ) 
	) return true;

    return false;

} // fluida_conditionals()

$fluida_big = array(

/************* general info ***************/

'info_sections' => array(
	'cryoutspecial-about-theme' => array(
		'title' => apply_filters( 'cryout_about_theme_name', sprintf( __( 'About %s', 'cryout' ), cryout_sanitize_tnl(_CRYOUT_THEME_NAME) ) ),
		'desc' => '<img src=" ' . get_template_directory_uri() . '/admin/images/logo-about-header.png" ><br>',
		'button' => TRUE,
		'button_label' => __( 'Get Plus', 'cryout' ),
	),
), // info_sections

'info_settings' => array(
	'plus_link' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_plus_link', sprintf( '<a class="customizer-plus-link" href="https://www.cryoutcreations.eu/wordpress-themes/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Upgrade to PLUS', 'cryout' ) ) ),
		'desc' =>  apply_filters( 'cryout_about_theme_plus_desc', sprintf( __('Find out what features you\'re missing out on and how the Plus version of %1$s can improve your site.', 'cryout'), cryout_sanitize_tnl( _CRYOUT_THEME_NAME ) ) . '<br><br><img src=" ' . get_template_directory_uri() . '/admin/images/features.png" >' ),
		'section' => 'cryoutspecial-about-theme',
	),
	'support_link_faqs' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_docs_link', sprintf( '<a href="https://www.cryoutcreations.eu/wordpress-themes/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Read the Docs', 'cryout' ) ) ),
		'desc' =>  '',
		'section' => 'cryoutspecial-about-theme',
	),
	'support_link_forum' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_forum_link', sprintf( '<a href="https://www.cryoutcreations.eu/forums/f/wordpress/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Browse the Forum', 'cryout' ) ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
/*	'premium_support_link' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_support_link', sprintf( '<a href="https://www.cryoutcreations.eu/priority-support" target="_blank">%s</a>', __( 'Priority Support', 'cryout' ) ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),*/
	'rating_url' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_review_link', sprintf( '<a href="https://wordpress.org/support/view/theme-reviews/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '#postform" target="_blank">%s</a>', sprintf( __( 'Rate %s on WordPress.org', 'cryout' ) , cryout_sanitize_tnl(_CRYOUT_THEME_NAME) ) ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'management' => array(
		'label' => '',
		'default' => apply_filters( 'cryout_about_theme_manage_link', sprintf( '<a href="themes.php?page=about-' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '-theme">%s</a>', __('Manage Theme Settings', 'cryout') ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
), // info_settings

'panel_overrides' => array(
	'background' => array(
        'title' => __( 'Background', 'cryout' ),
		'desc' => __( 'Background Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-fluida_siteidentity',
		'replaces' => 'background_image',
		'type' => 'section',
	),
	'fluida_header_section' => array(
		'title' => __( 'Header Image', 'cryout' ),
		'desc' => __( 'Header Image Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-fluida_siteidentity',
		'replaces' => 'header_image',
		'type' => 'section',
	),
	'identity' => array(
		'title' => __( 'Site Identity', 'cryout' ),
		'desc' => '',
		'priority' => 50,
		'section' => 'cryoutoverride-fluida_siteidentity',
		'replaces' => 'title_tagline',
		'type' => 'section',
	),
	'colors' => array(
		'section' => 'section',
		'replaces' => 'colors',
		'type' => 'remove',
	),

), // panel_overrides

/************* panels *************/

'panels' => array(

	array('id'=>'fluida_siteidentity', 'title'=>__('Site Identity','fluida'), 'callback'=>'', 'identifier'=>'cryoutoverride-' ),
	array('id'=>'fluida_layout_section', 'title'=>__('Layout','fluida'), 'callback'=>'' ),
	array('id'=>'fluida_header_section', 'title'=>__('Header','fluida'), 'callback'=>'' ),
	array('id'=>'fluida_landingpage', 'title'=>__('Landing Page','fluida'), 'callback'=>'' ),
	array('id'=>'fluida_general_section', 'title'=>__('General','fluida') , 'callback'=>'' ),
	array('id'=>'fluida_colors_section', 'title'=>__('Colors','fluida'), 'callback'=>'' ),
	array('id'=>'fluida_text_section', 'title'=>__('Typography','fluida'), 'callback'=>'' ),
	array('id'=>'fluida_post_section', 'title'=>__('Post Information','fluida') , 'callback'=>'' ),

), // panels

/************* sections *************/

'sections' => array(

	// layout
	array('id'=>'fluida_generallayout', 'title'=>__('General Layout', 'fluida'), 'callback'=>'', 'sid'=>'fluida_layout_section', 'priority'=>50 ),
	array('id'=>'fluida_otherlayout', 'title'=>__('Other Layouts', 'fluida'), 'callback'=>'', 'sid'=>'fluida_layout_section', 'priority'=>60 ),
	// header
	//array('id'=>'fluida_siteheader', 'title'=>__('Header','fluida'), 'callback'=>'', 'sid'=> '', 'priority'=>52 ),
	array('id'=>'fluida_headermenu', 'title'=>__('Menu','fluida'), 'callback'=>'', 'sid'=> 'fluida_header_section', 'priority'=>10 ),
	array('id'=>'fluida_headercontent', 'title'=>__('Content','fluida'), 'callback'=>'', 'sid'=> 'fluida_header_section', 'priority'=>12 ),
	// landing page
	array('id'=>'fluida_lpgeneral', 'title'=>__('Settings','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 10),
	array('id'=>'fluida_lpslider', 'title'=>__('Slider','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 20),
	array('id'=>'fluida_lpblocks1', 'title'=>__('Featured Icon Blocks','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 30 ),
	array('id'=>'fluida_lpboxes1', 'title'=>__('Featured Boxes','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 40),
	array('id'=>'fluida_lpboxes2', 'title'=>__('Featured Boxes 2','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 50),
	array('id'=>'fluida_lptexts', 'title'=>__('Text Areas','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 60),
	array('id'=>'fluida_lpfcontent', 'title'=>__('Featured Content','fluida'), 'callback'=>'', 'sid'=>'fluida_landingpage', 'priority' => 70),
	// text
	array('id'=>'fluida_fontfamily', 'title'=>__('General Font','fluida'), 'callback'=>'', 'sid'=> 'fluida_text_section'),
	array('id'=>'fluida_fontheader', 'title'=>__('Header Fonts','fluida'), 'callback'=>'', 'sid'=> 'fluida_text_section'),
	array('id'=>'fluida_fontcontent', 'title'=>__('Content Fonts','fluida'), 'callback'=>'', 'sid'=> 'fluida_text_section'),
	array('id'=>'fluida_fontwidget', 'title'=>__('Widget Fonts','fluida'), 'callback'=>'', 'sid'=> 'fluida_text_section'),
	array('id'=>'fluida_textformatting', 'title'=>__('Formatting','fluida'), 'callback'=>'', 'sid'=> 'fluida_text_section'),
	// general
	array('id'=>'fluida_contentstructure', 'title'=>__('Structure','fluida'), 'callback'=>'', 'sid'=> 'fluida_general_section'),
	array('id'=>'fluida_contentgraphics', 'title'=>__('Decorations','fluida'), 'callback'=>'', 'sid'=> 'fluida_general_section'),
	array('id'=>'fluida_postimage', 'title'=>__('Content Images','fluida'), 'callback'=>'', 'sid'=> 'fluida_general_section'),
	array('id'=>'fluida_searchbox', 'title'=>__('Search Box Locations','fluida'), 'callback'=>'', 'sid'=> 'fluida_general_section'),
	array('id'=>'fluida_socials', 'title'=>__('Social Icons','fluida'), 'callback'=>'', 'sid'=>'fluida_general_section'),
	// colors
	array('id'=>'fluida_colors', 'title'=>__('Content','fluida'), 'callback'=>'', 'sid'=> 'fluida_colors_section'),
	array('id'=>'fluida_colors_header', 'title'=>__('Header','fluida'), 'callback'=>'', 'sid'=> 'fluida_colors_section'),
	array('id'=>'fluida_colors_footer', 'title'=>__('Footer','fluida'), 'callback'=>'', 'sid'=> 'fluida_colors_section'),
	array('id'=>'fluida_colors_lp', 'title'=>__('Landing Page','fluida'), 'callback'=>'', 'sid'=> 'fluida_colors_section'),
	// post info
	array('id'=>'fluida_featured', 'title'=>__('Featured Image', 'fluida'), 'callback'=>'', 'sid'=>'fluida_post_section', 'priority' => 10),
	array('id'=>'fluida_metas', 'title'=>__('Meta Information','fluida'), 'callback'=>'', 'sid'=> 'fluida_post_section', 'priority' => 20),
	array('id'=>'fluida_excerpts', 'title'=>__('Excerpts','fluida'), 'callback'=>'', 'sid'=> 'fluida_post_section', 'priority' => 30),
	array('id'=>'fluida_comments', 'title'=>__('Comments','fluida'), 'callback'=>'', 'sid'=> 'fluida_post_section', 'priority' => 40),
	// misc
	array('id'=>'fluida_misc', 'title'=>__('Miscellaneous','fluida'), 'callback'=>'', 'sid'=>'', 'priority' => 92 ),

	/*** developer options ***/
	//array('id'=>'fluida_developer', 'title'=>__('[ Developer Options ]','fluida'), 'callback'=>'', 'sid'=>'', 'priority'=>101 ),

), // sections

/************ clone options *********/
'clones' => array (
	'fluida_lpboxes' => 2,
),

/************* settings *************/

'options' => array (
	//////////////////////////////////////////////////// Layout ////////////////////////////////////////////////////
	array(
	// this option needs to always be first; its index is used in the page/post meta option !!!
	'id' => 'fluida_sitelayout',
		'type' => 'radioimage',
		'label' => __('Main Layout','fluida'),
		'choices' => array(
			'1c' => array(
				'label' => __("One column (no sidebars)","fluida"),
				'url'   => '%s/admin/images/1c.png'
			),
			'2cSr' => array(
				'label' => __("Two columns, sidebar on the right","fluida"),
				'url'   => '%s/admin/images/2cSr.png'
			),
			'2cSl' => array(
				'label' => __("Two columns, sidebar on the left","fluida"),
				'url'   => '%s/admin/images/2cSl.png'
			),
			'3cSr' => array(
				'label' => __("Three columns, sidebars on the right","fluida"),
				'url'   => '%s/admin/images/3cSr.png'
			),
			'3cSl' => array(
				'label' => __("Three columns, sidebars on the left","fluida"),
				'url'   => '%s/admin/images/3cSl.png'
			),
			'3cSs' => array(
				'label' => __("Three columns, one sidebar on each side","fluida"),
				'url'   => '%s/admin/images/3cSs.png'
			),
		),
		'desc' => '',
	'section' => 'fluida_generallayout' ),
	array(
	'id' => 'fluida_sitewidth',
		'type' => 'numberslider',
		'label' => __('Site Width','fluida'),
		'min' => 960, 'max' => 1920, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'fluida_generallayout' ),

	array(
	'id' => 'fluida_layoutalign',
		'type' => 'select',
		'label' => __('Theme alignment','fluida'),
		'values' => array( 0, 1, 2, 3 ),
		'labels' => array( __('Left contained','fluida'), __('Left','fluida'), __('Center (default)','fluida'), __('Center contained','fluida') ),
		'desc' => __("Control how the entire theme content is aligned in the browser","fluida"),
	'section' => 'fluida_generallayout' ),

	array(
	'id' => 'fluida_primarysidebar',
		'type' => 'numberslider',
		'label' => __('Left Sidebar Width','fluida'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'fluida_generallayout' ),
	array(
	'id' => 'fluida_secondarysidebar',
		'type' => 'numberslider',
		'label' => __('Right Sidebar Width','fluida'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'fluida_generallayout' ),

	// the other layouts
	array(
	'id' => 'fluida_magazinelayout',
		'type' => 'radioimage',
		'label' => __('Posts Layout','fluida'),
		'choices' => array(
			1 => array(
				'label' => __("One column","fluida"),
				'url'   => '%s/admin/images/magazine-1col.png'
			),
			2 => array(
				'label' => __("Two columns","fluida"),
				'url'   => '%s/admin/images/magazine-2col.png'
			),
			3 => array(
				'label' => __("Three columns","fluida"),
				'url'   => '%s/admin/images/magazine-3col.png'
			),
		),
		'desc' => '',
	'section' => 'fluida_otherlayout' ),
	array(
	'id' => 'fluida_contentmargintop',
		'type' => 'numberslider',
		'label' => __('Margin top','fluida'),
		'min' => 0,
		'max' => 150,
		'step' => 1,
		'um' => 'px',
		'desc' => '',
	'section' => 'fluida_otherlayout' ),
	array(
	'id' => 'fluida_contentpadding',
		'type' => 'numberslider',
		'label' => __('Site left/right padding','fluida'),
		'min' => 0,
		'max' => 500,
		'step' => 1,
		'um' => 'px',
		'desc' => '',
	'section' => 'fluida_otherlayout' ),
	array(
	'id' => 'fluida_elementpadding',
		'type' => 'numberslider',
		'label' => __('Post/page left/right padding','fluida'),
		'min' => 1,
		'max' => 10,
		'step' => 1,
		'um' => '%',
		'desc' => '',
	'section' => 'fluida_otherlayout' ),

	array(
	'id' => 'fluida_footercols',
		'type' => 'select',
		'label' => __("Footer Widgets Columns","fluida"),
		'values' => array(0, 1, 2, 3, 4),
		'labels' => array(
			__('All in a row','fluida'),
			__('1 Column','fluida'),
			__('2 Columns','fluida'),
			__('3 Columns','fluida'),
			__('4 Columns','fluida')
		),
		'desc' => '',
	'section' => 'fluida_otherlayout' ),
	array(
	'id' => 'fluida_footeralign',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Default","fluida"), __("Center","fluida") ),
		'label' => __('Footer Widgets Alignment','fluida'),
		'desc' => "",
	'section' => 'fluida_otherlayout' ),

	// Header-related hint to WP's Site Identity
	array(
	'id' => 'fluida_headerhints',
		'type' => 'notice',
		'label' => '',
		'desc' => sprintf( __( 'Fine tune the visibility of these elements from the theme\'s %s','fluida' ), '<a data-type="section" data-id="cryout-theme_headercontent" class="cryout-customizer-focus"><strong>' . __('Header options', 'fluida') . ' &raquo;</strong></a>' ),
		'input_attrs' => array( 'class' => '' ),
		'priority' => 55,
		'addon' => TRUE, // this option gets added to built-in WordPress section
	'section' => 'title_tagline' ),
	array(
	'id' => 'fluida_headerorbannerhint',
		'type' => 'notice',
		'label' => '',
		'desc' => sprintf( __( 'Configure the image currently visible on the homepage from the theme\'s options under %s','fluida' ), '<a data-type="section" data-id="cryout-theme_lpslider" class="cryout-customizer-focus"><strong>' . __('Landing Page > Slider > Banner Image', 'fluida') . ' &raquo;</strong></a>' ),
		'input_attrs' => array( 'class' => '' ),
		'priority' => 9,
		'active_callback' => 'fluida_conditionals',
		'addon' => TRUE, // this option gets added to built-in WordPress section
	'section' => 'header_image' ),

	// Header
	array(
	'id' => 'fluida_menustyle',
		'type' => 'toggle',
		'values' => array( 0, 1 ),
		'label' => __('Fixed Menu','fluida'),
		'desc' => "",
	'section' => 'fluida_headermenu' ),
	array(
	'id' => 'fluida_menuheight',
		'type' => 'numberslider',
		'min' => 45,
		'max' => 200,
		'step' => 1,
		'um' => 'px',
		'label' => __('Header/Menu Height','fluida'),
		'desc' => "",
	'section' => 'fluida_headermenu' ),
	array(
	'id' => 'fluida_menulayout',
		'type' => 'select',
		'values' => array( 0, 1, 2 ),
		'labels' => array( __("Left", "fluida"), __("Right","fluida"), __("Center","fluida") ),
		'label' => __('Menu Alignment','fluida'),
		'desc' => "",
	'section' => 'fluida_headermenu' ),
	array(
	'id' => 'fluida_siteheader',
		'type' => 'select',
		'label' => __('Site Header Content','fluida'),
		'values' => array( 'title', 'logo' , 'both' , 'empty' ),
		'labels' => array( __("Site Title","fluida"), __("Logo","fluida"), __("Logo & Site Title","fluida"), __("Empty","fluida") ),
		'desc' => '',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_sitetagline',
		'type' => 'checkbox',
		'label' => __('Show Tagline','fluida'),
		'desc' => '',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_logoupload',
		'type' => 'media-image',
		'label' => __('Logo Image','fluida'),
		'desc' => '',
		'disable_if' => 'the_custom_logo',
	'section' => 'fluida_siteheader' ),
	array(
	'id' => 'fluida_identityhints',
		'type' => 'notice',
		'input_attrs' => array( 'class' => '' ),
		'label' => '',
		'desc' => sprintf( __( 'Edit the site\'s title, tagline and logo from the %s panel','fluida' ), '<a data-type="section" data-id="title_tagline" class="cryout-customizer-focus"><strong>' . __('Site Identity', 'fluida') . ' </strong></a>' ),
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_headerheight',
		'type' => 'numberslider',
		'min' => 0,
		'max' => 800,
		'um' => 'px',
		'label' => __('Header Image Height','fluida'),
		'desc' => '',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_headerheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","fluida"),
		//'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_headerresponsive',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Cropped","fluida"), __("Contained","fluida") ),
		'label' => __('Header Image Behaviour','fluida'),
		'desc' => "",
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_titleaccent',
		'type' => 'select',
		'label' => __('Title Accent','fluida'),
		'values' => cryout_gen_values( 0, 20, 1 ),
		'desc' => __('Letter index the accent should apply to. Set to zero to disable accent effect.','fluida'),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_headerwidgetwidth',
		'type' => 'select',
		'label' => __("Header Widget Width","fluida"),
		'values' => array( "100%" , "60%" , "50%" , "33%" , "25%" ),
		'desc' => '',
	'section' => 'fluida_headercontent' ),
	array(
	'id' => 'fluida_headerwidgetalign',
		'type' => 'select',
		'label' => __("Header Widget Alignment","fluida"),
		'values' => array( 'left' , 'center' , 'right' ),
		'labels' => array( __("Left","fluida"), __("Center","fluida"), __("Right","fluida") ),
		'desc' => '',
	'section' => 'fluida_headercontent' ),

	//////////////////////////////////////////////////// Landing Page ////////////////////////////////////////////////////
	array(
	'id' => 'fluida_landingpage',
		'type' => 'select',
		'label' => __('Landing Page','fluida'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","fluida"), __("Disabled (use WordPress homepage)","fluida") ),
		'desc' => '',
	'section' => 'fluida_lpgeneral' ),
	array(
	'id' => 'fluida_landingpage_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => sprintf( __( "To activate the Landing Page, make sure to set the WordPress <strong>Front Page displays</strong> option to %s","fluida" ), "<a data-type='section' data-id='static_front_page' class='cryout-customizer-focus'><strong>" . __("use a static page", "fluida") . " &raquo;</strong></a>" ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpgeneral' ),
	array(
	'id' => 'fluida_lplayout',
		'type' => 'select',
		'label' => __('Layout','fluida'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Contained","fluida"), __("Wide","fluida") ),
		'desc' => '',
	'section' => 'fluida_lpgeneral' ),
	array(
	'id' => 'fluida_lpposts',
		'type' => 'select',
		'label' => __('Featured Content','fluida'),
		'values' => array( 2, 1, 0 ),
		'labels' => array( __("Static Page", "fluida"), __("Posts", "fluida"), __("Disabled", "fluida") ),
		'desc' => '',
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpfcontent' ),
	array(
	'id' => 'fluida_lpposts_more',
		'type' => 'text',
		'label' => __( 'More Posts Label', 'fluida' ),
		'desc' => '',
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpfcontent' ),

	// slider
	array(
	'id' => 'fluida_lpslider',
		'type' => 'select',
		'label' => __('Slider','fluida'),
		'values' => array( 4, 2, 1, 3, 0 ),
		'labels' => array(
			__("Serious Slider", "fluida"),
			__("Use Shortcode","fluida"),
			__("Banner Image","fluida"),
			__("Header Image","fluida"),
			__("Disabled","fluida")
		),
		'desc' => sprintf( __("To create an advanced slider, use our <a href='%s' target='_blank'>Serious Slider</a> plugin or any other slider plugin.","fluida"), 'https://wordpress.org/plugins/cryout-serious-slider/' ),
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpsliderimage',
		'type' => 'media-image',
		'label' => __('Banner Image','fluida'),
		'desc' => __('The default image can be replaced by setting a new banner image.', 'fluida'),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpsliderlink',
		'type' => 'url',
		'label' => __('Slider Link','fluida'),
		'desc' => '',
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidershortcode',
		'type' => 'text',
		'label' => __('Shortcode','fluida'),
		'desc' => __('Enter shortcode provided by slider plugin. The plugin will be responsible for the slider\'s appearance.','fluida'),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpsliderserious',
		'type' => 'select',
		'label' => __('Serious Slider','fluida'),
		'values' => cryout_serious_slides_for_customizer(1, 0),
		'labels' => cryout_serious_slides_for_customizer(2, __(' - Please install, activate or update Serious Slider plugin - ', 'fluida'), __(' - No sliders defined - ', 'fluida') ),
		'desc' => __('Select the desired slider from the list. Sliders can be administered in the dashboard.','fluida'),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidertitle',
		'type' => 'text',
		'label' => __('Caption','fluida'),
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Title', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidertext',
		'type' => 'textarea',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidercta1text',
		'type' => 'text',
		'label' => __('CTA Button','fluida') . ' #1',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidercta1link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidercta2text',
		'type' => 'text',
		'label' => __('CTA Button','fluida') . ' #2',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),
	array(
	'id' => 'fluida_lpslidercta2link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'fluida') ),
		'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_lpslider' ),

	// blocks
	array(
	'id' => 'fluida_lpblockmaintitle#',
		'type' => 'text',
		'label' => __('Section Title','fluida'),
		'desc' => '',
		'priority' => 10,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockmaindesc#',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'fluida' ),
		'desc' => '',
		'priority' => 15,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockspacer1#',
		'type' => 'spacer',
		'priority' => 15,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockscontent#',
		'type' => 'select',
		'label' => __('Blocks Content','fluida'),
		'values' => array( -1, 0, 1, 2 ),
		'labels' => array( __("Disabled","fluida"), __("No Text","fluida"), __("Excerpt","fluida"), __("Full Content","fluida") ),
		'desc' => '',
		'priority' => 20,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblocksreadmore#',
		'type' => 'text',
		'label' => __('Read More Button','fluida'),
		'desc' => __("Configure the 'Read More' link text.","fluida"),
		'priority' => 22,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblocksclick#',
		'type' => 'checkbox',
		'label' => __('Make icons clickable (linking to their respective pages).','fluida'),
		'desc' => '',
		'priority' => 23,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockspacer2#',
		'type' => 'spacer',
		'priority' => 23,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockoneicon#',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','fluida'), 1),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
		'priority' => 25,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockone#',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'desc' => '&nbsp;',
		'priority' => 26,
	'section' => 'fluida_lpblocks#' ),

	array(
	'id' => 'fluida_lpblocktwoicon#',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','fluida'), 2),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
		'priority' => 27,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblocktwo#',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'desc' => '&nbsp;',
		'priority' => 28,
	'section' => 'fluida_lpblocks#' ),

	array(
	'id' => 'fluida_lpblockthreeicon#',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','fluida'), 3),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
		'priority' => 29,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockthree#',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'desc' => '&nbsp;',
		'priority' => 30,
	'section' => 'fluida_lpblocks#' ),

	array(
	'id' => 'fluida_lpblockfouricon#',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','fluida'), 4),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
		'priority' => 31,
	'section' => 'fluida_lpblocks#' ),
	array(
	'id' => 'fluida_lpblockfour#',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'desc' => '&nbsp;',
		'priority' => 32,
	'section' => 'fluida_lpblocks#' ),


	// boxes #cloned#
	array(
	'id' => 'fluida_lpboxmaintitle#',
		'type' => 'text',
		'label' => __('Section Title','fluida'),
		'desc' => '',
		'priority' => 10,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxmaindesc#',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'fluida' ),
		'desc' => '',
		'priority' => 20,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxspacer1#',
		'type' => 'spacer',
		'priority' => 20,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxcat#',
		'type' => 'select',
		'label' => __('Boxes Content','fluida'),
		'values' => cryout_categories_for_customizer(1, __('All Categories', 'fluida'), sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'labels' => cryout_categories_for_customizer(2, __('All Categories', 'fluida'), sprintf( '- %s -', __('Disabled', 'fluida') ) ),
		'desc' => '',
		'priority' => 30,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxcount#',
		'type' => 'numberslider',
		'min' => 1,
		'max' => 30,
		'step' => 1,
		'input_attrs' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => __('Number of Boxes','fluida'),
		'desc' => '',
		'priority' => 40,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxrow#',
		'type' => 'select',
		'label' => __('Boxes Per Row','fluida'),
		'values' => array( 1, 2, 3, 4 ),
		'desc' => '',
		'priority' => 50,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxheight#',
		'type' => 'numberslider',
		'min' => 0,
		'max' => 600,
		'step' => 1,
		'um' => 'px',
		'input_attrs' => array(
			'min' => 1,
			'max' => 2000,
		),
		'label' => __('Box Height','fluida'),
		'desc' => __("The width is a percentage dependent on total site width and number of columns per row.","fluida"),
		'priority' => 60,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxspacer2#',
		'type' => 'spacer',
		'priority' => 60,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxlayout#',
		'type' => 'select',
		'label' => __('Box Layout','fluida'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Full width","fluida"), __("Boxed (content width)","fluida") ),
		'desc' => '',
		'priority' => 70,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxmargins#',
		'type' => 'select',
		'label' => __('Box Stacking','fluida'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Joined","fluida"), __("Apart","fluida") ),
		'desc' => '',
		'priority' => 80,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxanimation#',
		'type' => 'select',
		'label' => __('Box Appearance','fluida'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Animated","fluida"), __("Static","fluida") ),
		'desc' => '',
		'priority' => 90,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxspacer3#',
		'type' => 'spacer',
		'priority' => 91,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxreadmore#',
		'type' => 'text',
		'label' => __('Read More Button','fluida'),
		'desc' => '',
		'priority' => 100,
	'section' => 'fluida_lpboxes#' ),
	array(
	'id' => 'fluida_lpboxlength#',
		'type' => 'numberslider',
		'min' => 1,
		'max' => 100,
		'step' => 1,
		'label' => __('Content Length (words)','fluida'),
		'desc' => '',
		'priority' => 110,
	'section' => 'fluida_lpboxes#' ),

	// texts
	array(
	'id' => 'fluida_lptextone',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','fluida'), 1),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'fluida') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'fluida') ),
		'desc' => '',
	'section' => 'fluida_lptexts' ),
	array(
	'id' => 'fluida_lptexttwo',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','fluida'), 2),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'fluida') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'fluida') ),
		'desc' => '',
	'section' => 'fluida_lptexts' ),
	array(
	'id' => 'fluida_lptextthree',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','fluida'), 3),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'fluida') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'fluida') ),
		'desc' => '',
	'section' => 'fluida_lptexts' ),
	array(
	'id' => 'fluida_lptextfour',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','fluida'), 4),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'fluida') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'fluida') ),
		'desc' => '',
	'section' => 'fluida_lptexts' ),
	array(
	'id' => 'fluida_lptexthint',
		'type' => 'hint',
		'label' => '',
		'desc' => __("Page properties that will be used:<br>- page title as text title<br>- page content as text content<br>- page featured image as text area background image","fluida"),
		'priority' => 99,
	'section' => 'fluida_lptexts' ),

	//////////////////////////////////////////////////// Colors ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_sitebackground',
		'type' => 'color',
		'label' => __('Site Background','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_sitetext',
		'type' => 'color',
		'label' => __('Site Text','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_headingstext',
		'type' => 'color',
		'label' => __('Content Headings','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_contentbackground',
		'type' => 'color',
		'label' => __('Content Background','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_contentbackground2',
		'type' => 'color',
		'label' => __('Secondary Content Background','fluida'),
		'desc' => __('Secondary sidebar','fluida'),
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_colorsspacer2',
		'type' => 'spacer',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_accent1',
		'type' => 'color',
		'label' => __('Primary Accent','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),
	array(
	'id' => 'fluida_accent2',
		'type' => 'color',
		'label' => __('Secondary Accent','fluida'),
		'desc' => '',
	'section' => 'fluida_colors' ),

	array(
	'id' => 'fluida_menubackground',
		'type' => 'color',
		'label' => __('Header Background','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_header' ),
	array(
	'id' => 'fluida_menutext',
		'type' => 'color',
		'label' => __('Menu Text','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_header' ),
	array(
	'id' => 'fluida_submenutext',
		'type' => 'color',
		'label' => __('Submenu Text','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_header' ),
	array(
	'id' => 'fluida_footerbackground',
		'type' => 'color',
		'label' => __('Footer Background','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_footer' ),
	array(
	'id' => 'fluida_footertext',
		'type' => 'color',
		'label' => __('Footer Text','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_footer' ),
	array(
	'id' => 'fluida_lpblocksbg',
		'type' => 'color',
		'label' => __('Blocks','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_lp' ),
	array(
	'id' => 'fluida_lpboxesbg',
		'type' => 'color',
		'label' => __('Boxes','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_lp' ),
	array(
	'id' => 'fluida_lptextsbg',
		'type' => 'color',
		'label' => __('Text Areas','fluida'),
		'desc' => '',
	'section' => 'fluida_colors_lp' ),

	//////////////////////////////////////////////////// Fonts ////////////////////////////////////////////////////
	// general font
	array(
	'id' => 'fluida_fgeneralsize',
		'type' => 'select',
		'label' => __('General Font','fluida'),
		'values' => cryout_gen_values( 10, 26, 1, array('um'=>'px') ),
		'desc' => '',
	'section' => 'fluida_fontfamily' ),
	array(
	'id' => 'fluida_fgeneralweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontfamily' ),
	array(
	'id' => 'fluida_fgeneral',
		'type' => 'font',
		'label' => '',
		'desc' => '',
		'no_inherit' => TRUE,
	'section' => 'fluida_fontfamily' ),
	array(
	'id' => 'fluida_fgeneralgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("The fonts under the <em>Preferred Theme Fonts</em> list are recommended because they have all the font weights used throughout the theme.","fluida"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontfamily' ),

	// header fonts
	array( // site title
	'id' => 'fluida_fsitetitlesize',
		'type' => 'select',
		'label' => __('Site Title','fluida'),
		'values' => cryout_gen_values( 90, 250, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fsitetitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fsitetitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fsitetitlegoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontheader' ),

	array( // menu
	'id' => 'fluida_fmenusize',
		'type' => 'select',
		'label' => __('Main Menu','fluida'),
		'values' => cryout_gen_values( 80, 140, 5, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fmenuweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fmenu',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontheader' ),
	array(
	'id' => 'fluida_fmenugoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontheader' ),

	// widget fonts
	array( // widget title
	'id' => 'fluida_fwtitlesize',
		'type' => 'select',
		'label' => __('Widget Title','fluida'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwtitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwtitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwtitlegoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontwidget' ),

	array(
	'id' => 'fluida_fwcontentsize',
		'type' => 'select',
		'label' => __('Widget Content','fluida'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwcontentweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwcontent',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontwidget' ),
	array(
	'id' => 'fluida_fwcontentgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontwidget' ),

	// content fonts
	array( // post/page
	'id' => 'fluida_ftitlessize',
		'type' => 'select',
		'label' => __('Post/Page Titles','fluida'),
		'values' => cryout_gen_values( 130, 300, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_ftitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_ftitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_ftitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontcontent' ),

	array(
	'id' => 'fluida_fheadingssize',
		'type' => 'select',
		'label' => __('Headings','fluida'),
		'values' => cryout_gen_values( 100, 150, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_fheadingsweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','fluida'), __('200 extra-light','fluida'), __('300 ligher','fluida'), __('400 regular','fluida'), __('500 medium','fluida'), __('600 semi-bold','fluida'), __('700 bold','fluida'), __('800 extra-bold','fluida'), __('900 black','fluida') ),
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_fheadings',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'fluida_fontcontent' ),
	array(
	'id' => 'fluida_fheadingsgoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','fluida') ),
	'section' => 'fluida_fontcontent' ),

	// formatting
	array(
	'id' => 'fluida_lineheight',
		'type' => 'numberslider',
		'label' => __('Line Height','fluida'),
		'min' => 1.0, 'max' => 2.4, 'step' => 0.2, 'um' => 'em',
		'desc' => '',
	'section' => 'fluida_textformatting' ),
	array(
	'id' => 'fluida_textalign',
		'type' => 'select',
		'label' => __('Text Alignment','fluida'),
		'values' => array( "inherit" , "left" , "right" , "justify" , "center" ),
		'labels' => array( __("Default","fluida"), __("Left","fluida"), __("Right","fluida"), __("Justify","fluida"), __("Center","fluida") ),
		'desc' => '',
	'section' => 'fluida_textformatting' ),
	array(
	'id' => 'fluida_paragraphspace',
		'type' => 'numberslider',
		'label' => __('Paragraph Spacing','fluida'),
		'min' => 0, 'max' => 2, 'step' => 0.1, 'um' => 'em',
		'desc' => '',
	'section' => 'fluida_textformatting' ),
	array(
	'id' => 'fluida_parindent',
		'type' => 'numberslider',
		'label' => __('Paragraph Indentation','fluida'),
		'min' => 0, 'max' => 2, 'step' => 0.1, 'um' => 'em',
		'desc' => '',
	'section' => 'fluida_textformatting' ),

	//////////////////////////////////////////////////// Structure ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_breadcrumbs',
		'type' => 'toggle',
		'label' => __('Breadcrumbs','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
	'id' => 'fluida_pagination',
		'type' => 'toggle',
		'label' => __('Numbered Pagination','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
	'id' => 'fluida_contenttitles',
		'type' => 'select',
		'label' => __('Page/Category Titles','fluida'),
		'values' => array( 1, 2, 3, 0 ),
		'labels' => array( __('Always Visible','fluida'), __('Hide on Pages','fluida'), __('Hide on Categories','fluida'), __('Always Hidden','fluida') ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
	'id' => 'fluida_totop',
		'type' => 'select',
		'label' => __('Back to Top Button','fluida'),
		'values' => array( 'fluida-totop-normal', 'fluida-totop-fixed', 'fluida-totop-disabled' ),
		'labels' => array( __("Bottom of page","fluida"), __("In footer","fluida"), __("Disabled","fluida") ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
	'id' => 'fluida_tables',
		'type' => 'select',
		'label' => __('Tables Style','fluida'),
		'values' => array( 'fluida-no-table', 'fluida-clean-table', 'fluida-stripped-table', 'fluida-bordered-table' ),
		'labels' => array( __("No border","fluida"), __("Clean","fluida"), __("Stripped","fluida"), __("Bordered","fluida") ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
	'id' => 'fluida_normalizetags',
		'type' => 'select',
		'label' => __('Tags Cloud Appearance','fluida'),
		'values' => array( 0, 1 ),
		'labels' => array( __("Size Emphasis","fluida"), __("Uniform Boxes","fluida") ),
		'desc' => '',
	'section' => 'fluida_contentstructure' ),
	array(
		'id' => 'fluida_copyright',
		'type' => 'textarea',
		'label' => __( 'Custom Footer Text', 'fluida' ),
		'desc' => __("Insert custom text or basic HTML code that will appear in your footer. <br /> You can use HTML to insert links, images and special characters.","fluida"),
		'section' => 'fluida_contentstructure' ),

	//////////////////////////////////////////////////// Graphics ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_elementborder',
		'type' => 'checkbox',
		'label' => __('Border','fluida'),
		'desc' => '',
	'section' => 'fluida_contentgraphics' ),
	array(
	'id' => 'fluida_elementshadow',
		'type' => 'checkbox',
		'label' => __('Shadow','fluida'),
		'desc' => '',
	'section' => 'fluida_contentgraphics' ),
	array(
	'id' => 'fluida_elementborderradius',
		'type' => 'checkbox',
		'label' => __('Rounded Corners','fluida'),
		'desc' => __('These decorations apply to certain theme elements.','fluida'),
	'section' => 'fluida_contentgraphics' ),
	array(
	'id' => 'fluida_articleanimation',
		'type' => 'select',
		'label' => __('Article Animation on Scroll','fluida'),
		'values' => array( 'none', 'fade', 'slide', 'grow'),
		'labels' => array( __("None","fluida"), __("Fade","fluida"), __("Slide","fluida"), __("Grow","fluida") ),
		'desc' => '',
	'section' => 'fluida_contentgraphics' ),

	//////////////////////////////////////////////////// Search Box ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_searchboxmain',
		'type' => 'checkbox',
		'label' => __('Add Search to Main Menu','fluida'),
		'desc' => '',
	'section' => 'fluida_searchbox' ),
	array(
	'id' => 'fluida_searchboxfooter',
		'type' => 'checkbox',
		'label' => __('Add Search to Footer Menu','fluida'),
		'desc' => '',
	'section' => 'fluida_searchbox' ),

	//////////////////////////////////////////////////// Content Image ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_image_style',
		'type' => 'radioimage',
		'label' => __('Post Images','fluida'),
		'choices' => array(
			'fluida-image-none' => array(
				'label' => __("No Styling","fluida"),
				'url'   => '%s/admin/images/image-style-0.png'
			),
			'fluida-image-one' => array(
				'label' => sprintf( __("Style %d","fluida"), 1),
				'url'   => '%s/admin/images/image-style-1.png'
			),
			'fluida-image-two' => array(
				'label' => sprintf( __("Style %d","fluida"), 2),
				'url'   => '%s/admin/images/image-style-2.png'
			),
			'fluida-image-three' => array(
				'label' => sprintf( __("Style %d","fluida"), 3),
				'url'   => '%s/admin/images/image-style-3.png'
			),
			'fluida-image-four' => array(
				'label' => sprintf( __("Style %d","fluida"), 4),
				'url'   => '%s/admin/images/image-style-4.png'
			),
			'fluida-image-five' => array(
				'label' => sprintf( __("Style %d","fluida"), 5),
				'url'   => '%s/admin/images/image-style-5.png'
			),
		),
		'desc' => '',
	'section' => 'fluida_postimage' ),
	array(
	'id' => 'fluida_caption_style',
		'type' => 'select',
		'label' => __('Post Captions','fluida'),
		'values' => array( 'fluida-caption-zero', 'fluida-caption-one', 'fluida-caption-two' ),
		'labels' => array( __('Plain','fluida'), __('With Border','fluida'), __('With Background','fluida') ),
		'desc' => '',
	'section' => 'fluida_postimage' ),


	//////////////////////////////////////////////////// Post Information ////////////////////////////////////////////////////

	array( // meta
	'id' => 'fluida_meta_author',
		'type' => 'checkbox',
		'label' => __("Display Author","fluida"),
		'desc' => '',
	'section' => 'fluida_metas' ),
	array(
	'id' => 'fluida_meta_date',
		'type' => 'checkbox',
		'label' => __("Display Date","fluida"),
		'desc' => '',
	'section' => 'fluida_metas' ),
	array(
	'id' => 'fluida_meta_time',
		'type' => 'checkbox',
		'label' => __("Display Time","fluida"),
		'desc' => '',
	'section' => 'fluida_metas' ),
	array(
	'id' => 'fluida_meta_category',
		'type' => 'checkbox',
		'label' => __("Display Category","fluida"),
		'desc' => '',
	'section' => 'fluida_metas' ),
	array(
	'id' => 'fluida_meta_tag',
		'type' => 'checkbox',
		'label' => __("Display Tags","fluida"),
		'desc' => '',
	'section' => 'fluida_metas' ),
	array(
	'id' => 'fluida_meta_comment',
		'type' => 'checkbox',
		'label' => __("Display Comments","fluida"),
		'desc' => __("Choose meta information to show on posts.","fluida"),
	'section' => 'fluida_metas' ),

	// excerpts
	array(
	'id' => 'fluida_excerpthome',
		'type' => 'select',
		'label' => __( 'Standard Posts On Homepage', 'fluida' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","fluida"), __("Full Post","fluida") ),
		'desc' => __("Post formats always display full posts.","fluida"),
	'section' => 'fluida_excerpts' ),
	array(
	'id' => 'fluida_excerptsticky',
		'type' => 'select',
		'label' => __( 'Sticky Posts on Homepage', 'fluida' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Inherit","fluida"), __("Full Post","fluida") ),
		'desc' => '',
	'section' => 'fluida_excerpts' ),
	array(
	'id' => 'fluida_excerptarchive',
		'type' => 'select',
		'label' => __( 'Standard Posts in Categories/Archives', 'fluida' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","fluida"), __("Full Post","fluida") ),
		'desc' => '',
	'section' => 'fluida_excerpts' ),
	array(
	'id' => 'fluida_excerptlength',
		'type' => 'numberslider',
		'min' => 0,
		'max' => 100,
		'step' => 1,
		'label' => __( 'Excerpt Length (words)' , 'fluida' ),
		'desc' => '',
	'section' => 'fluida_excerpts' ),
	array(
	'id' => 'fluida_excerptdots',
		'type' => 'text',
		'label' => __( 'Excerpt Suffix', 'fluida' ),
		'desc' => '',
	'section' => 'fluida_excerpts' ),
	array(
	'id' => 'fluida_excerptcont',
		'type' => 'text',
		'label' => __( 'Continue Reading Label', 'fluida' ),
		'desc' => '',
	'section' => 'fluida_excerpts' ),

	// comments
	array(
	'id' => 'fluida_comclosed',
		'type' => 'select',
		'label' => __("'Comments Are Closed' Text",'fluida'),
		'values' => array( 1, 2, 3, 0 ), // "Show" , "Hide in posts", "Hide in pages", "Hide everywhere"
		'labels' => array( __("Show","fluida"), __("Hide in posts","fluida"), __("Hide in pages","fluida"), __("Hide everywhere","fluida") ),
		'desc' => '',
	'section' => 'fluida_comments' ),
	array(
	'id' => 'fluida_comdate',
		'type' => 'select',
		'label' => __('Comment Date Format','fluida'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Specific","fluida"), __("Relative","fluida") ),
		'desc' => '',
	'section' => 'fluida_comments' ),
	array(
	'id' => 'fluida_comlabels',
		'type' => 'select',
		'label' => __('Comment Field Label','fluida'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Placeholders","fluida"), __("Labels","fluida") ),
		'desc' => __("Change to labels for better compatibility with comment-related plugins.","fluida"),
	'section' => 'fluida_comments' ),
	array(
	'id' => 'fluida_comformwidth',
		'type' => 'numberslider',
		'min' => 0,
		'max' => 1000,
		'step' => 10,
		'um' => 'px',
		'label' => __('Comment Form Width','fluida'),
		'desc' => '',
	'section' => 'fluida_comments' ),

	//////////////////////////////////////////////////// Featured Images ////////////////////////////////////////////////////
	array(
	'id' => 'fluida_fpost',
		'type' => 'toggle',
		'label' => __( 'Featured Images', 'fluida' ),
		'values' => array( 1, 0 ),
		'desc' => '',
	'section' => 'fluida_featured' ),
	array(
	'id' => 'fluida_fauto',
		'type' => 'toggle',
		'label' => __( 'Auto Select Image From Content', 'fluida' ),
		'values' => array( 1, 0 ),
		'desc' => '',
	'section' => 'fluida_featured' ),
	array(
	'id' => 'fluida_fheight',
		'type' => 'numberslider',
		'min' => 0,
		'max' => 800,
		'step' => 10,
		'um' => 'px',
		'label' => __( 'Featured Image Height', 'fluida' ),
		'desc' => __( 'Set to 0 to disable image processing', 'fluida' ),
	'section' => 'fluida_featured' ),
	array(
	'id' => 'fluida_fheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","fluida"),
		//'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_featured' ),
	array(
	'id' => 'fluida_fresponsive',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Cropped","fluida"), __("Contained","fluida") ),
		'label' => __('Featured Image Behaviour','fluida'),
		'desc' => __("<strong>Contained</strong> will scale depending on the viewed resolution<br><strong>Cropped</strong> will try to keep the configured height.","fluida"),
	'section' => 'fluida_featured' ),
	array(
	'id' => 'fluida_falign',
		'type' => 'select',
		'label' => __( 'Featured Image Crop Position', 'fluida' ),
		'values' => array( false, "left top" , "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom" ),
		'labels' => array( __("No Crop","fluida"), __("Left Top","fluida"), __("Left Center","fluida"), __("Left Bottom","fluida"), __("Right Top","fluida"), __("Right Center","fluida"), __("Right Bottom","fluida"), __("Center Top","fluida"), __("Center Center","fluida"), __("Center Bottom","fluida") ),
		'desc' => '',
	'section' => 'fluida_featured' ),

	array(
	'id' => 'fluida_falign_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","fluida"),
		//'active_callback' => 'fluida_conditionals',
	'section' => 'fluida_featured' ),

	array(
	'id' => 'fluida_fheader',
		'type' => 'toggle',
		'label' => __('Use Featured Images in Header','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
	'section' => 'fluida_featured' ),

	//////////////////////////////////////////////////// Social Positions ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_socials_header',
		'type' => 'checkbox',
		'label' => __( 'Display in Header', 'fluida' ),
		'desc' => '',
	'section' => 'fluida_socials' ),
	array(
	'id' => 'fluida_socials_footer',
		'type' => 'checkbox',
		'label' => __( 'Display in Footer', 'fluida' ),
		'desc' => '',
	'section' => 'fluida_socials' ),
	array(
	'id' => 'fluida_socials_left_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Left Sidebar', 'fluida' ),
		'desc' => '',
	'section' => 'fluida_socials' ),
	array(
	'id' => 'fluida_socials_right_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Right Sidebar', 'fluida' ),
		'desc' => sprintf( __( 'Select where social icons should be displayed.<br><br><strong>Social Icons are defined using the <a href="%1$s" target="_blank">socials menu</a></strong>. Read the <a href="%2$s" target="_blank">theme documentation</a> for detailed information.', 'fluida' ), 'nav-menus.php?action=locations', 'http://www.cryoutcreations.eu/wordpress-tutorials/use-new-social-menu' ),
	'section' => 'fluida_socials' ),

	//////////////////////////////////////////////////// Miscellaneous ////////////////////////////////////////////////////

	array(
	'id' => 'fluida_pagesmenu',
		'type' => 'toggle',
		'label' => __( 'Default Pages Menu', 'fluida' ),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 3,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_masonry',
		'type' => 'toggle',
		'label' => __('Masonry','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 3,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_defer',
		'type' => 'toggle',
		'label' => __('JS Defer loading','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 3,
	'section' => 'fluida_misc' ),

	array(
	'id' => 'fluida_autoscroll',
		'type' => 'toggle',
		'label' => __('Autoscroll','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 4,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_headerlimits',
		'type' => 'toggle',
		'label' => __('Header image size requirements','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 4,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_mobileonios',
		'type' => 'toggle',
		'label' => __( 'Force mobile menu on iOS mobile devices', 'fluida' ),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 4,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_editorstyles',
		'type' => 'toggle',
		'label' => __('Editor Styles','fluida'),
		'values' => array( 1, 0 ),
		'desc' => '',
		'priority' => 4,
	'section' => 'fluida_misc' ),
	array(
	'id' => 'fluida_fitvids',
		'type' => 'select',
		'label' => __('FitVids','fluida'),
		'values' => array( 1, 2, 0 ),
		'labels' => array( __("Enable","fluida"), __("Enable on mobiles","fluida"), __("Disable","fluida") ),
		'desc' => __("<br>Only use these options to troubleshoot issues.","fluida"),
		'priority' => 6,
	'section' => 'fluida_misc' ),
	//////////////////////////////////////////////////// !!! DEVELOPER !!! ////////////////////////////////////////////////////
	// nothing for now

), // options

/* option=array(
	type: checkbox, select, textarea, input, function
	id: field_name or custom_function_name
	values: value_0, value_1, value_2 | true/false | number
	labels: __('Label 0','context'), ... | __('Enabled','context')/... |  number/__('Once','context')/...
	desc: html to be displayed at the question mark
	section: section_id

	array(
	'id' => '',
		'type' => '',
		'label' => '',
		'values' => array(  ),
		'labels' => array(  ),
		'desc' => '',
		'input_attrs' => array(  ),
		// conditionals
		'disable_if' => 'function_name',
		'require_fn' => 'function_name',
		// extra
		'addon' => TRUE, // option gets added to core sections
		'display_width' => '?????',
	'section' => '' ),

*/

/*** fonts ***/
'fonts' => array(

	'Inherit' => array( // capitalization matters
		'Inherit General Font',
	),
	'Preferred Theme Fonts'=> array(
					"Source Sans Pro/gfont",
					"Ubuntu/gfont",
					"Ubuntu Condensed/gfont",
					"Open Sans/gfont",
					"Open Sans Condensed:300/gfont",
					"Droid Sans/gfont",
					"Oswald/gfont",
					"Yanone Kaffeesatz/gfont",
					),
	'Sans-Serif' => array(
					"Segoe UI, Arial, sans-serif",
					"Verdana, Geneva, sans-serif" ,
					"Geneva, sans-serif",
					"Helvetica Neue, Arial, Helvetica, sans-serif",
					"Helvetica, sans-serif" ,
					"Century Gothic, AppleGothic, sans-serif",
				    "Futura, Century Gothic, AppleGothic, sans-serif",
					"Calibri, Arian, sans-serif",
				    "Myriad Pro, Myriad,Arial, sans-serif",
					"Trebuchet MS, Arial, Helvetica, sans-serif" ,
					"Gill Sans, Calibri, Trebuchet MS, sans-serif",
					"Impact, Haettenschweiler, Arial Narrow Bold, sans-serif",
					"Tahoma, Geneva, sans-serif" ,
					"Arial, Helvetica, sans-serif" ,
					"Arial Black, Gadget, sans-serif",
					"Lucida Sans Unicode, Lucida Grande, sans-serif"
					),
	'Serif' => array(
					"Georgia, Times New Roman, Times, serif",
					"Times New Roman, Times, serif",
					"Cambria, Georgia, Times, Times New Roman, serif",
					"Palatino Linotype, Book Antiqua, Palatino, serif",
					"Book Antiqua, Palatino, serif",
					"Palatino, serif",
				    "Baskerville, Times New Roman, Times, serif",
 					"Bodoni MT, serif",
					"Copperplate Light, Copperplate Gothic Light, serif",
					"Garamond, Times New Roman, Times, serif"
					),
	'MonoSpace' => array(
					"Courier New, Courier, monospace" ,
					"Lucida Console, Monaco, monospace",
					"Consolas, Lucida Console, Monaco, monospace",
					"Monaco, monospace"
					),
	'Cursive' => array(
					"Lucida Casual, Comic Sans MS, cursive",
				    "Brush Script MT, Phyllis, Lucida Handwriting, cursive",
					"Phyllis, Lucida Handwriting, cursive",
					"Lucida Handwriting, cursive",
					"Comic Sans MS, cursive"
					),
	'Advanced' => array(
					"* Local Font *",
					),
	), // fonts

	/*** google font option fields ***/
	'google-font-enabled-fields' => array(
		'fluida_fgeneral',
		'fluida_fsitetitle',
		'fluida_fmenu',
		'fluida_fwtitle',
		'fluida_fwcontent',
		'fluida_ftitles',
		'fluida_fheadings',
		),

	// ! The icons lists are reused in multiple locations; make sure to update all when needed !

	/*** landing page blocks icons ***/
	'block-icons' => array(
		'toggle' => 'e003',
		'layout' => 'e004',
		'lock' => 'e007',
		'unlock' => 'e008',
		'target' => 'e012',
		'disc' => 'e019',
		'microphone' => 'e048',
		'play' => 'e052',
		'cloud2' => 'e065',
		'cloud-upload' => 'e066',
		'cloud-download' => 'e067',
		'plus2' => 'e114',
		'minus2' => 'e115',
		'check2' => 'e116',
		'cross2' => 'e117',
		'users2' => 'e00a',
		'user' => 'e00b',
		'trophy' => 'e00c',
		'speedometer' => 'e00d',
		'screen-tablet' => 'e00f',
		'screen-smartphone' => 'e01a',
		'screen-desktop' => 'e01b',
		'plane' => 'e01c',
		'notebook' => 'e01d',
		'magic-wand' => 'e01e',
		'hourglass2' => 'e01f',
		'graduation' => 'e02a',
		'fire' => 'e02b',
		'eyeglass' => 'e02c',
		'energy' => 'e02d',
		'chemistry' => 'e02e',
		'bell' => 'e02f',
		'badge' => 'e03a',
		'speech' => 'e03b',
		'puzzle' => 'e03c',
		'printer' => 'e03d',
		'present' => 'e03e',
		'pin' => 'e03f',
		'picture2' => 'e04a',
		'map' => 'e04b',
		'layers' => 'e04c',
		'globe' => 'e04d',
		'globe2' => 'e04e',
		'folder' => 'e04f',
		'feed' => 'e05a',
		'drop' => 'e05b',
		'drawar' => 'e05c',
		'docs' => 'e05d',
		'directions' => 'e05e',
		'direction' => 'e05f',
		'cup2' => 'e06b',
		'compass' => 'e06c',
		'calculator' => 'e06d',
		'bubbles' => 'e06e',
		'briefcase' => 'e06f',
		'book-open' => 'e07a',
		'basket' => 'e07b',
		'bag' => 'e07c',
		'wrench' => 'e07f',
		'umbrella' => 'e08a',
		'tag' => 'e08c',
		'support' => 'e08d',
		'share' => 'e08e',
		'share2' => 'e08f',
		'rocket' => 'e09a',
		'question' => 'e09b',
		'pie-chart2' => 'e09c',
		'pencil2' => 'e09d',
		'note' => 'e09e',
		'music-tone-alt' => 'e09f',
		'list2' => 'e0a0',
		'like' => 'e0a1',
		'home2' => 'e0a2',
		'grid' => 'e0a3',
		'graph' => 'e0a4',
		'equalizer' => 'e0a5',
		'dislike' => 'e0a6',
		'calender' => 'e0a7',
		'bulb' => 'e0a8',
		'chart' => 'e0a9',
		'clock' => 'e0af',
		'envolope' => 'e0b1',
		'flag' => 'e0b3',
		'folder2' => 'e0b4',
		'heart2' => 'e0b5',
		'info' => 'e0b6',
		'link' => 'e0b7',
		'refresh' => 'e0bc',
		'reload' => 'e0bd',
		'settings' => 'e0be',
		'arrow-down' => 'e604',
		'arrow-left' => 'e605',
		'arrow-right' => 'e606',
		'arrow-up' => 'e607',
		'paypal' => 'e608',
		'home' => 'e800',
		'apartment' => 'e801',
		'data' => 'e80e',
		'cog' => 'e810',
		'star' => 'e814',
		'star-half' => 'e815',
		'star-empty' => 'e816',
		'paperclip' => 'e819',
		'eye2' => 'e81b',
		'license' => 'e822',
		'picture' => 'e827',
		'book' => 'e828',
		'bookmark' => 'e829',
		'users' => 'e82b',
		'store' => 'e82d',
		'calendar' => 'e836',
		'keyboard' => 'e837',
		'spell-check' => 'e838',
		'screen' => 'e839',
		'smartphone' => 'e83a',
		'tablet' => 'e83b',
		'laptop' => 'e83c',
		'laptop-phone' => 'e83d',
		'construction' => 'e841',
		'pie-chart' => 'e842',
		'gift' => 'e844',
		'diamond' => 'e845',
		'cup3' => 'e848',
		'leaf' => 'e849',
		'earth' => 'e853',
		'bullhorn' => 'e859',
		'hourglass' => 'e85f',
		'undo' => 'e860',
		'redo' => 'e861',
		'sync' => 'e862',
		'history' => 'e863',
		'download' => 'e865',
		'upload' => 'e866',
		'bug' => 'e869',
		'code' => 'e86a',
		'link2' => 'e86b',
		'unlink' => 'e86c',
		'thumbs-up' => 'e86d',
		'thumbs-down' => 'e86e',
		'magnifier' => 'e86f',
		'cross3' => 'e870',
		'menu' => 'e871',
		'list' => 'e872',
		'warning' => 'e87c',
		'question-circle' => 'e87d',
		'check' => 'e87f',
		'cross' => 'e880',
		'plus' => 'e881',
		'minus' => 'e882',
		'layers2' => 'e88e',
		'text-format' => 'e890',
		'text-size' => 'e892',
		'hand' => 'e8a5',
		'pointer-up' => 'e8a6',
		'pointer-right' => 'e8a7',
		'pointer-down' => 'e8a8',
		'pointer-left' => 'e8a9',
		'heart' => 'e930',
		'cloud' => 'e931',
		'trash' => 'e933',
		'user2' => 'e934',
		'key' => 'e935',
		'search' => 'e936',
		'settings2' => 'e937',
		'camera' => 'e938',
		'tag2' => 'e939',
		'bulb2' => 'e93a',
		'pencil' => 'e93b',
		'diamond2' => 'e93c',
		'location' => 'e93e',
		'eye' => 'e93f',
		'bubble' => 'e940',
		'stack' => 'e941',
		'cup' => 'e942',
		'phone' => 'e943',
		'news' => 'e944',
		'mail' => 'e945',
		'news2' => 'e948',
		'paperplane' => 'e949',
		'params2' => 'e94a',
		'data2' => 'e94b',
		'megaphone' => 'e94c',
		'study' => 'e94d',
		'chemistry2' => 'e94e',
		'fire2' => 'e94f',
		'paperclip2' => 'e950',
		'calendar2' => 'e951',
		'wallet' => 'e952',
		),

	'meta-icons' => array(
		'status' => 'e81a',
		'aside' => 'e82a',
		'link' => 'e818',
		'audio' => 'e823',
		'video' => 'e829',
		'image' => 'e824',
		'gallery' => 'e825',
		'quote' => 'e80f',
		'search' => 'e816',
		'down-dir' => 'e803',
		'right-dir' => 'e806',
		'angle-left' => 'e807',
		'angle-right' => 'e808',
		'angle-up' => 'e809',
		'angle-down' => 'e80a',
		'minus' => 'e80b',
		'left-open' => 'e80c',
		'up' => 'e80e',
		'left-dir' => 'e811',
		'up-open' => 'e812',
		'ok' => 'e813',
		'cancel' => 'e814',
		'up-dir' => 'e819',
		'right-open' => 'e81e',
		'home' => 'e81f',
		'menu' => 'e820',
		'plus' => 'e821',
		'down-open' => 'e822',
		'down' => 'e826',
		'left' => 'e827',
		'right' => 'e828',
		'star-empty' => 'e82c',
		'star' => 'e82d',
		'mail' => 'e82e',
		'home-1' => 'e82f',
		'attach' => 'e830',
		'eye' => 'e831',
		'eye-off' => 'e832',
		'tags' => 'e833',
		'flag' => 'e834',
		'warning' => 'e835',
		'location' => 'e836',
		'trash' => 'e837',
		'doc' => 'e838',
		'phone' => 'e839',
		'cog' => 'e83a',
		'basket' => 'e83b',
		'basket-circled' => 'e83c',
		'wrench' => 'e83d',
		'wrench-circled' => 'e83e',
		'mic' => 'e83f',
		'volume' => 'e840',
		'volume-down' => 'e841',
		'volume-off' => 'e842',
		'headphones' => 'e843',
		'lightbulb' => 'e844',
		'resize-full' => 'e845',
		'resize-full-alt' => 'e846',
		'resize-small' => 'e847',
		'resize-vertical' => 'e848',
		'resize-horizontal' => 'e849',
		'move' => 'e84a',
		'zoom-in' => 'e84b',
		'zoom-out' => 'e84c',
		'arrows-cw' => 'e84d',
		'desktop' => 'e84e',
		'inbox' => 'e84f',
		'cloud' => 'e850',
		'book' => 'e851',
		'certificate' => 'e852',
		'tasks' => 'e853',
		'thumbs-up' => 'e854',
		'thumbs-down' => 'e855',
		'help-circled' => 'e856',
		'star-circled' => 'e857',
		'bell' => 'e858',
		'rss' => 'e859',
		'trash-circled' => 'e85a',
		'cogs' => 'e85b',
		'cog-circled' => 'e85c',
		'calendar-circled' => 'e85d',
		'mic-circled' => 'e85e',
		'volume-up' => 'e85f',
		'print' => 'e860',
		'edit-alt' => 'e861',
		'edit-2' => 'e862',
		'block' => 'e863',
	),

	'social-icons' => array(

		'duckduckgo' => 'e801',
		'aim' => 'e802',
		'delicious' => 'e803',
		'paypal' => 'e804',
		'flattr' => 'e805',
		'android' => 'e806',
		'eventful' => 'e807',
		'smashingmagazine' => 'e808',
		'googleplus' => 'e809',
		'wikipedia' => 'e80a',
		'lanyrd' => 'e80b',
		'calendar' => 'e80c',
		'stumbleupon' => 'e80d',
		'500px' => 'e80e',
		'pinterest' => 'e80f',
		'bitcoin' => 'e810',
		'firefox' => 'e811',
		'foursquare' => 'e812',
		'chrome' => 'e813',
		'internetexplorer' => 'e814',
		'phone' => 'e815',
		'grooveshark' => 'e816',
		'99designs' => 'e817',
		'code' => 'e818',
		'digg' => 'e819',
		'spotify' => 'e81a',
		'reddit' => 'e81b',
		'about' => 'e81c',
		'codeopen' => 'e81d',
		'appstore' => 'e81e',
		'creativecommons' => 'e820',
		'dribbble' => 'e821',
		'evernote' => 'e822',
		'flickr' => 'e823',
		'link2' => 'e824',
		'viadeo' => 'e825',
		'instapaper' => 'e826',
		'weibo' => 'e827',
		'klout' => 'e828',
		'linkedin' => 'e829',
		'meetup' => 'e82a',
		'vk' => 'e82b',
		'plancast' => 'e82c',
		'disqus' => 'e82d',
		'feed' => 'e82e',
		'skype' => 'e82f',
		'twitter' => 'e830',
		'youtube' => 'e831',
		'vimeo' => 'e832',
		'windows' => 'e833',
		'xing' => 'e834',
		'yahoo' => 'e835',
		'email' => 'e837',
		'cloud' => 'e838',
		'myspace' => 'e839',
		'podcast' => 'e83a',
		'amazon' => 'e83b',
		'steam' => 'e83c',
		'link' => 'e83d',
		'dropbox' => 'e83e',
		'ebay' => 'e83f',
		'facebook' => 'e840',
		'github2' => 'e841',
		'github' => 'e842',
		'googleplay' => 'e843',
		'itunes' => 'e844',
		'plurk' => 'e845',
		'songkick' => 'e846',
		'lastfm' => 'e847',
		'gmail' => 'e848',
		'pinboard' => 'e849',
		'openid' => 'e84a',
		'quora' => 'e84b',
		'soundcloud' => 'e84c',
		'tumblr' => 'e84d',
		'wordpress' => 'e84f',
		'yelp' => 'e850',
		'intensedebate' => 'e851',
		'eventbrite' => 'e852',
		'scribd' => 'e853',
		'stripe' => 'e855',
		'opentable' => 'e856',
		'cart' => 'e857',
		'opera' => 'e858',
		'angellist' => 'e859',
		'instagram' => 'e85a',
		'dwolla' => 'e85b',
		'appnet' => 'e85c',
		'drupal' => 'e85f',
		'buffer' => 'e860',
		'pocket' => 'e861',
		'bitbucket' => 'e862',
		'phone2' => 'e863',
		'stackoverflow' => 'e865',
		'hackernews' => 'e866',
		'lkdto' => 'e867',
		'twitter2' => 'e868',
		'phone3' => 'e869',
		'mobile' => 'e86a',
		'support' => 'e86b',
		'twitch' => 'e86c',
		'beer' => 'e86d',
	),

/*** ajax load more identifiers ***/
'theme_identifiers' => array(
	'load_more_optid' 			=> 'fluida_lpposts_more',
	'content_css_selector' 		=> '#lp-posts .lp-posts-inside',
	'pagination_css_selector' 	=> '#lp-posts nav.navigation',
),

/************* widget areas *************/

'widget-areas' => array(
	'sidebar-2' => array(
		'name' => __( 'Sidebar Left', 'fluida' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'sidebar-1' => array(
		'name' => __( 'Sidebar Right', 'fluida' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'footer-widget-area' => array(
		'name' => __( 'Footer', 'fluida' ),
		'description' 	=> __('You can configure how many columns the footer displays from the theme options', 'fluida'),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="footer-widget-inside">',
		'after_widget' => '</div></section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-before' => array(
		'name' => __( 'Content Before', 'fluida' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-after' => array(
		'name' => __( 'Content After', 'fluida' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'widget-area-header' => array(
		'name' => __( 'Header', 'fluida' ),
		'description' 	=> __('This widget area is displayed over the header image and requires an image to be set.', 'fluida'),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
), // widget-areas

'migration' => array(
	'1.35' => array(
		//'fluida_old_key' => 'fluida_new_key',
		'fluida_lpblockmaintitle'	=> 'fluida_lpblockmaintitle1', // icon blocks
		'fluida_lpblockmaindesc'	=> 'fluida_lpblockmaindesc1',
		'fluida_lpblockscontent' 	=> 'fluida_lpblockscontent1',
		'fluida_lpblockoneicon' 	=> 'fluida_lpblockoneicon1',
		'fluida_lpblockone' 		=> 'fluida_lpblockone1',
		'fluida_lpblocktwoicon' 	=> 'fluida_lpblocktwoicon1',
		'fluida_lpblocktwo' 		=> 'fluida_lpblocktwo1',
		'fluida_lpblockthreeicon' 	=> 'fluida_lpblockthreeicon1',
		'fluida_lpblockthree' 		=> 'fluida_lpblockthree1',
		'fluida_lpblockfouricon' 	=> 'fluida_lpblockfouricon1',
		'fluida_lpblockfour' 		=> 'fluida_lpblockfour1',
		'fluida_lpblocksclick' 		=> 'fluida_lpblocksclick1',
	) // 1.3.5
),	// migration

); // $fluida_big

// sort block icons alphabetically
ksort( $fluida_big['block-icons'] );
$fluida_big['block-icons'] = array_merge( array( 'no-icon' => '&nbsp;') , $fluida_big['block-icons'] );

// FIN
