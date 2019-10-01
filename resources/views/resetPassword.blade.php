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
                                <p>Cambio de Contraseña</p>
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
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!--start-shop-head -->
                            <div class="shop-head-menu">
                                <ul>
                                <li><i class="fa fa-home"></i><a class="shop-home" href="{{route('index')}}"><span>Inicio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Cambio de Contraseña</li>
                                </ul>
                            </div>
                            <!--end-shop-head-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- about-area start -->
            <div class="about-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Ingrese la nueva contraseña para el usuario: {{$usuario->correo}} </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <form id="form-reseteo" action="" class="form">
                                    <div class="form-group col-sm-12">
                                        <label for="usr">Nueva Contraseña</label>
                                        <input type="password" class="form-control desac" id="contrasena1" required placeholder="Minino 6 caracteres" data-parsley-minlength="6" maxlength="20" >
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="usr">Repita Contraseña</label>
                                        <input type="password" class="form-control desac" id="contrasena2" required data-parsley-equalto="#contrasena1" placeholder="Repita la Contraseña" maxlength="20">
                                    </div> 

                                    <div class="col-sm-12">
                                        <h3 id="error-validacion"></h3>
                                        <button class="btn btn-lg btn-default" id="reset-pass">Cambiar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		    <!-- about-area end -->
		    <!--quality_service_area-start-->
            <div class="quality-service-area">
                <div class="container">
                    <div class="row">
                        <div class="single-quality-service">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="quality-products banner-r-b">
                                    <span class="dooon"><i class="fa fa-flag-o"></i></span>
                                    <div class="quality-text">
                                        <h4>Productos de Calidad</h4>
                                        <p>Todos los productos tienen garantia al 100%! </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="quality-products banner-r-b">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    <div class="quality-text">
                                        <h4>Variedad de Productos</h4>
                                        <p>Tenemos en nuestro Stock una inmesa diversidad de productos para su servicio</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="quality-products banner-r-b">
                                    <i class="fa fa-globe"></i>
                                    <div class="quality-text">
                                        <h4>Global Shipping</h4>
                                        <p>Envios a todas las provincias<br> del Ecuador </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="quality-products">
                                    <i class="fa fa-female"></i>
                                    <div class="quality-text">
                                        <h4>Mejor Soporte al Cliente</h4>
                                        <p>Nuestro compromiso es el servicio </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--quality_service_area-End-->
			<br>
            <div class="clear"></div>

            <!--Start-newsletter-wrap-->
            <div class="news-letter-wrap text-center home-4">
                <div class="container">
                    <div class="row">
                        <div class="news-subscribe">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="letter-text">
                                    <h3><span class="h-color">No</span> se pierda <br> <span><img src="images/newsletter/1.png" alt=""></span></h3>
                                    <p>Suscribase a nuestro boletín semanal para recibir nuestros descuentos del <span class="h-color">30%</span> en su primera compra.</p>
                                </div>
                            </div>    
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="email-area">
                                    <form class="input-group" action="#" method="post">
                                        <span class="input-group-addon icon-envlop">
                                        <i class="fa fa-envelope-o"></i>
                                        </span>
                                        <input type="email" class="form-control form_text" placeholder="Ingresa tu email aquí">
                                        <input type="submit" class="submit" value="Enviar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-newsletter-wrap-->
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
        </div>
        <!--End-main-wrapper-->
        
		<!-- all js here -->
		<!-- jquery latest version -->
        @include('js-end')
        <script src="{{asset('assets/themebasic/js/parsley.min.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#reset-pass").click(function(e){
                e.preventDefault();
                $("#reset-pass").prop('disabled',true);
                var con1 = $("#contrasena1").parsley();
                var con2 = $("#contrasena2").parsley();
                
               
                if(!con2.isValid()){
                    $("#error-validacion").text("Las contraseñas vacias o no coinciden.");
                };

                if($("#form-reseteo").parsley().isValid()){
                    $("#error-validacion").text("");
                    
                    var contr = $("#contrasena1").val();
                   
                    var identificacion = $("#documento-identi").val();

                    $.ajax({
                        type: "POST",
                        url: "{{route('reset')}}",
                        data: {"pass":contr,"ruc":"{{$ruc}}"},
                        dataType: "json",
                        success: function (response) {
                            if(response["res"] == "actualizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Exito","Hemos cambiado su contraseña con exito, Ya puede iniciar sesión con sus nuevos datos","success");

                            }else if(response["res"] == "no-actualizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Error","Problema al actualizar los contraseña","error");

                            }else if(response["res"] == "email-utilizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Inconveniente","El email que indicó ya está siendo utilizado por otro usuario.","info");
                            }

                        }
                    });
                }

            });
        </script>
    </body>
</html>
        