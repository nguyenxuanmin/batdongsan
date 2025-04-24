$(document).ready(function() {
    const header = $('.header');
    window.onscroll = function () {
        if (window.pageYOffset > 130) {
            header.addClass('header-fixed');
            $('#scroll-to-top').fadeIn();
        } else {
            header.removeClass('header-fixed');
            $('#scroll-to-top').fadeOut();
        }
    };

    $('#scroll-to-top').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        return false;
    });

    $('.item-show-menu').click(function() {
        $("#menu-mobile").addClass("show-menu");
    });

    $('.item-hide-menu').click(function() {
        $("#menu-mobile").removeClass("show-menu");
    });

    $('#menu-mobile ul li a').click(function() {
        $("#menu-mobile").removeClass("show-menu");
    });
    
    $('.my-slider').slick({
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
    });
    
    $('.my-news').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        nextArrow:
            '<div class="slick-arrow slick-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>',
        prevArrow:
            '<div class="slick-arrow slick-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>',
        autoplay: true,
        arrows: true,
        autoplaySpeed: 3000,
        responsive: [
            {
            breakpoint: 1025,
                settings: {
                    slidesToShow: 2
                }
            },
            {
            breakpoint: 992,
                settings: {
                    slidesToShow: 1
                },
            }
        ]
    });
});