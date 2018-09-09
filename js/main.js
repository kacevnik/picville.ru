jQuery(document).ready(function ($) {
    $('.price_single_product').append($('.price').html());

    //Плавная прокрутка до заданного ID элемента
    $("a[href*='#']").bind("click", function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 500);
        e.preventDefault();
        return false;
    });
});