<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php $box_layout = absint(get_theme_mod('box_layout', '1')) ; if ( $box_layout == '2') {
    body_class('boxed');
} else body_class(); ?>>
    <?php   
    if ( function_exists( 'wp_body_open' ) )
    wp_body_open();
    ?>
    <div>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'enigma' ); ?></a>
    <!-- Header Section -->
    <div class="header_section hd_cover">
        <div class="container">
            <!-- Logo & Contact Info -->
            <div class="row">
                <?php 
                $title_position = get_theme_mod('title_position');
                if ( $title_position == 1 ) { ?>
                    <div class="col-md-6 col-sm-12 wl_rtl">
                        <div claSS="logo logocenter">
                            <?php
                            if (has_custom_logo()) { 
                                the_custom_logo(); 
                            } 
                            if (display_header_text() == true) {
                                ?>
                                <a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" rel="home">
                                <h1><?php echo esc_html(get_bloginfo('name')); ?></h1>
                                </a>
                            <?php } ?>
                            
                            <?php if (display_header_text() == true) { ?>
                                <p><?php bloginfo('description'); ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-6 col-sm-12 wl_rtl">
                        <div claSS="logo">
                            <?php
                            if (has_custom_logo()) { 
                                the_custom_logo(); 
                            } 
                            if (display_header_text() == true) {
                                ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display')); ?>" rel="home">
                                <h1><?php echo esc_html(get_bloginfo('name')); ?></h1></a>
                            <?php } ?>
                            
                            <?php if (display_header_text() == true) { ?>
                                <p><?php bloginfo('description'); ?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
                if ( enigma_theme_is_companion_active() ) {
                    $header_social_media_in_enabled = absint(get_theme_mod('header_social_media_in_enabled', 1));
                    if ($header_social_media_in_enabled == 1) {  ?>
                        <div class="col-md-6 col-sm-12">
                            <?php   
                            $email_id = get_theme_mod('email_id');
                            $phone_no = get_theme_mod('phone_no');
                            if (!empty ($email_id) || !empty ($phone_no)) { ?>
                                <ul class="head-contact-info">
                                    <?php if (!empty ($email_id)) { ?>
                                        <li><i class="fa fa-envelope"></i><a
                                        href="mailto:<?php echo esc_attr( $email_id ); ?>"><?php echo esc_html( $email_id ); ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty ( $phone_no ) ) { ?>
                                        <li><i class="fa fa-phone"></i>
                                            <a href="tel:<?php echo esc_attr( $phone_no ); ?>"><?php echo esc_html( $phone_no ); ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>   
                            <?php } ?>
                            <?php
                            $social_tab = absint(get_theme_mod( 'social_tab', 1 ));
                            if ( $social_tab == 1) {
                                $class = 'target="_blank"';
                            } else {
                                $class = '';
                            }
                            ?>
                            <ul class="social">
                                <?php 
                                $fb_link = get_theme_mod('fb_link');
                                if (!empty ($fb_link)) { ?>
                                <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Facebook",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('fb_link')); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <?php }
                                $twitter_link = get_theme_mod('twitter_link');
                                if (!empty ($twitter_link)) { ?>
                                <li class="twitter" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Twitter",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('twitter_link')); ?>"><i class="fab fa-twitter"></i></a></li>
                                <?php }
                                $linkedin_link = get_theme_mod('linkedin_link');
                                if (!empty ($linkedin_link)) { ?>
                                <li class="linkedin" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Linkedin",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('linkedin_link')); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                <?php }
                                $youtube_link = get_theme_mod('youtube_link');
                                if (!empty ($youtube_link)) { ?>
                                    <li class="youtube" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Youtube",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('youtube_link')); ?>"><i class="fab fa-youtube"></i></a></li>
                                <?php }
                                $instagram = get_theme_mod('instagram');
                                if (!empty ($instagram)) { ?>
                                    <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("instagram",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('instagram')); ?>"><i class="fab fa-instagram"></i></a></li>
                                <?php }
                                $vk_link = get_theme_mod('vk_link');
                                if (!empty ($vk_link)) { ?>
                                    <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("vk",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('vk_link')); ?>"><i class="fab fa-vk"></i></a></li>
                                <?php }
                                $qq_link = get_theme_mod('qq_link');
                                if (!empty ($qq_link)) { ?>
                                    <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("qq",'enigma') ?>"><a <?php echo esc_attr($class); ?> href="<?php echo esc_url(get_theme_mod('qq_link')); ?>"><i class="fab fa-qq"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } 
                } ?>
            </div>
            <!-- /Logo & Contact Info -->
        </div>
    </div>
    <!-- /Header Section -->
    <!-- Navigation  menus -->
    <div class="navigation_menu" data-spy="affix" data-offset-top="95" id="enigma_nav_top" >
        <span id="header_shadow"></span>
        <div class="container navbar-container">
            <nav id="site-navigation" class="main-navigation navbar" role="navigation">
                <div class="navbar-header">
                    <button id="nav-tog" type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu" aria-controls="#menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','enigma')?>">
                        <span class="sr-only"><?php echo esc_html_e('Toggle navigation', 'enigma'); ?></span>
                        <span class="fas fa-bars"></span>
                    </button>
                </div>
                <div id="menu" class="collapse navbar-collapse ">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => 'enigma_fallback_page_menu',
                        'walker'         => new enigma_nav_walker(),
                    ) );
                    ?>
                </div>
            </nav>
        </div>
    </div>
    <div id="content" class="site-content">