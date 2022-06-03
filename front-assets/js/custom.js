jQuery(document).ready(function($) {
    $(function() {
        $('#reservation_date').flatpickr({
            'enableTime': true,
            'format': 'D/M/Y h:i',
            "minDate": "today",
        });

        $('#reservationDate').flatpickr({
            'enableTime': true,
            'format': 'D/M/Y h:i',
            'minDate' : "today",
        });
    });

    $('.navbar').scrollToFixed();


    if ($(window).width() < 991) {
        var summaries = $('.mina_menu_tabs .nav-tabs');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: $('#main_header').outerHeight(true) - 10,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        limit = $('.mina_grand_menu-next').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    } else {
        var summaries = $('.mina_menu_tabs .nav-tabs');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: $('#main_header').outerHeight(true) - 55,
                limit: function() {
                    var limit = 0;
                    if (next) {
                        limit = $(next).offset().top - $(this).outerHeight(true) - 10;
                    } else {
                        limit = $('.mina_grand_menu-next').offset().top - $(this).outerHeight(true) - 10;
                    }
                    return limit;
                },
                zIndex: 999
            });
        });
    }

    // fancy box 
    $(".gallery__block a.fancy-box").fancybox({
        afterLoad: function(instance, current) {
            var caption = this.opts.text;
            if (instance.group.length > 1 && current.$content) {
                current.$content.append('<div class="popup-caption" style="position: relative;">' + caption + '</div>');
            }
        }
    });

    $('body').on('click', '.navbar-toggler', function() {
        $(this).toggleClass('on');
        $('.mobile-nav').toggleClass('show');
        $('body').toggleClass('body-hidden');
    });



    // tab 

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        infinite: false,
        adaptiveHeight: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        // dots: true,
        // centerMode: true,
        centerPadding: '50px',
        focusOnSelect: true,
        infinite: false,
        arrows: true,
        nextArrow: '<i class="fa fa-angle-right next"></i>',
        prevArrow: '<i class="fa fa-angle-left prev"></i>',

        responsive: [{
                breakpoint: 768,
                settings: {
                    // arrows: false,
                    // centerMode: true,
                    // centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    // arrows: false,
                    // centerMode: true,
                    // centerPadding: '40px',
                    slidesToShow: 2,
                    centerPadding: '10px',
                }
            }
        ]
    });

    $(".banner_section").slick({
        infinite: true,
        speed: 1500,
        autoplay: true,
        fade: true,
        cssEase: 'linear',
        pauseOnHover: false,
        responsive: [{
                breakpoint: 768,
                settings: {
                    // arrows: false,
                    // centerMode: true,
                    // centerPadding: '40px',
                    // slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    // centerMode: true,
                    // centerPadding: '40px',
                    dots: true,

                }
            }
        ]
    });

    $("#testimonial").slick({
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        arrows: false,
        fade: true,
        cssEase: 'linear',
        pauseOnHover: false,
    });

    $(".menu__slider").slick({
        autoplay: true,
        autoplaySpeed: 5000,
        dots: false,
        arrows: false,
        // fade: true,
        cssEase: 'linear',
        slidesToShow: 4,
        slidesToScroll: 1,
        pauseOnHover: false,
        centerMode: true,
        centerPadding: '100px',
        focusOnSelect: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    centerPadding: '65px',
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerPadding: '45px',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '30px',
                }
            }
        ]
    });


    function customMatchHeight() {
        $('.mina_item_description').matchHeight();
        $('.item_title_price').matchHeight();
        
        // $('.item_title_price h2').matchHeight();
    }

    customMatchHeight();

    function goTop() {
        // hide #back-top first
        $(".scrollToTop").hide();

        //fade in #back-top
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('.scrollToTop').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });

    }

    goTop();






    // aos init 
    // AOS.init();

    AOS.init({
        once: false
    });

    window.addEventListener('load', AOS.refresh)

    $('.mobile-nav .reservation').on('click', function(e) {
        //prevent the default action
        e.preventDefault();
        console.log('i need to show the modal');
        $('#reservationModal').modal('show');
    });



    //reset the modal on close
    $("#reservationModal").on('hidden.bs.modal',function(){
        $("#reservationModal").find('form')
    })



    $('.spicy-labels .info').on('click', function(e) {
        // e.preventDefault();
        $('#modal-spiecy-level').modal('show');
    });

    $('.mina_menu_tabs .nav-tabs a').on('click', function(e) {
        var href = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(href).offset().top - 140
        }, 'slow');
        e.preventDefault();
    });


    $('body').on('click','.dropdown_cart_list .nav-item-link', function(e) {
        e.preventDefault();
        $('.mini_cart_dropwn').toggleClass('show');
        $('.mini_cart_dropwn').slideToggle(500);
        $('body').toggleClass('body-hidden');
    });

    $('body').on('click','.hide-minicart', function(e) {
        e.preventDefault();
        $('.mini_cart_dropwn').toggleClass('show');
        $('.mini_cart_dropwn').slideToggle(500);
        $('body').toggleClass('body-hidden');
    });

    $('body').on("click",'.input-qty', function() {
        var $button = $(this);
        var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        if(newVal == 1){
            $button.closest('.sp-minus').addClass('disabled')
        }

        if(newVal > 1){
           $button.parent().closest('.sp-quantity').find('.sp-minus').removeClass('disabled')
        }

        $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);

    });

    //add to takeout button on click
    $('body').on('click','#addToTakeout', function(e) {
        $(this).parent().closest('div.add_to_takeout_btn').find('form.addToTakeoutForm').submit();
    });


});

//add sticky menu when the user scroll to certain height
$(window).scroll(function() {
    //get the  scrollTop height of the banner
    // var banner_section = document.getElementById("banner_section");
    // banner_section = banner_section.offsetTop + 100;
    // if (window.pageYOffset >= banner_section) {
    //     $('header').addClass('fixedNavbar');
    // } else {
    //     $('header').removeClass('fixedNavbar');
    // }
});

$(window).on("load resize", function(e) {
    // if ($(window).width() < 991) {
    //     $('.mobile-nav .dropdown_cart_list').appendTo('.language-xs');
    // } else {

    // }
    // jQuery('ul.mini_cart_list').scrollbar();
    // $(".mini_cart_dropwn ul.mini_cart_list").niceScroll();
});

(function($) {
    $(window).on("load", function() {
        $(".navbar .mini_cart_dropwn ul.mini_cart_list").mCustomScrollbar({
            theme: "dark",
        });
        $(".checkout-details .mini_cart_dropwn ul.mini_cart_list").mCustomScrollbar({
            theme: "dark",
        });
    });
})(jQuery);

$(window).on("load ", function(e) {
    $(".loader").fadeOut("slow");;

});