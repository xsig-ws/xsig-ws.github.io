<?php
$page_header = absint(get_theme_mod( 'page_header', 1 ));
if ( $page_header == 1) {
    $class = 'no-page-header';
} else {
    $class = '';
}
?>
<div class="enigma_header_breadcrum_title <?php echo esc_attr($class); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <h1><?php if (is_home()) {
                        echo "";
                    } else {
                        the_title();
                    } ?>
                </h1>
                
                <!-- BreadCrumb -->
                <?php if (function_exists('enigma_breadcrumbs')){ 
                    enigma_breadcrumbs(); 
                } ?>
                <!-- BreadCrumb -->
            </div>
        </div>
    </div>
</div>