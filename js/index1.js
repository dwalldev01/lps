var $slider = $("#slider");
$slider.on('init', function () {
	mouseWheel($slider);
}).slick({
	dots: false,
	vertical: false,
	arrows: false,
	speed: 700,
	slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    nfinite: true,
    autoplaySpeed: 2000,
	responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 680,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
	
	]
 
});

function mouseWheel($slider) {
	$('#slider').on('wheel', { $slider: $slider }, mouseWheelHandler);
}
function mouseWheelHandler(event) {
	event.preventDefault();
	var $slider = event.data.$slider;
	var delta = event.originalEvent.deltaY;
	//alert(delta);
	if (delta < 0) {
		
			$slider.slick('slickPrev');
	} else {
	$slider.slick('slickNext');
	}
}



    $('#slider').on('afterChange', function (event, slick, currentSlide) {
          var lastslide = slick.$slides.length-1;
       
        
        
        

        
    })
	
	