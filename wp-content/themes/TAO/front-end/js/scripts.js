jQuery( document ).ready(function($) {

    $('html').removeClass('no-js');

    window.sr = ScrollReveal({ reset: false });

    sr.reveal('.section-content .col-12', {
        duration: 600,
        opacity: 0,
        delay: 150,
        scale: 1
    });

    sr.reveal('.water .instruction-title', {
        duration: 600,
        opacity: 0,
        delay: 150,
        scale: 1
    });


    $('.main-navigation a').on('click', function () {
        $('.mobileMenuWrap').removeClass('mobileMenuWrap-showed');
        $('.open-menu-btn').removeClass('active');
    });

    $('#open-menu').click(function() {
        $('.mobileMenuWrap').toggleClass('mobileMenuWrap-showed');
        $('.open-menu-btn').toggleClass('active');
    });

    $('.closeMobileMenu').click(function() {
        $('.mobileMenuWrap').removeClass('mobileMenuWrap-showed');
        $('.open-menu-btn').removeClass('active');
    });

    $('.scroll-down').click(function () {
        if ($(this).closest('.so-panel').next().length) {
            $('html, body').animate({
                scrollTop: $(this).closest('.so-panel').next().offset().top
            }, 700);
        }
    });

    var offset = 500;
    var duration = 300;
    $(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    $('.active_img-close').on('click', function () {
        $.fancybox.close();
    });

    $(".gallery-item").fancybox({
        openEffect  : 'elastic',
        closeEffect : 'none',
        padding: 0,
        wrapCSS: 'gallery-active-wrap',
        buttons: false,
        helpers: {
            title: {
                type: 'inside'
            },
            overlay : {
                css : {
                    'background' : 'rgba(213, 238, 242, 0.75)'
                }
            },
            arrows: {
                tpl: '<a class="fancybox-nav fancybox-prev" href="javascript:;"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>' +
                '<a class="fancybox-nav fancybox-next" href="javascript:;"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>'
            }
        },
        tpl: {
            closeBtn: '<a title="Close" class="fancybox-item fancybox-close active_img-close" href="javascript:;"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a>',
            next: '<a class="fancybox-nav fancybox-next" href="javascript:;" title="Next"><span><i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i></span></a>',
            prev: '<a class="fancybox-nav fancybox-prev" href="javascript:;" title="Previous"><span><i class="fa fa-2x fa-chevron-left" aria-hidden="true"></i></span></a>'
        },
        beforeShow: function (data) {
            $('.gallery-active-wrap').attr('data-color', $(this.element[0]).attr('data-color'));
        }
    });

    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });


});