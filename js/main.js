jQuery(document).ready(function ($) {		
	$('.search-icon').click(function(event) {
		if($(this).find('.fa').hasClass('fa-search')){
			$(this).parent().find('.search-form').fadeIn(400);
			$(this).find('.fa-search').removeClass('fa-search').addClass('fa-close');
		}
		else if($(this).find('.fa').hasClass('fa-close')){
			$(this).parent().find('.search-form').fadeOut(400);
			$(this).find('.fa-close').removeClass('fa-close').addClass('fa-search');
		}
	});


	/**
	*
	* Иницилизация параллакс эфекта для всех элементов
	* Следует задать для элемента атрибут от 0 до 1:
	* data-stellar-background-ratio="0.1"
	* где 0 - задний фон неподвижный, 1 - скорость основного скрола
	* так же желательно задать элементу свойсво стиля background-attachment: fixed;
	*/
	$.stellar();


	/*
	* Иницилизация OWL карусели, если нужно разкомментировать!
	* Сайт документации https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html
	*/
	$("#slider").owlCarousel({
		//items:4,			        //количество элементов, если есть responsive - не работает(3)
		loop:true,                  //зацикливание (false)
	    //margin:10,                //отступы margin-right для элемента в px (0)
	    nav:false,                  //отображение кнопок управления, вперед и назад(false)
	    autoplay: true,             //прокручивание карусели (false)
	    //autoplayTimeout:1000,       //Скорость прокрутки в милисекундах (5000)  
	    autoplayHoverPause: false,  //Остановка при наведении курсора (false) 
	    //autoplaySpeed: 5000,        //скорость самой анимации перехода в милисикундах или false (false)
	    responsive:{                //Респонсив количество элементов
	        0:{
	            items:2
	        },
	        600:{
	            items:4
	        },	        
	        800:{
	            items:5
	        },
	        1000:{
	            items:6
	        }
	    }
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
});