<!doctype html>
<html class="no-js" lang="en">
    <style>
        .br-bot{
            border-bottom: 2px solid;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .col-md-6 p{
            text-align: justify;
            font-size: 2rem;
           
        }

        .vcenter{
            display: inline-block;
            vertical-align: middle;
            float: none;
        }
    </style>
  @include('head-meta')
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <!--Start-Preloader-area-->
        <div class="preloader">
            <div class="loading-center">
                <div class="loading-center-absolute">
                    <div class="object object_one"></div>
                    <div class="object object_two"></div>
                    <div class="object object_three"></div>
                </div>
            </div>
        </div>
        <!--end-Preloader-area-->
        <!--header-area-start-->
        <!--Start-main-wrapper-->
        <div class="page-4">
            <!--Start-Header-area-->
          @include('header')
            <!--End-Header-area-->
            <!--start-single-heading-banner-->
            <div class="single-banner-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="single-ban-top-content">
                                <p>Como Comprar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-single-heading-banner-->
            <!--start-single-heading-->
            <div class="signle-heading">
                <div class="container">
                    <div class="row">
                        <!--start-shop-head -->
                        <div class="col-lg-12">
                            <div class="shop-head-menu">
                                <ul>
                                <li><i class="fa fa-home"></i><a class="shop-home" href="{{route('index')}}"><span>Inicio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Como Comprar</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!--contact-map-area-start-->
            <div class="map-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <h1>Guia de Cómo Comprar.</h1>
                           <p style="font-size: 2rem;">Es muy simple!, para comprar en nuestra web solo debes seguir los siguientes pasos:</p>
                           <div class="row br-bot" >
                               <div class="col-md-6 vcenter">
                                    <p>El usuario debe registrarse en la página mediante el formulario que podra encontar en la sección de inicio de sesión y  porceder a activar el usuario a través de link que será enviado a su correo electrónico.</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{asset('assets/themebasic/images/guia/1.jpg')}}" style="max-height: 300px" alt="">
                                </div>    
                           </div>
                           <div class="row br-bot">
                               <div class="col-md-6 vcenter" style="padding-top:2rem">
                               <p> Una vez activado el usuario podrá acceder en la sección Iniciar Sesión (parte superior derecha).</p>
                           </div>
                           <div class="col-md-6" style="padding-top:2rem">
                               <p> <img src="{{asset('assets/themebasic/images/guia/2.jpg')}}" style="max-height: 300px" alt="">
                           </div>
                           </div>
                                          
                           <div class="row br-bot">
                               <div class="col-md-6">
                                <p>Seguidamente puede navegar por las diferentes categorías de productos e ir añadiéndolos al carro de compra, en la parte superior podrá observar el contenido del carro.</p>
                                </div>
                                <div class="col-md-6" style="padding-top:2rem">
                                        <img src="{{asset('assets/themebasic/images/guia/3.jpg')}}" style="max-height: 300px" alt="" style="padding-top:2rem">
                                </div>
                            </div>
                            <div class="row br-bot">
                               <div class="col-md-6 vcenter">
                               <p> Una vez teniendo todos los productos deseados puede proceder a ver la orden donde podrá ver una lista de los productos, cantidad, precio entre otros detalles.</p>
                                </div>
                                <div class="col-md-6">
                                        <img src="{{asset('assets/themebasic/images/guia/4.jpg')}}" style="max-height: 300px" alt="" style="padding-top:2rem">
                                </div>
                            </div>
                                <div class="row br-bot">
                               <div class="col-md-6 vcenter">
                                <p>Ya satisfecho con la información mostrada puede proceder al “Checkout” de la compra donde se muestran detalles del envío y costo total de la orden y el botón de “Realizar Pedido”.</p>
                           </div>
                                <div class="col-md-6">
                                        <img src="{{asset('assets/themebasic/images/guia/5.jpg')}}" style="max-height: 300px" alt="" style="padding-top:2rem">
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!--end-contact-map-area-->
            
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
            
        </div>
        <!--End-main-wrapper-->
        
		@include('js-end')
        
        <!-- Google Map js -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9PVYKr0fwtx4R9e7PTSj8qL1hhMU7My0"></script>
		<script>
			function initialize() {
			  var mapOptions = {
				zoom: 19,
				scrollwheel: false,
				center: new google.maps.LatLng(-2.101770, -79.936992)
			  };
                
			  var map = new google.maps.Map(document.getElementById('googleMap'),
				  mapOptions);
                
			  var marker = new google.maps.Marker({
				position: map.getCenter(),
				animation:google.maps.Animation.BOUNCE,
				icon: 'images/icon/map-marker.png',
				map: map
			  });
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
        