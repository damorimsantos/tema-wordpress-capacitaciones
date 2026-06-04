jQuery(function($){

    //MENU MOBILE
        $('#toggle').click(function () {
        $(this).toggleClass('active');
        $('#fullnav').toggleClass('open');
        $('.topo').toggleClass('active');
        });
    //menu
        $('#menu li').on('click', function () {
        $('#fullnav').removeClass('open');
        $("#toggle").removeClass('active');
        });
    
    //HEADER FIXO ATIVO
            $(window).on('load', function() {
                var $win = $(window);
                var winH = $win.height();
                $(window).scroll(function() {
                    if ($(this).scrollTop() >= 40) {
                        $('#header').addClass('ativo');
                    } else {
                        $('#header').removeClass('ativo');
                    }
                });
                if ($(this).scrollTop() >= 40) {
                    $('#header').addClass('ativo');
                }
            });
    
    //CHAMADA FIXO ATIVO
            $(window).on('load', function() {
                var $win = $(window);
                var winH = $win.height();
                $(window).scroll(function() {
                    if ($(this).scrollTop() >= 300) {
                        $('.chamada_fixa').addClass('ativo');
                    } else {
                        $('.chamada_fixa').removeClass('ativo');
                    }
                });
                if ($(this).scrollTop() >= 300) {
                    $('#header').addClass('ativo');
                }
            });
    

    //SLIDER DIFERENCIAIS
    $('.slider_diferenciais').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: false,
        dots: true,
        pauseOnHover: false,
        cssEase: 'linear',
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }]
    });

    //SLIDER DEPOIMENTOS
    $('.slider_depoimentos').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: false,
        dots: true,
        pauseOnHover: false,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }]
    });
    
    //SLIDER VIDEOS
    $('.slider_videos').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: false,
        dots: true,
        pauseOnHover: true,
        cssEase: 'linear',
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }]
    });

    //SLIDER GALERIA
    $('.galeria_slider').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: false,
        dots: true,
        pauseOnHover: false,
        cssEase: 'linear',
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
            }
        }]
    });
	
	//SLIDER DEPOIMENTOS - NOVA HOME e Curso de Excel
    $('.div-depoimentos-home, .div-depoimentos-excel, .div-depoimentos-python').slick({
	  dots: true,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 3,
	  slidesToScroll: 3,
	  responsive: [
		 {
		  breakpoint: 1200,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 2,
		  }
		},
		{
		  breakpoint: 767,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
		  }
		}
	  ]
	});
    
    //TURMAS AJAX
    
    var turmasAbertasAjax = function (curso) {

            $.ajax({
                    url: wp.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'turmasAbertas',
                        curso: curso

                    },
                    beforeSend: function () {
                        $('#turmasAbertas').addClass('d-none');
                        $('.loader').removeClass('d-none');
                    }
                })
                .done(function (resposta) {
                    $('.loader').addClass('d-none');
                    $('#turmasAbertas').removeClass('d-none');
                    $('#turmasAbertas').html(resposta);

                })
                .fail(function () {
                    console.log('Ops... Algo deu errado');
                })
        }
    
    $('body').on('click','.turm',function(){
      let curso = $(this).data('curso');
      turmasAbertasAjax(curso);
    });
    
    $('body').on('click','.inscr',function(){
        $('#turmas').addClass('clicado');
      let titulo = $(this).data('titulo');
      let unidade = $(this).data('unidade');
      let turno = $(this).data('turno');
      $('input#treinamento').val(''+ titulo +' '+ unidade +' - '+ turno +'');
    });
    
    $('#formInscreva').on('hidden.bs.modal', function (e) {
        $('#turmas').removeClass('clicado');
        $('body').addClass('modal-open');
})


    $('body').on('mouseenter mouseleave','.dropdown',function(e){
  var _d=$(e.target).closest('.dropdown');
  if (e.type === 'mouseenter')_d.addClass('show');
  setTimeout(function(){
    _d.toggleClass('show', _d.is(':hover'));
    $('[data-toggle="dropdown"]', _d).attr('aria-expanded',_d.is(':hover'));
  },300);
});

    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null, // optional scroll container selector, otherwise use window,
        resetAnimation: true, // reset animation on end (default is true)
    });
    wow.init();

});
