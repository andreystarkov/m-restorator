/* M-Template by Andrey Starkov
    im@andreystarkov.ru | github/andreystarkov */
isMobile = false;

if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

jQuery(document).ready(function($) {

        $('.except-me').css({'display': 'block'});
        var slidesWrapper = $('.cd-hero-slider');
        if (slidesWrapper.length > 0) {
        var primaryNav = $('.cd-primary-nav'),
            sliderNav = $('.cd-slider-nav'),
            navigationMarker = $('.cd-marker'),
            slidesNumber = slidesWrapper.children('li').length,
            visibleSlidePosition = 0,
            autoPlayId,
            autoPlayDelay = 995000;

        // upload videos (if not on mobile devices)

        if ( !(isMobile) ) {
            uploadVideo(slidesWrapper);
/*           $('.cd-hero .background-image').each(function(){
                $(this).removeAttr("src");
            });*/
        } else {
            $('.primary-nav').prepend('<li class="menu-item"><a href="http://m-restorator.ru/">Главная</a></li>');
            $('.cd-bg-video-wrapper').each(function(){
/*                 if( $(this).hasClass('except-me') ) { $(this).remove(); }*/
            });
            $('.cd-hero .background-image').each(function(){
                /*if( $(this).hasClass('except-me') ) { */
                $(this).css({display:'block'});
                // }
            });
        }

        setAutoplay(slidesWrapper, slidesNumber, autoPlayDelay);

        primaryNav.on('click', function(event) {
            if ($(event.target).is('.cd-primary-nav')) $(this).children('ul').toggleClass('is-visible');
        });

        sliderNav.on('click', 'li', function(event) {
            event.preventDefault();
            var selectedItem = $(this);
            if (!selectedItem.hasClass('selected')) {

                var selectedPosition = selectedItem.index(),
                    activePosition = slidesWrapper.find('li.selected').index();

                if (activePosition < selectedPosition) {
                    nextSlide(slidesWrapper.find('.selected'), slidesWrapper, sliderNav, selectedPosition);
                } else {
                    prevSlide(slidesWrapper.find('.selected'), slidesWrapper, sliderNav, selectedPosition);
                }

                visibleSlidePosition = selectedPosition;

                updateSliderNavigation(sliderNav, selectedPosition);
                updateNavigationMarker(navigationMarker, selectedPosition + 1);

                setAutoplay(slidesWrapper, slidesNumber, autoPlayDelay);
            }
        });
    }
    function nextSlide(visibleSlide, container, pagination, n) {
        visibleSlide.removeClass('selected from-left from-right').addClass('is-moving').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
            visibleSlide.removeClass('is-moving');
        });

        container.children('li').eq(n).addClass('selected from-right').prevAll().addClass('move-left');
        checkVideo(visibleSlide, container, n);
    }

    function prevSlide(visibleSlide, container, pagination, n) {
        visibleSlide.removeClass('selected from-left from-right').addClass('is-moving').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
            visibleSlide.removeClass('is-moving');
        });

        container.children('li').eq(n).addClass('selected from-left').removeClass('move-left').nextAll().removeClass('move-left');
        checkVideo(visibleSlide, container, n);
    }

    function updateSliderNavigation(pagination, n) {
        var navigationDot = pagination.find('.selected');
        navigationDot.removeClass('selected');
        pagination.find('li').eq(n).addClass('selected');
    }

    function setAutoplay(wrapper, length, delay) {
        if (wrapper.hasClass('autoplay')) {
            clearInterval(autoPlayId);
            autoPlayId = window.setInterval(function() {
                autoplaySlider(length)
            }, delay);
        }
    }

    function autoplaySlider(length) {
        if (visibleSlidePosition < length - 1) {
            nextSlide(slidesWrapper.find('.selected'), slidesWrapper, sliderNav, visibleSlidePosition + 1);
            visibleSlidePosition += 1;
        } else {
            prevSlide(slidesWrapper.find('.selected'), slidesWrapper, sliderNav, 0);
            visibleSlidePosition = 0;
        }
        updateNavigationMarker(navigationMarker, visibleSlidePosition + 1);
        updateSliderNavigation(sliderNav, visibleSlidePosition);
    }

    function uploadVideo(container) {
        container.find('.cd-bg-video-wrapper').each(function() {
            var videoWrapper = $(this);
            if (videoWrapper.is(':visible')) {
                var videoUrl = videoWrapper.data('video'),
                    video = $('<video loop muted><source src="' + videoUrl + '.mp4" type="video/mp4" /><source src="' + videoUrl + '.webm" type="video/webm" /></video>');
                video.appendTo(videoWrapper);
                if (videoWrapper.parent('.cd-bg-video.selected').length > 0) video.get(0).play();
            }
        });
    }

    function checkVideo(hiddenSlide, container, n) {
        var hiddenVideo = hiddenSlide.find('video');
        if (hiddenVideo.length > 0) hiddenVideo.get(0).pause();

        var visibleVideo = container.children('li').eq(n).find('video');
        if (visibleVideo.length > 0) visibleVideo.get(0).play();
    }

    function updateNavigationMarker(marker, n) {
        marker.removeClassPrefix('item').addClass('item-' + n);
    }

    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, el) {
            var classes = el.className.split(" ").filter(function(c) {
                return c.lastIndexOf(prefix, 0) !== 0;
            });
            el.className = $.trim(classes.join(" "));
        });
        return this;
    };

});

