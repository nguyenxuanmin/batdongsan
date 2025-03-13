$(document).ready(function() {
    $('.my-slider').slick({
        autoplay: false,
        slidesToShow: 1,
        arrows: false,
    });

    const header = $('.header');

    window.onscroll = function () {
        if (window.pageYOffset > 130) {
            header.addClass('header-fixed');
            $('#scrollToTop').fadeIn();
        } else {
            header.removeClass('header-fixed');
            $('#scrollToTop').fadeOut();
        }
    };

    $('#scrollToTop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        return false;
    });
});