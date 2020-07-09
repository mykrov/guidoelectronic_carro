(function ($){
    "use strict";
    
    
    /*---------------------
        jQuery MeanMenu
    -----------------------*/
    jQuery('nav#dropdown').meanmenu();
    /*----------------
        Sticky Js 
    ------------------ */	
    $("#sticker").sticky({topSpacing:0});
    
    /*------------------
        wow js active
    --------------------*/
    new WOW().init();
    
    /*----------------------
        data-toggle-tooltip
    -----------------------*/
    $('[data-toggle="tooltip"]').tooltip(); 
    
    /*------------------------------
        featured-product-carousel
    -------------------------------*/
    $(".featured-carousel").owlCarousel({
        autoPlay: true, 
        slideSpeed:1500,
        items : 4,
        pagination:false,
        stopOnHover: true,
        navigation:true,
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet : [767,1],
        itemsMobile : [479,1]
    });
	
    $(".featured-carousel2").owlCarousel({
        autoPlay: true, 
        slideSpeed:2000,
        items : 3,
        pagination:false,
        navigation:true,
        stopOnHover: true,
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet : [767,1],
        itemsMobile : [479,1]
    });
    
    /*--------------------------
        newarrival-carousel
    ----------------------------*/
    $(".newarrival-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:1500,
        items : 2,
        pagination:false,
        navigation:true,
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,2],
        itemsTablet : [767,1],
        itemsMobile : [479,1]
    });
    
    /*--------------------------
    testimonial-carousel
----------------------------*/
    $(".testimonial-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:1500,
        items : 1,
		/*transitionStyle : "backSlide",*/
        pagination:false,
        navigation: true,
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsTablet : [768,1],
        itemsMobile : [479,1]
    });
    /*-----------------------
        blog-carousel
    -------------------------*/
    $(".blog-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:1500,
        items : 3,
        pagination:false,
        navigation:true,
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,2],
        itemsTablet : [767,1],
        itemsMobile : [479,1]
    });
    
    /*----------------------
        brands-carousel
    ------------------------*/
    $(".brands-carousel").owlCarousel({
    autoPlay: false, 
    slideSpeed:200,
    items : 4,
    pagination:false,
    navigation:false,
    itemsDesktop : [1199,4],
    itemsDesktopSmall : [980,3],
    itemsTablet : [767,2],
    itemsMobile : [479,1]
    });
    
    /*--------------------------
        best-carousel
    ----------------------------*/
    $(".best-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:1000,
        items : 1,
        pagination:true,
        navigation: false,
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsTablet : [768,1],
        itemsMobile : [479,1]
    });
    
    /*------------------------
        Simple Lence Active
    --------------------------- */  
	$('#p-view .simpleLens-lens-image').simpleLens({
	});
    
    /*----------------------------  
        Single Product Carousel
    ------------------------------ */ 
    $("#single-product").owlCarousel({
        autoPlay: false, 
        slideSpeed: 1500,
        items : 1,
        pagination:true,
        navigation:false,	  
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsTablet: [768,1],
        itemsMobile : [479,1],
    });    
    
    /*---------------------------
        Mega-Menu-Categories
    ----------------------------- */
	$('.category-title').on('click',function(){
		if($('.cat-single-wrap').is(':visible')){
			$('.cat-single-wrap').slideUp();
		} else {
			$('.cat-single-wrap').slideDown();
		}
	});
    
	$('.cat-single-wrap .nav > li.view-more').on('click',function(e){
		if($('.cat-single-wrap .nav > li.more-view').is(':visible')){
			$('.cat-single-wrap .nav > li.more-view').stop().slideUp();
			$(this).find('a').text('Más categorías');
		} else { 
			$('.cat-single-wrap .nav > li.more-view').stop().slideDown();
			$(this).find('a').text('Menos categorías');
		}
		e.preventDefault();
	});
    
    /*----------------
	   scrollUp
    ------------------ */	
	$.scrollUp({
       scrollText: '<i class="fa fa-long-arrow-up"></i>',
        scrollSpeed: 900,
        animation: 'fade'
    });
    
    /*------------------------------
        active login toggle function
    -------------------------------*/
	 $( '#showlogin' ).on('click', function() {
        $( '#checkout-login' ).slideToggle(700);
     }); 
	
    /*--------------------------------
        active coupon toggle function
    ----------------------------------*/
	 $( '#showcoupon' ).on('click', function() {
        $( '#checkout_coupon' ).slideToggle(700);
     });
	 
    /*---------------------------------
        Create account toggle function
   ------------------------------------*/
	 $( '#cbox' ).on('click', function() {
        $( '#cbox_info' ).slideToggle(900);
     });
	 
    /*---------------------------------
        Create account toggle function
    -----------------------------------*/
    $( '#ship-box' ).on('click', function() {
        $( '#ship-box-info' ).slideToggle(1000);
    });
    
    /*---------------------
	 countdown
	--------------------- */
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Dias</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hora</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Seg</p></span>'));
        });
    });
    
    /*-----------------------------
        price-slider active
    ------------------------------ */  
    $( "#slider-range" ).slider({
       range: true,
       min: 80,
       max: 750,
       values: [ 80, 750 ],
       slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
       }
      });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	   " - $" + $( "#slider-range" ).slider( "values", 1 ) ); 
    
    /*----------------
        Parallax
    ----------------*/
    $('.latest-trend-wrap').parallax("70%", 0.12);
    
    /*--------------------------
        Newsletter Popup 
    ---------------------------- */	
    $("#newsletter-popup-conatiner").mouseup(function(e)
    {
        var popContainer = $("#newsletter-popup-conatiner");
        var newsLatterPop = $("#newsletter-popup"); 
        if(e.target.id != newsLatterPop.attr('id') && !newsLatterPop.has(e.target).length)
        {
            popContainer.fadeOut();
        }
    });
	$('.hide-popup').on("click", function(){
        var popContainer = $("#newsletter-popup-conatiner");
		$('#newsletter-popup-conatiner')
        {
            popContainer.fadeOut();
        }
	});
    /*---------------------
        Preloader
    -----------------------*/
    var win = $(window);
    win.on('load', function() {
        $('.preloader').fadeOut('slow');;
    });


    //Add Carrito Procucto

    $(document).on('click','.add-carrito',function(e){
        e.preventDefault();
        var producto = $(this).data('id');
        var cantidad = 1;
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: "/carro-add",
            data: {'_token': token,code:producto,cantidad:cantidad},
            dataType: 'json',
            success: function (data) {
                Command: toastr["success"]("____________________", "Producto Agregado")

                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                $("header").load( location.href+(" header"));
            }
        });

    });

    $(document).on('click','.vaciar-carro',function(e){
        e.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/vaciar-carro",
            data: {'_token': token},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("header").load( location.href+(" header"));

                if ($(".carro-table")[0]) {
                    $(".carro-table").load( location.href+(" .carro-table"));
                } 
            }
        });

    });
    
    $(document).on('click','.vista-modal',function(e){
        e.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');
        var code = $(this).data('code');
        $.ajax({
            type: "POST",
            url: "/modal",
            data: {'_token': token,'code':code},
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                if (data['Graba_Iva'] == 'S') {
                    $("#modal-precio").text('$'+(parseFloat(data['precio2']) * iva_global + parseFloat(data['precio2']) ).toFixed(2));
                }else{
                    $("#modal-precio").text('$'+(parseFloat(data['precio2'])).toFixed(2));
                }

                $("#modal-nombre").text(data["descripcion"]);
                $("#modal-codigo").text(data['idproducto']);
                
                $("#modal-imagen").attr('src','/assets/productos/'+data['idproducto'].trim()+'.jpg');
               
            }
        });
    }); 

    $(document).on('click','.realizar-pedido',function(e){

        e.preventDefault();
        $('.realizar-pedido').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: "/realizar-compra",
            data: {'_token':$('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            success: function (response) {
                
                if (response == 'menor_30') {
                    $('#realizar-pedido').attr('disabled', false);
                    swal("Pedido menor a $30!", "Estimado cliente los pedidos deben ser superiores al monto minimo.", "error");                           
                } else if (response == "carro_vacio") {
                    $('#realizar-pedido').attr('disabled', false);
                    swal("Upss","Verifica que tengas productos en el carro", "error");
                } else if (response == "pedido_guardado") {
                    swal("Pedido Registrado con Exito","Felicidades su pedido ha sido almacenado", "success");
                }
            }
        });
    });
})(jQuery);
