jQuery(document).ready(function($) {

    $('.picture-slider__control').bxSlider({
        nextSelector: '.picture-slider__next',
        prevSelector: '.picture-slider__prev',
        nextText: ' ',
        prevText: ' ',
        minSlides: 3,
        maxSlides: 40,
        moveSlides: 1,
        onSliderLoad: function () {
            $(".picture .bx-pager.bx-default-pager").remove();
        }
    });

    $('.reviews__slides').bxSlider({
        nextSelector: '.reviews__next',
        prevSelector: '.reviews__prev',
        nextText: ' ',
        prevText: ' ',
        onSliderLoad: function () {
            $(".reviews .bx-pager.bx-default-pager").remove();
        }
    });

    $('.picture__slides').bxSlider({
        pagerCustom: '.picture-slider__control',
        nextText: ' ',
        prevText: ' ',
        onSliderLoad: function () {
            $(".picture .bx-pager.bx-default-pager").remove();
        }
    });

    $('.faq-item__title').on('click', function() {
        var block = $(this).parent();
        if(block.hasClass('open')) {
            $(block).removeClass('open').find('.faq-item__content').slideUp();
        } else {
            $(block).addClass('open').find('.faq-item__content').slideDown();
        }
    });

    $('.checkbox').on('click', function(e) {
        e.preventDefault();
        if($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            $(this).find('input').prop('checked', false);
        } else {
            $(this).addClass('checked');
            $(this).find('input').prop('checked', true);
        }
    });

    $('.nav__btn').on('click', function() {
        $(this).toggleClass('open')
    });

    $('.filter__title').on('click', function() {
        $(this).parent().toggleClass('open')
    });
});

;( function( window, document )
{
    'use strict';

    var file     = 'http://picville.ru/wp-content/themes/picville/images/svg-sprite.html',
        revision = 1;

    if( !document.createElementNS || !document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' ).createSVGRect )
        return true;

    var isLocalStorage = 'localStorage' in window && window[ 'localStorage' ] !== null,
        request,
        data,
        insertIT = function()
        {
            document.body.insertAdjacentHTML( 'afterbegin', data );
        },
        insert = function()
        {
            if( document.body ) insertIT();
            else document.addEventListener( 'DOMContentLoaded', insertIT );
        };

    if( isLocalStorage && localStorage.getItem( 'SVGstring2' ) == revision )
    {
        data = localStorage.getItem( 'SVGsprite2' );
        if( data )
        {
            insert();
            return true;
        }
    }

    try
    {
        request = new XMLHttpRequest();
        request.open( 'GET', file, true );
        request.onload = function()
        {
            if( request.status >= 200 && request.status < 400 )
            {
                data = request.responseText;
                insert();
                if( isLocalStorage )
                {
                    localStorage.setItem( 'SVGsprite2',  data );
                    localStorage.setItem( 'SVGstring2',   revision );
                }
            }
        };
        request.send();
    }
    catch( e ){}

}( window, document ) );

// function initMainMap() {
//     // Create a map object and specify the DOM element for display.
//     var map = new google.maps.Map(document.getElementById('map'), {
//         center: {lat: 59.9342802, lng: 30.3350986},
//         zoom: 10
//     });

//     // Create a marker and set its position.
//     new google.maps.Marker({
//         map: map,
//         position: {lat: 59.9342802, lng: 30.3350986},
//         title: '199106, Санкт-Петербург, ул. Маржелова 29'
//     });

// }

// initMainMap();