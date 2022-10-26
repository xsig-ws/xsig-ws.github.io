
  (function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");
    });

    $(document).ready(function () { 
        $(".toggle-button").click( function (){
            $(this).parent().toggleClass("menu-collapsed");
        });             

        /*-- tooltip --*/
        $('[data-toggle="tooltip"]').tooltip();

        /*-- Button Up --*/
        var btnUp = $('<div/>', { 'class': 'btntoTop' });
        btnUp.appendTo('body');
        $(document).on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });

        /*-- Mobile menu --*/
        if($('#elvinaa-main-menu-wrapper').length) {
            $('#elvinaa-main-menu-wrapper .nav li.dropdown').append(function () {
              return '<i class="fa fa-angle-down" aria-hidden="true"></i>';
            });
            $('#elvinaa-main-menu-wrapper .nav li.dropdown .fa').on('click', function () {
              $(this).parent('li').children('ul').slideToggle();
            });
        }

        if ($("#elvinaa-main-menu-wrapper ul.nav > li:last-child ul>li:last-child ul>li:last-child").length) { 
            $("#elvinaa-main-menu-wrapper ul.nav > li:last-child ul>li:last-child ul>li:last-child").on("focusout", function() {
                $("button.navbar-toggle").focus();
            }); 
        }
        else if($("#elvinaa-main-menu-wrapper ul.nav > li:last-child ul>li:last-child").length) { 
            $("#elvinaa-main-menu-wrapper ul.nav > li:last-child ul>li:last-child").on("focusout", function() {
                $("button.navbar-toggle").focus();
            });
        }
        else{
            $("#elvinaa-main-menu-wrapper ul.nav > li:last-child").on("focusout", function() {
                $("button.navbar-toggle").focus();
            });
        }

        /*-- Slider --*/
        $('.slider').flexslider({
            animation: "fade",
            slideshow: true,
            directionNav: true,
            controlNav: true,
            animationSpeed: 1500,
            prevText: "<i class='fa fa-angle-left'>",
            nextText: "<i class='fa fa-angle-right'>"

        });
        $('.slider .slides li').css('height', $(window).height());

        /*-- Sticky Sidebar --*/
       $('#sidebar-wrapper, #post-wrapper').theiaStickySidebar();
       
    });    

})(this.jQuery);