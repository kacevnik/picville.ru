jQuery(document).ready(function ($) {
    /*
    * Иницилизация OWL карусели, если нужно разкомментировать!
    * Сайт документации https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html
    */
    $(".main-slider__slides").owlCarousel({
        items: 1,
        loop: true,
        nav: false
    });

    //Плавная прокрутка до заданного ID элемента
    $("a[href*='#']").bind("click", function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 500);
        e.preventDefault();
        return false;
    });

    $('.price_single_product').append($('.price').html());
});