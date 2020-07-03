<!doctype html>
<html class="no-js" lang="en">
    @section('head-meta')
        @include('head-meta')

        @php
            if (\Session::has('usuario-tipo')) {
                $tipo = \Session::get('usuario-tipo');

                if (trim($tipo) == 'CTB') {
                    $precioAc = 'precio2';
                } elseif (trim($tipo) == 'CTC') {
                    $precioAc = 'precio3';
                }elseif (trim($tipo) == 'CTD') {
                    $precioAc = 'precio4';
                }elseif (trim($tipo) == 'CTE') {
                    $precioAc = 'precio5';
                }elseif (trim($tipo) == 'CTA'){
                    $precioAc = 'precio';
                }
            } else {
                $precioAc='precio2';
            }

             $precioAc='precio2';
        @endphp 
    @show
  
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <!--Start-Preloader-area-->
        <div class="preloader">
            <div class="loading-center">
                <div class="loading-center-absolute">
                    <div class="object object_one home-4"></div>
                    <div class="object object_two home-4"></div>
                    <div class="object object_three home-4"></div>
                </div>
            </div>
        </div>
        <!--end-Preloader-area-->
        <!--header-area-start-->
        <!--Start-main-wrapper-->
        <div class="page-4">
            @section('header')
                @include('header')
                @include('ws')
            @show
            
            @section('slider')
               
            @show

            <!-- Start-slider-->
        
            <!-- End-slider-->
			
            <!--Start-latest-products-wrap-->
            <div class="latest-products-wrap home-4 padding-t">
					<div class="container">
						<div class="row">
				        <!--start-categry-area-->
                        <div class="col-lg-3 col-md-3">
                            <div class="category-main-wrap home-4 hidden-sm hidden-xs">
                                <div class="category-title"><h3>Categorias</h3></div>
                                    <div class="cat-single-wrap">
                                        <ul class="nav">
                                            @foreach ($cates as $lefcate)
                                                <li>
                                                    <a class="{{$lefcate->idcategoria}}" href="javascript:void(0);">{{$lefcate->nombre}}</a>
                                                    <div class="single-wrap tablet">
                                                        <div class="cat-wrap">
                                                            <ul class="nav">
                                                                @foreach ($familias as $familia)
                                                                    @if ($familia->idcategoria == $lefcate->idcategoria)
                                                                        <li><a href="familia/{{trim($familia->idfamilia)}}">{{$familia->nombre_familia}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
										{{-- <li class="cat-none"><a class="escritura" href="#">Escritura</a></li>
                                        <li class="cat-none"><a class="limpieza" href="#">Insumos de Limpieza</a></li>    
                                        <li class="cat-none"><a class="higienico" href="#">Papel Higiénico</a></li>
                                        <li class="more-view"><a class="papeleria" href="#">Papelería</a></li>
                                        <li class="more-view"><a class="seguridad" href="#">Seguridad Industrial</a></li>
										<li class="more-view"><a class="oficina" href="#">Útiles de Oficina</a></li>
										<li class="more-view"><a class="escolares" href="#">Útiles Escolares</a></li> --}}
                                        {{-- <li class="view-more"><a href="#">Más categorías</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end-category-area-->
					@include('banners')
                    <hr>
                
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="latest-content text-center">
                        <div class="section-heading">
                            <h3 class="animate__animated animate__bounce" ><span class="h-color">Productos</span> Nuevos</h3>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="featured-carousel2 indicator">
                            @foreach ($proNuevos as $itemNuevo)
                                  <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="single-product">
                                    {{-- <div class="sale">-20%</div> --}}
                                    {{-- <div class="sale-border"></div> --}}
                                        <div class="product-img-wrap"> 
                                            @if(file_exists("assets/productos/".trim($itemNuevo->idproducto).".jpg"))
                                                <a class="product-img" href="single/{{trim($itemNuevo->idproducto)}}"> <img src="/assets/productos/{{trim($itemNuevo->idproducto)}}.jpg" alt="product-image" /></a>
                                            @else
                                                
                                                <a class="product-img" href="single/{{trim($itemNuevo->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                            @endif
                                            
                                            <div class="add-to-link"> 
                                               
                                                <a data-toggle="modal" data-code="{{trim($itemNuevo->idproducto)}}" class="vista-modal" data-target="#productModal" href="#">
                                                    <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                                </a>
                                                {{-- <a href="#">
                                                    <div><i class="fa fa-random"></i><span>Comparar</span></div>
                                                </a> --}}
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($itemNuevo->idproducto)}}">
                                                    <div><i class="fa fa-shopping-cart"></i><span>Añadir</span></div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-info text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">{{$itemNuevo->descripcion}}</h3></a>
                                                <div class="pro-rating">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li class="r-grey"><i class="fa fa-star"></i></li>
                                                        <li class="r-grey"><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="pro-price">
                                                    <span class="price-text">Precio:</span>
                                                    <span class="normal-price">
                                                        @if ($itemNuevo->Graba_Iva == "S")
                                                            ${{round($itemNuevo->$precioAc*$parametros->iva+$itemNuevo->$precioAc,2)}}
                                                        @else
                                                            ${{$itemNuevo->$precioAc}}
                                                        @endif
                                                    </span>
                                                    <span class="old-price"><del>${{$itemNuevo->$precioAc}}</del></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End-single-product -->
                                @endforeach
                            
                                </div>
                            </div>
                            @include('destacados')
                           <div >
                            <div class="latest-content">
                                    <div class="section-heading">
                                        <h3 style="font-size: 50px;" class="my-element" ><span class="h-color">Promociones</span></h3>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner banner-r-b">
                                            <a href="#"><img class="img-fluid" alt="Hi Guys" src="{{asset('assets/productos/promocion/camara8final.jpg') }}" style=" height: auto;" /></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="Hi Guys" src="{{asset('assets/productos/promocion/camarafinal.jpg') }}" style=" height: auto;" /></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12" style="padding-top: 2rem">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="Hi Guys" src="{{asset('assets/productos/promocion/soporte.jpg') }}"  style=" height: auto;"/></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="Hi Guys" src="{{asset('assets/productos/promocion/sonido.jpg') }}"  style=" height: auto;"/></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
				        </div>
     
                        
				    </div>
                </div>
            </div>
            <!--End-latest-products-wrap-->
            
            <!-- Start-featured-area-->
            
            <!--End-featured-area-->
            <!--Satar-business-policy-wrap-->
            <div class="business-policy-wrap padding-t">
                
            </div>
            <!--End-business-policy-wrap-->
            <!--Start-banner-area-->
            <div class="banner-area padding-t home-4 banner-dis">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-banner banner-r-b">
                                <a href="#"><img alt="Hi Guys" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL'])}}" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-banner">
                                <a href="#"><img alt="Hi Guys" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL2'])}}" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <!--End-banner-area-->
            <div class="clear"></div>
             <!--Start-top-catagories-wrap-->
         
            <!--End-top-categories-wrap-->
            <!--Start-latest-testimonials-->    
            
            <!--End-latest-testimonials-->
            <!--Start-variety-products-wrap-->
          
            <!--End-variety-products-wrap-->
            <!--Start-newsletter-wrap-->
            
            <!--End-newsletter-wrap-->
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
             
        </div>
        <!--End-main-wrapper-->
        <!-- Quickview-product-strat -->
        @include('modal')
        <!-- End quickview product -->

        @include('js-end')

        @if (session('compraResult') != '')
            <script>
                swal("Pedido Registrado con Exito","{{ session('compraResult') }}", "success");
            </script> 
        @endif
        
        @if(session('message') != '')
            @include('message')
        @endif
        
		<!-- all js here -->
		
    </body>
</html>     