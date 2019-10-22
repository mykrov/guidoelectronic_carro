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
                $precioAc='precio';
            }
        @endphp 
    @show
  
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
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
                @include('slider-index')
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
						
                
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="latest-content text-center">
                        <div class="section-heading">
                            <h3><span class="h-color">Productos</span> Nuevos</h3>
                          
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
                                                        ${{($itemNuevo->$precioAc*$parametros->iva)+$itemNuevo->$precioAc}}
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
					</div>
					</div>
                </div>
            </div>
            <!--End-latest-products-wrap-->
            @include('banners');
            <!-- Start-featured-area-->
            @include('destacados');
            <!--End-featured-area-->
            <!--Satar-business-policy-wrap-->
            <div class="business-policy-wrap padding-t">
                <div class="container">
                    <div class="row">
                       <!--Satar-single-p-wrap-->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="single-p-wrap banner-r-b text-center">
                                <span><i class="fa fa-plane"></i></span>
                                <h4>{{$texto->where('seccion','Servicio1')->first()->contenido}}</h4>
                            </div>
                        </div>
                        <!--end-single-p-wrap-->
                        <!--Satar-single-p-wrap-->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="single-p-wrap banner-r-b text-center">
                                <span><i class="fa fa-life-ring"></i></span>
                                <h4>{{$texto->where('seccion','Servicio2')->first()->contenido}}</h4>
                            </div>
                        </div>
                        <!--end-single-p-wrap-->
                        <!--Satar-single-p-wrap-->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="single-p-wrap banner-r-b text-center">
                                <span><i class="fa fa-money"></i></span>
                                <h4>{{$texto->where('seccion','Servicio3')->first()->contenido}}</h4>
                            </div>
                        </div>
                        <!--end-single-p-wrap-->
                        <!--Satar-single-p-wrap-->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="single-p-wrap text-center">
                                <span><i class="fa fa-clock-o"></i></span>
                                <h4>{{$texto->where('seccion','Servicio4')->first()->contenido}}</h4>
                            </div>
                        </div>
                        <!--end-single-p-wrap-->
                    </div>
                </div>
            </div>
            <!--End-business-policy-wrap-->
            <!--Start-banner-area-->
            <div class="banner-area padding-t home-4 banner-dis">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="single-banner banner-r-b">
                                <a href="#"><img alt="Hi Guys" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL'])}}" /></a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="single-banner">
                                <a href="#"><img alt="Hi Guys" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL2'])}}" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-banner-area-->
            <div class="clear"></div>
             <!--Start-top-catagories-wrap-->
            {{-- <div class="latest-products-wrap home-4 padding-t">
                <div class="container">
                    <!--start-top-categories-heading-->
                    <div class="latest-content text-center">
                        <div class="section-heading">
                            <h3><span class="h-color">Top</span> Categorias</h3>
                        </div>
                    </div>
                    <!--end-top-categories-heading-->
                    <div class="row">
                        <div class="featured-carousel indicator">
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="sale">-5%</div>
                                <div class="sale-border"></div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"><img src="{{asset('assets/themebasic/images/product/26.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Energía</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="sale">-10%</div>
                                <div class="new">NUEVO</div>
                                <div class="sale-border"></div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/33.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Insumos de Limpieza</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="sale">-5%</div>
                                <div class="sale-border"></div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/27.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Suministros de Tecnología</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="new">NUEVO</div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Descartable</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="sale">-10%</div>
                                <div class="sale-border"></div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/34.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Consumo</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                            <!-- Start-single-product -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-product">
                                <div class="sale">-30%</div>
                                <div class="new">Nuevo</div>
                                <div class="sale-border"></div>
                                    <div class="product-img-wrap"> 
                                        <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/35.jpg')}}" alt="product-image" /></a>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart">
                                                <div><span>Ver más</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="#"><h3 class="pro-name">Archivos</h3></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End-single-product -->
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--End-top-categories-wrap-->
            <!--Start-latest-testimonials-->    
            <div class="latest-testimonial-wrap home-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <!--start-testimonial-heading-->
                            <div class="testimonial-heading home-4">
                                <div class="section-heading">
                                    <h3><span class="h-color">Últimos</span> Testimonios</h3>
                                </div>
                            </div>
                            <!--End-testimonial-heading-->
                        </div>
                    </div>
                </div>
                <div class="main-testimonial home-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="testimonial-carousel indicator">
                                    <!--single-testimonial-start-->
                                    <div class="single-testimonial">
                                        <div class="testimonial-img">
                                            <p><img src="{{asset('assets/themebasic/images/testimonial/'.$imagen['testi1'])}}" alt=""></p>
                                        </div>
                                        <div class="testimonial-des home-1">
                                            <p>{{$texto->where('seccion','Testimonio1')->first()->contenido}}</p>
                                        </div>
                                        <div class="testimonial-author">
                                            <h5>{{$texto->where('seccion','TestimonioAutor1')->first()->contenido}}</h5>
                                        </div>
                                    </div>
                                    <!--single-testimonial-end-->
                                    <!--single-testimonial-start-->
                                    <div class="single-testimonial">
                                        <div class="testimonial-img">
                                            <p><img src="{{asset('assets/themebasic/images/testimonial/'.$imagen['testi2'])}}" alt=""></p>
                                        </div>
                                        <div class="testimonial-des">
                                            <p>{{$texto->where('seccion','Testimonio2')->first()->contenido}}</p>
                                        </div>
                                        <div class="testimonial-author">
                                            <h5>{{$texto->where('seccion','TestimonioAutor2')->first()->contenido}}</h5>
                                        </div>
                                    </div>
                                    <!--single-testimonial-end-->
                                    <!--single-testimonial-start-->
                                    <div class="single-testimonial">
                                        <div class="testimonial-img">
                                            <p><img src="{{asset('assets/themebasic/images/testimonial/'.$imagen['testi3'])}}" alt=""></p>
                                        </div>
                                        <div class="testimonial-des">
                                            <p>{{$texto->where('seccion','Testimonio3')->first()->contenido}}</p>
                                        </div>
                                        <div class="testimonial-author">
                                            <h5>{{$texto->where('seccion','TestimonioAutor3')->first()->contenido}}</h5>
                                        </div>
                                    </div>
                                    <!--single-testimonial-end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <!--End-latest-testimonials-->
            <!--Start-variety-products-wrap-->
            {{-- <div class="variety-products-wrap home-4 padding-t">
                <div class="container">
                    <div class="row">
                        <!--start-best-seller-product-->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="best-heading">
                                <div class="section-heading best-h">
                                    <h3><span class="h-color">Más</span> Vendidas</h3>
                                </div>
                            </div>
                            <div class="best-carousel">
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/31.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/28.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/30.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/26.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                            </div>
                        </div>
                        <!--end-best-seller-product-->
                        <!--start-Top-rated-product-->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 top-rated">
                            <div class="best-heading">
                                <div class="section-heading best-h">
                                    <h3><span class="h-color">Ventas</span> Recientes</h3>
                                </div>
                            </div>
                            <div class="best-carousel">
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/27.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/33.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/32.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                            </div>
                        </div>
                        <!--end-Top-rated-product-->
                        <!--start-best-offer-product-->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 best-off">
                            <div class="best-heading">
                                <div class="section-heading best-h">
                                    <h3><span class="h-color">Mejores</span> Ofertas</h3>
                                </div>
                            </div>
                            <div class="best-carousel">
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/32.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/33.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                                <!--start-double-best-product-->
                                <div class="best-double-product">
                                    <!-- Start-single-product -->
                                    <div class="single-product margin-b">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/26.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                    <!-- Start-single-product -->
                                    <div class="single-product">
                                        <div class="product-img-wrap best-s-w"> 
                                            <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/30.jpg')}}" alt="product-image" /></a>
                                        </div>
                                        <div class="product-info best-s text-center">
                                            <div class="product-content">
                                                <a href="#"><h3 class="pro-name">Ejemplo Producto</h3></a>
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
                                                    <span class="normal-price">$140.00</span>
                                                    <span class="old-price"><del>$170.00</del></span>
                                                </div>
                                                <div class="add-to-cartbest">
                                                    <a href="#" title="add to cart">
                                                        <div><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-single-product -->
                                </div>
                                <!--end-double-best-product-->
                            </div>
                        </div>
                        <!--end-best-offer-product-->
                    </div>
                </div>
            </div> --}}
            <!--End-variety-products-wrap-->
            <!--Start-newsletter-wrap-->
            {{-- <div class="news-letter-wrap text-center home-4">
                <div class="container">
                    <div class="row">
                        <div class="news-subscribe">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="letter-text">
                                    <h3><span class="h-color">No</span> se pierda <br> <span><img src="{{asset('assets/themebasic/images/newsletter/1.png')}}" alt=""></span></h3>
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
            </div> --}}
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
        
		<!-- all js here -->
		
    </body>
</html>     