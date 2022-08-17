/**
 * Panoramic Theme Custom Functionality
 *
 */
( function( $ ) {

	var sliderTransitionSpeed = parseInt(variables.sliderTransitionSpeed);
	
    $( document ).ready( function() {
    	panoramic_image_has_loaded();
    	
    	$('.hiddenUntilLoadedImageContainer img, img.hideUntilLoaded').one("load", function() {
	    }).each(function() {
	    	if (this.complete) {
	    		$(this).trigger( 'load' );
	    	}
	    });
    	
	    // Themify Product Filter
    	$( document ).on( 'wpf_ajax_success', function() {
    		panoramic_image_has_loaded();
    	} );
    	
    	// Jetpack infinite scroll
    	$( document.body ).on( 'post-load', function () {
    		panoramic_image_has_loaded();
    	} );

        // Add button to sub-menu parent to show nested pages on the mobile menu
        $( '.main-navigation li.page_item_has_children, .main-navigation li.menu-item-has-children' ).prepend( '<span class="menu-dropdown-btn"><i class="otb-fa otb-fa-angle-right"></i></span>' );
        
        // Add a hover class to navigation menu items when focused
        $( '.main-navigation a' ).on( 'focus blur', function() {
        	$( this ).parents( 'li' ).toggleClass( 'hover' );
        });
        
        // Sub-menu toggle button
        $( '.main-navigation a[href="#"], .menu-dropdown-btn' ).bind( 'click', function(e) {
        	e.preventDefault();
            $(this).parent().toggleClass( 'open-page-item' );
            $(this).parent().find('.otb-fa:first').toggleClass('otb-fa-angle-right').toggleClass('otb-fa-angle-down');
            
        });
        
        var focused_mobile_menu_item;
        
        // Remove all hover classes from menu items when anything  on the page is clicked
        $( document ).bind( 'click', function(e) {
        	if ( e.target != focused_mobile_menu_item ) {
        		$( 'body.mobile-device .main-navigation li.menu-item-has-children' ).removeClass('hover');
        	}
        	
        	focused_mobile_menu_item = null;
        });

        // 
        $( 'body.mobile-device .main-navigation li.menu-item-has-children > a' ).bind( 'click', function(e) {
        	e.preventDefault();
        	menu_item = $(this).parent();

        	// If a menu item with a submenu is clicked that doesn't have a # for a URL show the submenu
        	if ( menu_item.find('a').attr('href') != '#' && !menu_item.hasClass('hover') ) {
        		focused_mobile_menu_item = e.target;        		
        		menu_item.addClass('hover');
        		
        	// If the submenu is already displaying then go to it's URL
        	} else if ( menu_item.hasClass('hover') ) {
        		window.location.href = menu_item.find('a').attr('href');
        	}
        });
        
        panoramic_set_slider_height();
        
        // Mobile menu toggle button
        $( '.header-menu-button' ).on( 'click', function(e) {
            $( 'body' ).toggleClass( 'show-main-menu' );
            
        	if ( $( 'body' ).hasClass( 'show-main-menu' ) ) {
            	$( this ).attr( 'aria-expanded', 'true' );
        	} else {
        		$( this ).attr( 'aria-expanded', 'false' );
        	}
        });
        $( '.main-menu-close' ).on( 'click', function(e) {
            $( '.header-menu-button' ).click();
        });
    	
        // Show / Hide Search
        $(".search-btn").toggleClick( function(e){
        	e.preventDefault();
        	$search_block = $( 'header .search-block' );
        	$search_field = $( 'header .search-block .search-field' );
        	
        	$search_block.css( 'visibility', 'visible' );
        	$search_block.animate( { top: '+=50' }, 150 );
        	$search_field.focus();
        }, function(e){
        	e.preventDefault();
        	$search_block = $( 'header .search-block' );
        	$search_field = $( 'header .search-block .search-field' );
        	
        	$search_block.animate( { top: '-=50' }, 150, function() {
        		$(this).css( 'visibility', 'hidden' );
            });
        	$search_field.blur();
        });
        
        // Don't search if no keywords have been entered
        $(".search-submit").bind('click', function(event) {
        	var form = $(this).parents("form");
        	
        	if ( form.find(".search-field").val() == "" ) {
        		event.preventDefault();
        	} else {
        		form.submit();
        	}
        });
		
    });
    
    $(window).on('load', function() {
    	panoramic_home_slider();
    });
    
    if ( $(".header-image img").length > 0 ) {
	    var img = $('<img/>');
	    img.attr("src", $(".header-image img").attr("src") ); 
		
	    img.on('load', function() {
	    	$('.header-image').removeClass('loading');
	    	$('.header-image').css('height', 'auto');
		});
    }    
    
    function panoramic_set_slider_height() {
        // Set the height of the slider to the height of the first slide's image
    	var firstSlide  = $(".panoramic-slider-container.default .slider .slide:eq(0)");
    	var headerImage = $(".header-image img");
    	if ( firstSlide.length > 0 ) {
    		var firstSlideImage = firstSlide.find('img').first();
    		
    		if ( firstSlideImage.length > 0) {
    			
    			if ( firstSlideImage.attr('height') > 0 ) {
    				
    				// The height needs to be dynamically calculated with responsive in mind ie. the height of the image will obviously grow
    				var firstSlideImageWidth  = firstSlideImage.attr('width');
    				var firstSlideImageHeight = firstSlideImage.attr('height');
    				var sliderWidth = $('.panoramic-slider-container').width();
    				var widthPercentage;
    				var widthRatio;
    				
    				widthRatio = sliderWidth / firstSlideImageWidth;
    				
    				$('.panoramic-slider-container.loading').css('height', Math.round( widthRatio * firstSlideImageHeight ) );
    			}
    		}
    	} else if ( headerImage.length > 0 ) {
    		
    		if ( headerImage.attr('height') > 0 ) {

				// The height needs to be dynamically calculated with responsive in mind ie. the height of the image will obviously grow
				var headerImageWidth  = headerImage.attr('width');
				var headerImageHeight = headerImage.attr('height');
				var headerImageContainerWidth = $('.header-image').width();
				var widthPercentage;
				var widthRatio;
				
				widthRatio = headerImageContainerWidth / headerImageWidth;
				
				$('.header-image.loading').css('height', Math.round( widthRatio * headerImageHeight ) );
    		}
    	}
    }
    
    function panoramic_image_has_loaded() {
    	var container;

    	$('.hiddenUntilLoadedImageContainer img').on('load',function(){
	    	container = $(this).parents('.hiddenUntilLoadedImageContainer');
	    	container.removeClass('loading');
	    	
	    	(function(container){
	    	    setTimeout(function() {
	    	    	container.addClass('transition');
	    	    }, 50);
	    	})(container);
	    });
    	
	    $('img.hideUntilLoaded').on('load',function(){
	    	container = $(this).parents('.featured-image-container');
	    	container.removeClass('loading');
	    });
	}
    
    function panoramic_home_slider() {
    	if ( $('.panoramic-slider-container.default .slider').length ) {
    		
	        $(".panoramic-slider-container.default .slider").carouFredSel({
	            responsive: true,
	            circular: true,
	            infinite: false,
	            width: 1200,
	            height: 'variable',
	            items: {
	                visible: 1,
	                width: 1200,
	                height: 'variable'
	            },
	            onCreate: function(items) {
	            	$('.panoramic-slider-container.default').css('height', 'auto');
	                $('.panoramic-slider-container.default').removeClass("loading");
	            },
	            scroll: {
	                fx: 'uncover-fade',
	                duration: sliderTransitionSpeed
	            },
	            auto: false,
	            pagination: '.panoramic-slider-container.default .pagination',
	            prev: '.panoramic-slider-container.default .prev',
	            next: '.panoramic-slider-container.default .next',
	            swipe: {
	            	onTouch: true
	            }
	        });
	        
    	}
    }
    
    function trapFocus( element, namespace ) {
	    var focusableEls = element.find( 'a, button' );
	    var firstFocusableEl = focusableEls[0];
	    var lastFocusableEl = focusableEls[focusableEls.length - 1];
	    var KEYCODE_TAB = 9;
	
	    firstFocusableEl.focus();
	
	    element.keydown( function(e) {
	        var isTabPressed = ( e.key === 'Tab' || e.keyCode === KEYCODE_TAB );
	
	        if ( !isTabPressed ) { 
	            return;
	        }
	
	        if ( e.shiftKey ) /* shift + tab */ {
	            if ( document.activeElement === firstFocusableEl ) {
	                lastFocusableEl.focus();
	                e.preventDefault();
	            }
	        } else /* tab */ {
	            if ( document.activeElement === lastFocusableEl ) {
	                firstFocusableEl.focus();
	                e.preventDefault();
	            }
	        }
	
	    });
    }
    
	$.fn.toggleClick = function() {
		var functions = arguments;
		return this.click( function() {
			var iteration = $(this).data('iteration') || 0;
			//	console.log(iteration)
			functions[iteration].apply( this, arguments );
			iteration = ( iteration+1 ) % functions.length;
			$(this).data( 'iteration', iteration );
		});
	}

} )( jQuery );