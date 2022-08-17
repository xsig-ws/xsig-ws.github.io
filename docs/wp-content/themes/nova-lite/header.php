<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
   
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php 

if ( function_exists('wp_body_open') ) {
	wp_body_open();
}

?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nova-lite' ); ?></a>

<div id="wrapper">
    
    <header id="header">
    
        <div class="container">
        
            <div class="row">
                
                <div class="span3" >

                    <div id="logo">
                            
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>">
                                
                            <?php 
                                            
                                if ( novalite_setting('novalite_custom_logo') ):
								
                                    echo '<img src="' . esc_url(novalite_setting('novalite_custom_logo', 'url')) . '" alt="' . esc_attr__('Logo', 'nova-lite') . '">'; 
                                
								else: 
                                    
									echo esc_html(get_bloginfo('name'));
                                
								endif; 
                                
                            ?>
                                    
                        </a>
                                
                    </div>
                    
                </div>
    
                <div class="span9" >
                  
                    <nav id="mainmenu">
                 
                        <?php 
						
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'container' => 'false'
								)
							);
						
						?>
                 
                    </nav> 
                                   
                </div>
                
            </div>
            
        </div>
    
    </header>