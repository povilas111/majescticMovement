// @koala-prepend "slick/slick.min.js"
$(document).ready(function(){
    $(window).resize(function() { //kai puslapis mazinamas
        if ($(this).width() >= 992) {
            $('.responsive-menu').hide();
            $('.meniu').css('display','flex');
        }
        else if ($(this).width() < 992 ) {
            $('.responsive-menu').show();
            $('.meniu').css('display','none');
        }

    });
    $(window).bind("load", function() {
        $('.css-loader').fadeOut();
    });
    window.onresize = function() {
        $('.css-loader').hide();
    };
    $('.hamburger').click(function () {
        $(this).toggleClass('is-active');
        $('.meniu').slideToggle('slow');
    });
    $(window).resize(function() { //kai puslapis mazinamas

        if ($(this).width() >= 992) {
            $('.header-container').addClass('container');

        }
        else if ($(this).width() < 992 ) {
            $('.header-container').removeClass('container');
            $('.header-container').addClass('container-fluid');
        }
    });
    $(window).bind("load", function() {  //kai persikrauna puslapis
        if ($(this).width() >= 992) {
            $('.header-container').addClass('container');

        }
        else if ($(this).width() < 992 ) {
            $('.header-container').removeClass('container');
            $('.header-container').addClass('container-fluid');
        }
    });


    $('.sticky-meniu').find('li a').addClass('sticky-item');
    $('.responsive-list').find('.menu-item-has-children>a').append('<i class="fa fa-plus" aria-hidden="true"></i>');
    $('.slide-down').append('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
        $('.slide-down').click(function(){
            $('.responsive-list').slideToggle('slow');
            $('.responsive-main-menu').find('.fa-plus-circle').toggleClass('rotate');


        });
        $('.menu-item-has-children>a').click(function(){
            $(this).next().slideToggle('slow');
            $(this).find('.fa').toggleClass('rotate');

        });
        $('.sticky-item-2').click(function(){
            $('.responsive-sublist-2').slideToggle('slow');

        });


    $('.product-gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        fade: true,
        asNavFor: '.product-thumb',
        prevArrow: '<button type="button" class="slick-prev"><span class="glyphicon glyphicon-menu-left"></span></button>',
        nextArrow: '<button type="button" class="slick-next"><span class="glyphicon glyphicon-menu-right"></span></button>'

    });
    $('.product-thumb').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.product-gallery',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>'
    });



});