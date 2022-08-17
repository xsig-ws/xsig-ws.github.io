<!-- Footer Widget Secton -->
<?php  if (is_active_sidebar('footer-widget-area')) { ?>
    <div class="enigma_footer_widget_area">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar('footer-widget-area'); ?>
            </div>
        </div>
    </div>
<?php } ?>
<div class="enigma_footer_area">
    <div class="container">
        <div class="col-md-12">
            <?php if ( enigma_theme_is_companion_active() ) { ?>
                <p class="enigma_footer_copyright_info wl_rtl">
                    <?php 
                    $enigma_footer_customization = get_theme_mod( 'footer_customizations', __('&copy; Copyright 2020. All Rights Reserved','enigma') );
                    $developed_by_text = get_theme_mod('developed_by_text', __('Powered By','enigma'));
                    echo esc_html( $enigma_footer_customization );?> <?php  echo esc_html($developed_by_text);?>
                    <a target="_blank" rel="nofollow" href="<?php echo esc_url( get_theme_mod( 'developed_by_link' ) ); ?>">
                       <?php 
                       $enigma_develop_by = get_theme_mod( 'developed_by_weblizar_text' );
                       echo esc_html( $enigma_develop_by ); ?>
                    </a>
                </p>    
            <?php 
            }else{ ?>
                <p class="enigma_footer_copyright_info wl_rtl">
                    <?php esc_html_e('&copy; Copyright 2020. All Rights Reserved','enigma'); ?>
                </p>    
            <?php
            }
            if ( enigma_theme_is_companion_active() ) {
                $footer_section_social_media_enbled = absint(get_theme_mod('footer_section_social_media_enbled', 1));
                if ($footer_section_social_media_enbled == 1) { ?>
                    <div class="enigma_footer_social_div">
                        <ul class="social">
                            <?php
                            $fb_link = get_theme_mod('fb_link');
                            if (!empty ($fb_link)) { ?>
                                <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Facebook",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('fb_link')); ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <?php }
                            $twitter_link = get_theme_mod('twitter_link');
                            if (!empty ($twitter_link)) { ?>
                                <li class="twitter" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Twitter",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('twitter_link')); ?>"><i class="fab fa-twitter"></i></a></li>
                            <?php }
                            $linkedin_link = get_theme_mod('linkedin_link');
                            if (!empty ($linkedin_link)) { ?>
                                <li class="linkedin" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Linkedin",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('linkedin_link')); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                            <?php }
                            $youtube_link = get_theme_mod('youtube_link');
                            if (!empty ($youtube_link)) { ?>
                                <li class="youtube" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("Youtube",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('youtube_link')); ?>"><i class="fab fa-youtube"></i></a></li>
                            <?php }
                            $instagram = get_theme_mod('instagram');
                            if (!empty ($instagram)) { ?>
                                <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("instagram",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('instagram')); ?>"><i class="fab fa-instagram"></i></a></li>
                            <?php }
                            $vk_link = get_theme_mod('vk_link');
                            if (!empty ($vk_link)) { ?>
                                <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("vk",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('vk_link')); ?>"><i class="fab fa-vk"></i></a></li>
                            <?php }
                            $qq_link = get_theme_mod('qq_link');
                            if (!empty ($qq_link)) { ?>
                                <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="<?php esc_attr_e("qq",'enigma') ?>"><a target="_blank" href="<?php echo esc_url(get_theme_mod('qq_link')); ?>"><i class="fab fa-qq"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } 
            } ?>
        </div>
    </div>
</div>
<!-- /Footer Widget Secton--> 
<?php if ( enigma_theme_is_companion_active() ) { 
    $enigma_return_top = absint(get_theme_mod( 'enigma_return_top', '1' ));
    if ( $enigma_return_top == "1" ) { ?>
        <a id="btn-to-top"></a>
    <?php } 
} ?>
</div></div>
<?php wp_footer(); ?>
</body>
</html>