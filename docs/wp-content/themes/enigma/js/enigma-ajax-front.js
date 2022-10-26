jQuery(document).ready(function () {
    'use strict';

    if ( ajax_admin.ajax_data.autoplay == '1' ) {
        var autoplay = true;
    } else {
        var autoplay = false;
    }

    // jQuery CarouFredSel  For blog               
    jQuery('#enigma_blog_section').wl_caroufredsel({
        width: '100%',
        responsive: true,
       scroll : {
            items : 1,
            duration : ajax_admin.ajax_data.blog_speed,
            timeoutDuration : 2000
        },
        circular: autoplay,
        direction: 'left',
        items: {
            height: 'variable',
			width: 308,
            visible: {
                min: 1,
                max: 3
            },
            
       },
         prev: '#port-prev',
        next: '#port-next',
        auto: {
            play: autoplay
        } 
    });

    if ( ajax_admin.ajax_data.speed == true ) {
        jQuery(document ).ready(function( $ ) {
            jQuery("#myCarousel" ).carousel({
                interval:parseInt( ajax_admin.ajax_data.image_speed )
            });
        });
    }
});