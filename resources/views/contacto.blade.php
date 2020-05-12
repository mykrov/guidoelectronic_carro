<!doctype html>
<html class="no-js" lang="en">
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
                                <p>Contacto</p>
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
                                    <li class="shop-pro">Contacto</li>
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
                            <div class="map-area">
                                <div id="googleMap" style="width:100%;height:410px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-contact-map-area-->
            <!--stay_in_touch_area_start-->
            <div class="stay-touch-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<form role="form" action="#" data-toggle="validator">
                            <div class="touch-text">
                                <h3>Escribenos</h3>
                            </div>
                            <div class="smal-text">
                                <p>Estamos gustosos de poder estar en contacto con usted, por favor, escribe tus datos abajo, y te escribiremos o llamaremos a la brevedad posible.</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="touch-form">
                                                
                                                    <span class="name">Nombre (requerido)</span><br>
                                                    <input type="text" name="text"  required><br>
                                                    <span class="name">Correo Electrónico (requerido)</span><br>
                                                    <input type="email" name="email" data-error="Lo sentimos, el email ingresado es incorrecto" required><br>
                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="touch-form">
                                                
                                                   <span class="name">Teléfono (requerido)</span><br>
                                                    <input  type="tel" name="tel" maxlength="13" pattern="^[0-9]{1,}$"  required><br>
                                                   <span class="name">Asunto</span><br>
                                                    <input type="text" name="text"  required><br>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="touch-textarea">
                                                <form action="#" method="post">
                                                   <span class="name">Mensaje</span><br>
                                                    <textarea name="textarea" id="textarea" cols="89" rows="5" required></textarea><br>
                                                </form>
                                                <div class="continue-butt">
                                                   
                                                        <input class="hvr-underline-from-left" type="submit" value="Enviar Mensaje">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</form>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="address-area">
                                <div class="single-address">
                                    <p><i class="fa fa-map-marker"></i> <strong class="stro">Dirección :</strong><br> <span class="add-tex">Km 11.5 Vía a Daule, Parque California 1, Bodega E-7, Guayaquil 090706, Ecuador.</span></p>
                                </div>
                                <div class="single-email">
                                    <p><i class="fa fa-envelope-o"></i><strong class="emai-stro">Email :</strong><br> <span class="email-tex"> ventas@guidoelectronic.com</span></p>
                                </div>
                                <div class="customar-supp">
                                    <p><i class="fa fa-phone"></i> <strong class="cus-stro">Atención al cliente :</strong><br> <span class="cus-tex"> +593 98 205 9105 <br>+593 42 103 880.</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--stay_in_touch_area_End-->
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
        