    <section id="bottom_area">
    
        <?php 
        
            novalite_bottom_content();
            do_action( 'novalite_socials' ); 
            
        ?>
        
        <footer id="footer">
        
            <div class="container">
            
                <div class="row" >
                     
                    <div class="span12 copyright" >
                    
                        <p>
                            <?php if (novalite_setting('novalite_copyright_text')): ?>
                               <?php echo stripslashes(novalite_setting('novalite_copyright_text','html')); ?>
                            <?php else: ?>
                              <?php esc_html_e('Copyright','nova-lite'); ?> <?php echo get_bloginfo("name"); ?> <?php echo date("Y"); ?> 
                            <?php endif; ?> 
                            | <?php esc_html_e('Theme by','nova-lite'); ?> <a href="<?php echo esc_url('https://www.themeinprogress.com/'); ?>" target="_blank">Theme in Progress</a> |
                            <a href="<?php echo esc_url( 'http://wordpress.org'); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'nova-lite' ); ?>" rel="generator"><?php printf( esc_html__( 'Proudly powered by %s', 'nova-lite' ), 'WordPress' ); ?></a>
                        
                        </p>
                    
                    </div>
                        
                </div>
        
            </div>
        
        </footer>
    
    </section>

</div>

<div id="back-to-top">
<a href="#" style=""><i class="icon-chevron-up"></i></a> 
</div>
    
<?php wp_footer() ?>  
 
</body>

</html>