// common func

(function($) {
    $.fn.parallax = function(options) {
        var windowHeight = $(window).height();
        var settings = $.extend({
            speed: 0.15
        }, options);
        return this.each(function() {
            var $this = $(this);
            $(document).scroll(function() {
                var scrollTop = $(window).scrollTop();
                var offset = $this.offset().top;
                var height = $this.outerHeight();
                if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                    return;
                }
                var yBgPosition = Math.round((offset - scrollTop) * settings.speed);
                $this.css('background-position', 'center ' + yBgPosition + 'px');
            });
        });
    }
}(jQuery));

function initScreen() {
    $('.cd-hero-slider li .overlay').css({
        backgroundColor: 'rgba(30,28,27,0.5)'
    });
    $('.caption div, .navigation').fadeIn(1500);
};

function animateElement(element, animation) {
    var classes = "animated " + animation;
    $(element).removeClass('faded hidden icon-hidden').css({
        translateY: '-1000px'
    }).addClass("visible " + classes);
    setTimeout(function() {
        $(element).removeClass(animation)
    }, 1500);
}

function svgDraw(svgObj, waypointObj, animationType, animationDuration) {
    if ( ($('#'+svgObj).length > 0) && ($(waypointObj).length > 0) ) {
        var theObj = new Vivus(svgObj, {
            type: animationType,
            duration: animationDuration,
            start: 'manual',
            onReady: function(obj) {
                obj.el.classList.add('svg-stroked');
            }
        }, function(obj) {
            obj.el.classList.add('svg-done');
        });
        new Waypoint({
            element: $(waypointObj),
            handler: function(direction) {
                console.log('animate! '+theObj);
                theObj.play();
            },
            offset: '75%'
        });
        return theObj;
    }
}

function initMenuElements(){
    console.log('het');
    var menuElements = '<div class="menu-buttons"><div class="menu-btn vkusno"><span class="icon-basket"></span></div><div class="menu-btn sweet"><span class="icon ot-icon-heart"></span></div></div>';
    $('.section-menu .menu-link').each(function(){
         $('.caption', this).append(menuElements);
    });
}

function hidePreload(){
  $('.page-overlay').transition({opacity: 0, y: '-110%'},1800,function(){

  });
}

function initSVGDrawings(){
    ParallaxScroll.init();
    svgDraw('svg-icon-wine', '.intro-feature', 'async', 160);
    svgDraw('svg-icon-gift', '.intro-feature', 'async', 160);
    svgDraw('svg-icon-heart', '.intro-feature', 'async', 160);
    svgDraw('svg-icon-news', '.container-news', 'async', 200);
    svgDraw('svg-icon-mail', '.section-form', 'async', 200);
    svgDraw('svg-icon-camera', '#instagram-header', 'async', 254);
    svgDraw('svg-icon-menu', '#menu-list', 'async', 154);
    svgDraw('svg-icon-camera', '#svg-icon-camera', 'async', 154);
}

function initAnimations(){
    var news = new WOW({
        boxClass: 'blog-post',
        animateClass: 'animated bounceInUp',
        offset: 10,
        delay: "0.5s",
        duration: '0.8s',
        mobile: false,
        live: true
    });
    var animObjects = new WOW({
        boxClass: 'wow',
        mobile: false,
        live: true
    });
    news.init();
    animObjects.init();
}

