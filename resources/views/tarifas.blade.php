<!doctype html>
<html class="no-js" lang="en">
    @include('head-meta')
    @include('ws')
    <style>
        thead{
            font-size: 2rem;
        }
        tbody{
            font-size: 2rem;
            border: 1px solid #CCC;
        }
    </style>
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
                                <p>Tarifas de Envio</p>
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
                                    <li class="shop-pro">Tarifas de Envio</li>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="single-banner">
                                <a href="#"><img src="images/about/1.jpg" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="about-text">
                                <h2>Listado de Tarifas de envio:</h2>
								<div>
                                    <table class="table table-striped ">
                                       <thead class="thead-dark" >
                                           <tr>
                                                <th>Destino</th>
                                                <th>Costo</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach ($tarifas as $item)
                                               <tr>
                                                    <td>{{$item->nombre}}</td>
                                                    <td>{{$item->costo}}$</td>
                                               </tr>
                                           @endforeach
                                       </tbody>
                                    </table>
                                </div>
                                
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
           
            <!--End-newsletter-wrap-->
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
        </div>
        <!--End-main-wrapper-->
        
		<!-- all js here -->
		<!-- jquery latest version -->
        @include('js-end')
    </body>
</html>
        