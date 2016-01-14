/* M-Template by Andrey Starkov
    im@andreystarkov.ru | github/andreystarkov */

$(document).ready(function() {

        $('.wp1').waypoint(function() {
            $('.wp1').addClass('animated fadeInUp');
        }, {
            offset: '75%'
        });
        $('.wp2').waypoint(function() {
            $('.wp2').addClass('animated fadeInUp');
        }, {
            offset: '75%'
        });
        $('.wp3').waypoint(function() {
            $('.wp3').addClass('animated fadeInRight');
        }, {
            offset: '75%'
        });

        $('.flexslider').flexslider({
            animation: "slide"
        });

        $('.single_image').fancybox({
            padding: 4,
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('.nav-toggle').click(function() {
            $(this).toggleClass('active');
            $('.header-nav').toggleClass('open');
            event.preventDefault();
        });

        $('.header-nav li a').click(function() {
            $('.nav-toggle').toggleClass('active');
            $('.header-nav').toggleClass('open');

        });


            $(function() {

                $('a[href*=#]:not([href=#])').click(function() {
                    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {

                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top
                            }, 2000);
                            return false;
                        }
                    }
                });

            });

        });