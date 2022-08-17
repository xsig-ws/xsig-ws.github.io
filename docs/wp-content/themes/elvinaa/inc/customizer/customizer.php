<?php
/**
 * Elvinaa Theme Customizer
 *
 * @package elvinaa
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! function_exists( 'elvinaa_customize_register' ) ) :
function elvinaa_customize_register( $wp_customize ) {

    require get_parent_theme_file_path( 'inc/customizer/custom-controls/control-custom-content.php' );  
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/control-dropdown-category.php' );  

    // Add custom controls.
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-title-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/radio-images/class-radio-image-control.php' );

    // Register the custom control type.
    $wp_customize->register_control_type( 'Elvinaa_Toggle_Control' );

    // Display Site Title and Tagline
    $wp_customize->add_setting( 
        'el_display_site_title_tagline', 
        array(
            'default'           => false,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Toggle_Control( $wp_customize, 'el_display_site_title_tagline', 
        array(
            'label'       => esc_html__( 'Display Site Title and Tagline', 'elvinaa' ),
            'section'     => 'title_tagline',
            'type'        => 'elvinaa-toggle',
            'settings'    => 'el_display_site_title_tagline',
        ) 
    ));

    // General Settings
    $wp_customize->add_section(
        'elvinaa_general_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'General Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_home_background_section', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_home_background_section', 
        array(
            'label'       => esc_html__( 'Home Background Image', 'elvinaa' ),
            'section'     => 'elvinaa_general_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_home_background_section',
        ) 
    ));

    // Home Background Image 
    $wp_customize->add_setting(
        'el_theme_home_bg',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'elvinaa_sanitize_image'
        )
    );

    $wp_customize->add_control(
      new WP_Customize_Image_Control(
          $wp_customize,
          'el_theme_home_bg',
          array(
              'settings'      => 'el_theme_home_bg',
              'section'       => 'elvinaa_general_settings',
              'label'         => esc_html__( 'Home Background Image', 'elvinaa' ),
              'description'   => esc_html__( 'This setting will add background image if Background Image was selected above.', 'elvinaa' )
          )
      )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_home_background_content', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_home_background_content', 
        array(
            'label'       => esc_html__( 'Home Background Content', 'elvinaa' ),
            'section'     => 'elvinaa_general_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_home_background_content',
        ) 
    ));

    // Home Section Heading text 
    $wp_customize->add_setting(
        'el_home_heading_text',
        array(            
            'default'           => esc_html__('ENTER YOUR HEADING HERE','elvinaa'),
            'sanitize_callback' => 'elvinaa_sanitize_textarea',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'el_home_heading_text',
        array(
            'settings'      => 'el_home_heading_text',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Heading Text', 'elvinaa' ),
            'description'   => esc_html__( 'heading for the home section', 'elvinaa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'el_home_heading_text', array(
        'selector'            => '.slide-bg-section h1',   
        'settings'            => 'el_home_heading_text',     
        'render_callback'     => 'elvinaa_home_heading_text_render_callback',
        'fallback_refresh'    => false, 
    ));

    // Home Section SubHeading text
    $wp_customize->add_setting(
        'el_home_subheading_text',
        array(            
            'default'           => esc_html__('ENTER YOUR SUBHEADING HERE','elvinaa'),
            'sanitize_callback' => 'elvinaa_sanitize_textarea',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'el_home_subheading_text',
        array(
            'settings'      => 'el_home_subheading_text',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'SubHeading Text', 'elvinaa' ),
            'description'   => esc_html__( 'Subheading for the home section', 'elvinaa' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'el_home_subheading_text', array(
        'selector'            => '.slide-bg-section p',   
        'settings'            => 'el_home_subheading_text',     
        'render_callback'     => 'elvinaa_home_subheading_text_render_callback',
        'fallback_refresh'    => false, 
    ));

    // Home Section Button text 
    $wp_customize->add_setting(
        'el_home_button_text',
        array( 
            'type' => 'theme_mod',           
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_html',
            
        )
    );

    $wp_customize->add_control(
        'el_home_button_text',
        array(
            'settings'      => 'el_home_button_text',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Button Text', 'elvinaa' ),
            'description'   => esc_html__( 'Button text for the home section', 'elvinaa' ),
        )
    );  


    // Home Section Button url 
    $wp_customize->add_setting(
        'el_home_button_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_home_button_url',
        array(
            'settings'      => 'el_home_button_url',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Button URL', 'elvinaa' ),
            'description'   => esc_html__( 'Button URL for the home section', 'elvinaa' ),
        )
    );

    // Home Section Button2 text
    $wp_customize->add_setting(
        'el_home_button2_text',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_html'
        )
    );

    $wp_customize->add_control(
        'el_home_button2_text',
        array(
            'settings'      => 'el_home_button2_text',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Button 2 Text', 'elvinaa' ),
            'description'   => esc_html__( 'Button 2 text for the home section', 'elvinaa' ),
        )
    );

    // Home Section Button2 url 
    $wp_customize->add_setting(
        'el_home_button2_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_home_button2_url',
        array(
            'settings'      => 'el_home_button2_url',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Button 2 URL', 'elvinaa' ),
            'description'   => esc_html__( 'Button 2 URL for the home section', 'elvinaa' ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_home_background_text_pos', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_home_background_text_pos', 
        array(
            'label'       => esc_html__( 'Background Text Position', 'elvinaa' ),
            'section'     => 'elvinaa_general_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_home_background_text_pos',
        ) 
    ));

    // text position
    $wp_customize->add_setting(
        'el_home_text_position',
        array(
            'type' => 'theme_mod',
            'default'           => 'center',
            'sanitize_callback' => 'elvinaa_sanitize_home_text_position_radio_selection'
        )
    );

    $wp_customize->add_control(
        'el_home_text_position',
        array(
            'settings'      => 'el_home_text_position',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Select Text Position:', 'elvinaa' ),
            'description'   => '',
            'choices' => array(
                            'left' =>esc_html__( 'Left', 'elvinaa' ),
                            'center' =>esc_html__( 'Center', 'elvinaa' ),
                            'right' => esc_html__( 'Right', 'elvinaa' ),                            
                            ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_home_background_parallax', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_home_background_parallax', 
        array(
            'label'       => esc_html__( 'Parallax Scroll', 'elvinaa' ),
            'section'     => 'elvinaa_general_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_home_background_parallax',
        ) 
    ));

    // Parallax Scroll for background image 
    $wp_customize->add_setting(
        'el_home_parallax',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_home_parallax', 
        array(
            'settings'      => 'el_home_parallax',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Parallax Scroll:', 'elvinaa' ),
            'description'   => esc_html__( 'Choose whether to show a parallax scroll feature for the Home Background image', 'elvinaa' ),           
        )
    ));

    // Info label
    $wp_customize->add_setting( 
        'el_label_home_background_dark_overlay', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_home_background_dark_overlay', 
        array(
            'label'       => esc_html__( 'Dark Overlay', 'elvinaa' ),
            'section'     => 'elvinaa_general_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_home_background_dark_overlay',
        ) 
    ));


    // Enable Dark Overlay
    $wp_customize->add_setting(
        'el_home_dark_overlay',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_home_dark_overlay', 
        array(
            'settings'      => 'el_home_dark_overlay',
            'section'       => 'elvinaa_general_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Dark Overlay:', 'elvinaa' ),
            'description'   => esc_html__( 'Choose whether to show a dark overlay over background image', 'elvinaa' ),           
        )
    ));


    //Slider Settings
    $wp_customize->add_section(
        'elvinaa_slider_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Slider Settings', 'elvinaa' )
        )
    );    

    // Info label
    $wp_customize->add_setting( 
        'el_label_slider_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_slider_settings', 
        array(
            'label'       => esc_html__( 'Slider Settings', 'elvinaa' ),
            'section'     => 'elvinaa_slider_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_slider_settings',
        ) 
    ));

    /* Slider settings */
    $wp_customize->add_setting(
        'el_slide_options_radio',
        array(
            'type' => 'theme_mod',
            'default'           => 'single',
            'sanitize_callback' => 'elvinaa_sanitize_slider_options_selection'
        )
    );

    $wp_customize->add_control(
        'el_slide_options_radio',
        array(
            'settings'      => 'el_slide_options_radio',
            'section'       => 'elvinaa_slider_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Choose Slider or Static Background Image:', 'elvinaa' ),
            'description'   => esc_html__( 'Choose whether to show a slider with multiple background images to slide or just a static background image', 'elvinaa' ),
            'choices' => array(
                            'single' => esc_html__('Single Background Image', 'elvinaa'),
                            'slider' => esc_html__('Slider Images', 'elvinaa'),                           
                            ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_slider_settings_category', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_slider_settings_category', 
        array(
            'label'       => esc_html__( 'Select Slider Category', 'elvinaa' ),
            'section'     => 'elvinaa_slider_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_slider_settings_category',
            'active_callback'  => 'elvinaa_slider_settings_slider_enable',
        ) 
    ));

    /* Slider Post Category */
    $wp_customize->add_setting( 
        'el_slider_post_category', 
        array(
            'type' => 'theme_mod',
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Dropdown_Category_Control( $wp_customize, 'el_slider_post_category', 
        array(
            'section'       => 'elvinaa_slider_settings',
            'label'         => esc_html__( 'Choose Slider Post Category', 'elvinaa' ),
            'description'   => esc_html__( 'Select the category that the slider will show posts from.', 'elvinaa' ),
            'active_callback'  => 'elvinaa_slider_settings_slider_enable',
            ) 
        ) 
    );

   
     //Sticky Header Settings
    $wp_customize->add_section(
        'elvinaa_sticky_header_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Sticky Header Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_sticky_header_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_sticky_header_settings', 
        array(
            'label'       => esc_html__( 'Sticky Header Settings', 'elvinaa' ),
            'section'     => 'elvinaa_sticky_header_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_sticky_header_settings',
        ) 
    ));

    //enable sticky menu
    $wp_customize->add_setting(
        'el_sticky_menu',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_sticky_menu', 
        array(
            'settings'      => 'el_sticky_menu',
            'section'       => 'elvinaa_sticky_header_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Sticky Header Feature:', 'elvinaa' ),
            'description'   => esc_html__( 'Choose whether to enable a sticky header feature for the site', 'elvinaa' ),            
        )
    ));

    // Color Settings 
    $wp_customize->add_section(
        'elvinaa_color_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Color Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_color_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_color_settings', 
        array(
            'label'       => esc_html__( 'Color Settings', 'elvinaa' ),
            'section'     => 'elvinaa_color_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_color_settings',
        ) 
    ));           

    
    // Link Color
    $wp_customize->add_setting(
        'el_link_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#444444',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_link_color',
        array(
        'label'      => esc_html__( 'Links Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_link_color',
        ) )
    );

    // Link Hover Color
    $wp_customize->add_setting(
        'el_link_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_link_hover_color',
        array(
        'label'      => esc_html__( 'Links Hover Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_link_hover_color',
        ) )
    );

    // Heading Color
    $wp_customize->add_setting(
        'el_heading_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#444444',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_heading_color',
        array(
        'label'      => esc_html__( 'Headings Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_heading_color',
        ) )
    );

    // Heading Hover Color
    $wp_customize->add_setting(
        'el_heading_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#dd3333',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_heading_hover_color',
        array(
        'label'      => esc_html__( 'Heading Hover Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_heading_hover_color',
        ) )
    );


    // Buttons Color
    $wp_customize->add_setting(
        'el_button_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#fe7237',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_button_color',
        array(
        'label'      => esc_html__( 'Buttons Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_button_color',
        ) )
    );

    // Buttons Hover Color
    $wp_customize->add_setting(
        'el_button_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#db5218',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_button_hover_color',
        array(
        'label'      => esc_html__( 'Buttons Hover Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_button_hover_color',
        ) )
    );    

    // Top menu color
    $wp_customize->add_setting(
        'el_top_menu_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_top_menu_color',
        array(
        'label'      => esc_html__( 'Top Menu Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_top_menu_color',
        ) )
    );

    // Category Blinker color
    $wp_customize->add_setting(
        'el_cat_blinker_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#fe7237',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_cat_blinker_color',
        array(
        'label'      => esc_html__( 'Category Blinker Color', 'elvinaa' ),
        'section'    => 'elvinaa_color_settings',
        'settings'   => 'el_cat_blinker_color',
        ) )
    );
    
     //Blog Settings
    $wp_customize->add_section(
        'elvinaa_blog_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Blog Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_settings', 
        array(
            'label'       => esc_html__( 'Blog Settings', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_settings',
        ) 
    ));  

    // Author Image
    $wp_customize->add_setting(
        'el_author_display',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_author_display', 
        array(
            'settings'      => 'el_author_display',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Author Image Display in Post', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Category Blinker
    $wp_customize->add_setting(
        'el_cat_blinker',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_cat_blinker', 
        array(
            'settings'      => 'el_cat_blinker',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Category Blinker Animation', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_columns_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_columns_settings', 
        array(
            'label'       => esc_html__( 'Blog Columns Style', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_columns_settings',
        ) 
    )); 

    // Post Columns
    $wp_customize->add_setting(
        'el_post_columns',
        array(
            'type' => 'theme_mod',
            'default'           => 'two',
            'sanitize_callback' => 'elvinaa_sanitize_blog_post_columns_radio_selection'
        )
    );

    $wp_customize->add_control(
        'el_post_columns',
        array(
            'settings'      => 'el_post_columns',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Select Blog Posts Column Style:', 'elvinaa' ),
            'description'   => '',
            'choices' => array(
                            'one' => esc_html__( 'One Column', 'elvinaa' ),
                            'two' =>esc_html__( 'Two Columns', 'elvinaa' ),
                            ),
        )
    ); 

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_sidebar_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_sidebar_settings', 
        array(
            'label'       => esc_html__( 'Blog Sidebar', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_sidebar_settings',
        ) 
    )); 

    // Blog Sidebar
    $wp_customize->add_setting(
        'el_blog_sidebar',
        array(
            'type' => 'theme_mod',
            'default'           => 'right',
            'sanitize_callback' => 'elvinaa_sanitize_blog_sidebar_radio_selection'
        )
    );

    $wp_customize->add_control(
        'el_blog_sidebar',
        array(
            'settings'      => 'el_blog_sidebar',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Select sidebar position:', 'elvinaa' ),
            'description'   => '',
            'choices' => array(
                            'right' => esc_html__( 'Right', 'elvinaa' ),
                            'left' =>esc_html__( 'Left', 'elvinaa' ),
                            'none' =>esc_html__( 'No Sidebar', 'elvinaa' ),
                            ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_post_excerpt', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_post_excerpt', 
        array(
            'label'       => esc_html__( 'Post Excerpt', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_post_excerpt',
        ) 
    ));

    // Excerpt length
    $wp_customize->add_setting(
        'el_excerpt_length',
        array(
            'type' => 'theme_mod',
            'default'           => 70,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'el_excerpt_length',
        array(
            'settings'      => 'el_excerpt_length',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'number',
            'label'         => esc_html__( 'Post Excerpt Length', 'elvinaa' ),
            'description'   => '',
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_read_more', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_read_more', 
        array(
            'label'       => esc_html__( 'Read More Button', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_read_more',
        ) 
    ));

    // Read more text
    $wp_customize->add_setting(
        'el_readmore_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'CONTINUE READING...', 'elvinaa' ),
            'sanitize_callback' => 'elvinaa_sanitize_textarea'
        )
    );

    $wp_customize->add_control(
        'el_readmore_text',
        array(
            'settings'      => 'el_readmore_text',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Read More Text', 'elvinaa' ),
            'description'   => '',
        )
    );  

    // Info label
    $wp_customize->add_setting( 
        'el_label_blog_social_share', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_blog_social_share', 
        array(
            'label'       => esc_html__( 'Social Share', 'elvinaa' ),
            'section'     => 'elvinaa_blog_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_blog_social_share',
        ) 
    ));

    // Enable Facebook share icon
    $wp_customize->add_setting(
        'el_fb_share_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_fb_share_icon', 
        array(
            'settings'      => 'el_fb_share_icon',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Facebook Share Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Enable Twitter share icon
    $wp_customize->add_setting(
        'el_tw_share_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_tw_share_icon', 
        array(
            'settings'      => 'el_tw_share_icon',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Twitter Share Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Enable Google plus share icon
    $wp_customize->add_setting(
        'el_li_share_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_li_share_icon', 
        array(
            'settings'      => 'el_li_share_icon',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable LinkedIn Share Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Enable Pinterest icon
    $wp_customize->add_setting(
        'el_pi_share_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_pi_share_icon', 
        array(
            'settings'      => 'el_pi_share_icon',
            'section'       => 'elvinaa_blog_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Pinterest Share Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));  


    //Social Icons Settings
    $wp_customize->add_section(
        'elvinaa_social_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Top Bar Icons Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_topbar_social_icons', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_topbar_social_icons', 
        array(
            'label'       => esc_html__( 'Top Bar Social Icons', 'elvinaa' ),
            'section'     => 'elvinaa_social_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_topbar_social_icons',
        ) 
    ));

    // Facebook
    $wp_customize->add_setting(
        'el_facebook_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_facebook_icon', 
        array(
            'settings'      => 'el_facebook_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Facebook Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Facebook url 
    $wp_customize->add_setting(
        'el_facebook_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_facebook_url',
        array(
            'settings'      => 'el_facebook_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Facebook Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_facebook_enable',
        )
    );

    // Twitter
    $wp_customize->add_setting(
        'el_twitter_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_twitter_icon', 
        array(
            'settings'      => 'el_twitter_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Twitter Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Twitter url 
    $wp_customize->add_setting(
        'el_twitter_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_twitter_url',
        array(
            'settings'      => 'el_twitter_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Twitter Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_twitter_enable',
        )
    );

    // Instagram
    $wp_customize->add_setting(
        'el_instagram_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_instagram_icon', 
        array(
            'settings'      => 'el_instagram_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Instagram Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Instagram url 
    $wp_customize->add_setting(
        'el_instagram_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_instagram_url',
        array(
            'settings'      => 'el_instagram_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Instagram Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_instagram_enable',
        )
    );

    // YouTube
    $wp_customize->add_setting(
        'el_youtube_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_youtube_icon', 
        array(
            'settings'      => 'el_youtube_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable YouTube Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // YouTube url 
    $wp_customize->add_setting(
        'el_youtube_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_youtube_url',
        array(
            'settings'      => 'el_youtube_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'YouTube Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_youtube_enable',
        )
    );

    // LinkedIn
    $wp_customize->add_setting(
        'el_linkedin_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_linkedin_icon', 
        array(
            'settings'      => 'el_linkedin_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable LinkedIn Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // LinkedIn url 
    $wp_customize->add_setting(
        'el_linkedin_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_linkedin_url',
        array(
            'settings'      => 'el_linkedin_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'LinkedIn Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_linkedin_enable',
        )
    );

    // Pinterest
    $wp_customize->add_setting(
        'el_pinterest_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_pinterest_icon', 
        array(
            'settings'      => 'el_pinterest_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Pinterest Icon', 'elvinaa' ),
            'description'   => '',           
        )
    ));

    // Pinterest url 
    $wp_customize->add_setting(
        'el_pinterest_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_pinterest_url',
        array(
            'settings'      => 'el_pinterest_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Pinterest Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_pinterest_enable',
        )
    );

    // RSS
    $wp_customize->add_setting(
        'el_rss_icon',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_rss_icon', 
        array(
            'settings'      => 'el_rss_icon',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable RSS Icon', 'elvinaa' ),
            'description'   => '',
        )
    ));

    // RSS url 
    $wp_customize->add_setting(
        'el_rss_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'elvinaa_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'el_rss_url',
        array(
            'settings'      => 'el_rss_url',
            'section'       => 'elvinaa_social_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'RSS Link URL', 'elvinaa' ),
            'description'   => '',
            'active_callback' => 'elvinaa_topbar_social_rss_enable',
        )
    );

    //Footer Settings
    $wp_customize->add_section(
        'elvinaa_footer_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Footer Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_footer_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_footer_settings', 
        array(
            'label'       => esc_html__( 'Footer Settings', 'elvinaa' ),
            'section'     => 'elvinaa_footer_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_footer_settings',
        ) 
    ));

    // Copyright text
    $wp_customize->add_setting(
        'el_copyright_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__('Copyrights Elvinaa. All Rights Reserved','elvinaa'),
            'sanitize_callback' => 'elvinaa_sanitize_textarea'
        )
    );

    $wp_customize->add_control(
        'el_copyright_text',
        array(
            'settings'      => 'el_copyright_text',
            'section'       => 'elvinaa_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer copyright text', 'elvinaa' ),
            'description'   => esc_html__( 'Copyright text to be displayed in the footer.', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_footer_widgets_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_footer_widgets_settings', 
        array(
            'label'       => esc_html__( 'Footer Widgets', 'elvinaa' ),
            'section'     => 'elvinaa_footer_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_footer_widgets_settings',
        ) 
    ));

    // Footer widgets
    $wp_customize->add_setting(
        'el_footer_widgets',
        array(
            'type' => 'theme_mod',
            'default'           => '4',
            'sanitize_callback' => 'elvinaa_sanitize_footer_widgets_radio_selection'
        )
    );

    $wp_customize->add_control(
        'el_footer_widgets',
        array(
            'settings'      => 'el_footer_widgets',
            'section'       => 'elvinaa_footer_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Number of Footer Widgets:', 'elvinaa' ),
            'description'   => '',
            'choices' => array(
                            '3' => esc_html__( '3', 'elvinaa' ),
                            '4' =>esc_html__( '4', 'elvinaa' ),
                            ),
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_footer_colors_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_footer_colors_settings', 
        array(
            'label'       => esc_html__( 'Footer Colors', 'elvinaa' ),
            'section'     => 'elvinaa_footer_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_footer_colors_settings',
        ) 
    ));    

    // Footer background color
    $wp_customize->add_setting(
        'el_footer_bg_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_footer_bg_color',
        array(
        'label'      => esc_html__( 'Footer Background Color', 'elvinaa' ),
        'section'    => 'elvinaa_footer_settings',
        'settings'   => 'el_footer_bg_color',
        ) )
    );    
   

    // Footer Content Color
    $wp_customize->add_setting(
        'el_footer_content_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_footer_content_color',
        array(
        'label'      => esc_html__( 'Footer Content Color', 'elvinaa' ),
        'section'    => 'elvinaa_footer_settings',
        'settings'   => 'el_footer_content_color',
        ) )
    );  

    // Footer links Color
    $wp_customize->add_setting(
        'el_footer_links_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#b3b3b3',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'el_footer_links_color',
        array(
        'label'      => esc_html__( 'Footer Links Color', 'elvinaa' ),
        'section'    => 'elvinaa_footer_settings',
        'settings'   => 'el_footer_links_color',
        ) )
    );

    // Preloader Settings
    $wp_customize->add_section(
        'elvinaa_preloader_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Preloader Settings', 'elvinaa' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'el_label_preloader_settings', 
        array(
            'sanitize_callback' => 'elvinaa_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Elvinaa_Title_Info_Control( $wp_customize, 'el_label_preloader_settings', 
        array(
            'label'       => esc_html__( 'Preloader Settings', 'elvinaa' ),
            'section'     => 'elvinaa_preloader_settings',
            'type'        => 'elvinaa-title',
            'settings'    => 'el_label_preloader_settings',
        ) 
    )); 

    // Preloader Enable radio button 
    $wp_customize->add_setting(
        'el_preloader_display',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'elvinaa_sanitize_checkbox_selection'
        )
    );

    $wp_customize->add_control(
        new Elvinaa_Toggle_Control( $wp_customize, 'el_preloader_display', 
        array(
            'settings'      => 'el_preloader_display',
            'section'       => 'elvinaa_preloader_settings',
            'type'          => 'elvinaa-toggle',
            'label'         => esc_html__( 'Enable Preloader for site:', 'elvinaa' ),
            'description'   => esc_html__( 'Choose whether to show a preloader before a site opens', 'elvinaa' ),            
        )
    ));    
   
}
endif;

add_action( 'customize_register', 'elvinaa_customize_register' );


//customizer helper
get_template_part( 'inc/customizer/customizer-helpers' );

//data sanitization
get_template_part( 'inc/customizer/data-sanitization' );


/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'elvinaa_enqueue_customizer_stylesheets' ) ) :
function elvinaa_enqueue_customizer_stylesheets() {
    wp_register_style( 'elvinaa-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'elvinaa-customizer-css' );
}
endif;

add_action( 'customize_controls_print_styles', 'elvinaa_enqueue_customizer_stylesheets' );