jQuery(window).load(function() {
  hidePreload();
  $('#nav-fish .fish-1').attr('class', 'fish');

  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.page-overlay').remove();
        $('#svg-mrestorator').addClass('.finished');
   } else {
        if ($('#svg-mrestorator').length > 0) {
            var mIcon = new Vivus('svg-mrestorator', {
                    type: 'async',
                    duration: 120,
                    start: 'manual',
                    onReady: function(obj) {
                        obj.el.classList.add('stroke');
                        setTimeout(function() {
                            obj.el.classList.add('finished');
                            initScreen();
                        }, 3200);
                    }
                },
                function(obj) {
                    $('.caption div').css({
                        opacity: '1',
                        'transition': '0.7s ease-in-out opacity'
                    });
                    obj.el.classList.add('shadowed');
                });
            setTimeout(function() {
                mIcon.play();
            }, 400);
        }
        initSVGDrawings();
        initAnimations();
   }
});

$(function() {

/*    $('.form-query').validate();
    $('.form-query input').click(function(){
        $('.form-query error').fadeOut();
    })*/
    var fuckingInputs = $('.form-query input[type=text], .form-query input[type=email], .form-query textarea');

    fuckingInputs.each(function(){
        $(this).addClass('form-control');
        $(this).css({padding: '8px 12px', height: 'auto', margin: '3px auto', 'font-size': '18px'});
    });

    $('#wpcf7').css({padding: '0 15px'});
    $('.form-query textarea').attr('rows', '4');
    $('.wpcf7-submit').addClass('btn btn-primary');

    $('input[name=your-name]').addClass('')
  //  $('#nav-fish .svg-container svg .fish-1').attr('class', '');
    $('#nav-fish').click(function(){

    });
    $('.rest-link .icon-chetverg').css({'max-width': '65%'}).addClass('svg-chetverg-active');
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.cd-slider-nav').css({height: '60px'});
    } else {
        $('.cd-slider-nav li').each(function() {
            $(this).css({
                'height': $('.cd-slider-nav').height()
            });
        });

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 20) {
                $('section.navigation').addClass('fixed');
                $('#top-navigation .logo').transition({
                    opacity: 1
                }, 1000);
                $('header').css({
                    "border-bottom": "none",
                    "padding": "26px 0"
                });
                $('header .member-actions').css({
                    "top": "20px",
                });
                $('header .navicon').css({
                    "top": "20px",
                });
            } else {
                $('section.navigation').removeClass('fixed');
                $('header').css({
                    "padding": "20px 0"
                });
                $('header .member-actions').css({
                    "top": "41px",
                });
                $('header .navicon').css({
                    "top": "48px",
                });
            }
        });
    }
    $( 'p:empty' ).remove();

 //   var underConst = $('.menu-item-535, .menu-item-36, .menu-item-537, .menu-item-536, .menu-item-538');
  //  underConst.tooltip({title: 'Раздел в разработке!'});
   // underConst.css({opacity:0.45});

  //  $('a', underConst).attr('href', '#');
 //   $('.rest-link').click(function(){

    $('.rest-link').on('click touchstart', function () {
          omg = $(this);
          $('.page-overlay').transition({opacity: 1, y: '0'},700,function(){
            window.location = omg.attr('data-href');
          });
          console.log($(this).find('.the-href').attr('href'));
    });
    $('.gallery .item').each(function(){
        $(this).append('<div class="overlay"></div>')
    });

    $("#gallery").lightGallery();

    $('top-slider .caption div').css({
        opacity: '0'
    });

    $('#recent').pongstgrm({
        accessId: '1590265550',
        accessToken: '1590265550.d8874ae.f5c1cbb59f6a4d09bf2e5ae4e6034d4f',
        show: 'recent'
    });

    $('.section-pictures .thumb').each(function() {
        $(this).append('<div class="overlay"></div>')
    });

    initMenuElements();

    $('.tip').tooltip();

    $("#btn-more-news").click(function(e) {
        loadBullshit("#btn-more-news", "news", ".container-news");
    });

    $("#btn-more-menu").click(function(e) {
        loadBullshit("#btn-more-menu", "menu", ".container-menu");
    });

    $('.sweet').click(function(){
        $(this).addClass('toggled');
        $(this).parent().parent().parent().addClass('active');
    })

});