<!doctype html>
<html class="no-js" lang="en">
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
                                <p>Listado de Productos</p>
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
                                    <li class="shop-pro">Listado de Productos</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!--start-shop-product-area-->
            <div class="shop-product-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <!-- Left-Sidebar-start-->
                            <div class="left-sidebar-title" style="color:#FFF; background-color:black">
                                <h2>Busqueda: {{$buscado}}</h2>
                            </div>
                            <!-- Shop-Layout-start -->
                            {{-- <div class="left-sidebar">
                                <div class="shop-layout">
                                    <div class="layout-title">
                                        <h2>Sub-Categoria</h2>
                                    </div>
                                    <div class="layout-list">
                                        <ul>
                                            <li><a href="#">Discos Duros</a><span>(9)</span></li>
                                            <li><a href="#">Teclados</a><span>(8)</span></li>
                                            <li><a href="#">Mouses</a><span>(10)</span></li>
                                            <li><a href="#">Memoria Ram</a><span>(12)</span></li>
                                            <li><a href="#">Pen Drive</a><span>(15)</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Shop-Layout-end -->
                                <!-- Precio-Filter-start -->
                                <div class="price-filter-area shop-layout">
                                    <div class="price-filter">
                                        <div class="layout-title">
                                            <h2>Precio</h2>
                                        </div>
                                        <p> 
                                          <label class="range-text">Rango:</label>
                                          <input type="text" style="border:0; color:#f6931f; font-weight:bold;" readonly="" id="amount">
                                        </p>
                                        <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span></div>
                                        <button class="btn btn-default">Buscar</button>
                                    </div>
                                </div>
                                <!-- Precio-Filter-end -->
                                <!-- Shop-Layout-start -->
                                <div class="shop-layout">
                                    <div class="layout-title">
                                        <h2>Marca</h2>
                                    </div>
                                    <div class="layout-list">
                                        <ul>
                                            <li><a href="#">Hitachi</a><span>(2)</span></li>
                                            <li><a href="#">Toshiba</a><span>(2)</span></li>
                                            <li><a href="#">Sony</a><span>(1)</span></li>
                                            <li><a href="#">LG</a><span>(2)</span></li>
                                            <li><a href="#">Samsung</a><span>(3)</span></li>
                                            <li><a href="#">HTC</a><span>(4)</span></li>
                                            <li><a href="#">Kingstom</a><span>(2)</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Shop-Layout-end -->
                                <!-- Shop-Layout-start -->
                                <div class="shop-layout">
                                    <div class="layout-title">
                                        <h2>Color</h2>
                                    </div>
                                    <div class="layout-list">
                                        <ul>
                                            <li><a href="#">Negro</a><span>(1)</span></li>
                                            <li><a href="#">Azul</a><span>(2)</span></li>
                                            <li><a href="#">cafe</a><span>(3)</span></li>
                                            <li><a href="#">Rosado</a><span>(3)</span></li>
                                            <li><a href="#">Rojo</a><span>(2)</span></li>
                                            <li><a href="#">Blanco</a><span>(2)</span></li>
                                            <li><a href="#">Amarillo</a><span>(3)</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Shop-Layout-end -->
                            </div>
                            <!-- End-Left-Sidebar -->
                            <!-- Shop-compare-start -->
                            <div class="shop-banner-area">
                                <div class="left-sidebar-title">
                                    <h2 class="compare-title contact">Comparar Productos</h2>
                                </div>
                                <div class="layout-list compare">
                                    <ul>
                                        <li><a href="#">Disco Duro 1TB - Hitachi</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                        <li><a href="#">Disco Duro 1TB - Toshiba</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                        <li><a href="#">Disco Duro 1TB - HDBlue</a><span class="compare-icon"><i class="fa fa-trash"></i></span></li>
                                    </ul>
                                    <div class="compare-action">
                                        <div class="clear-button">
                                            <a href="#">Limpiar Todo</a>
                                        </div>
                                        <div class="product-cart compare">
                                            <button class="button">Comparar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Shop-compare-end -->
                            <!-- Shop-Layout-Banner-start -->
                            <div class="shop-banner-area banner-r-b">
                                <div class="single-banner">
                                    <div class="single-banner">
                                        <a href="#"><img alt="Hola" src="{{asset('/assets/themebasic/images/banner/18.jpg')}}" /></a>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- Shop-Layout-Banner-end -->
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                            <!-- Shop-Product-View-start -->
                            <div class="shop-product-view">
                                <!-- Shop Product Tab Area -->
                                <div class="product-tab-area">
                                    <!-- Tab Bar -->
                                    <div class="tab-bar">
                                        <div class="tab-bar-inner">
                                            <ul role="tablist" class="nav nav-tabs">
                                                <li class="active"><a title="Grid" data-toggle="tab" href="#shop-product"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Cuadricula</span></a></li>
                                                <li><a  title="List" data-toggle="tab" href="#shop-list"><i class="fa fa-list"></i><span class="list">Listado</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="toolbar">
                                            {{-- <div class="sorter">
                                                <div class="sort-by">
                                                    <label class="sort-none">Ordenar por</label>
                                                    <select>
                                                        <option value="position">Ranking</option>
                                                        <option value="name">Nombre</option>
                                                        <option value="price">Precio</option>
                                                    </select>
                                                    <a class="up-arrow" href="#"><i class="fa fa-long-arrow-up"></i></a>
                                                </div>
                                            </div> --}}
                                            <div class="pager-list">
                                                    <h4 class="text-center">Resultados: {{$productosLike->total()}}</h4>

                                                {{-- <div class="limiter">
                                                    <label>Mostrar</label>
                                                    <select>
                                                        <option value="9">9</option>
                                                        <option value="12">12</option>
                                                        <option value="24">24</option>
                                                        <option value="36">36</option>
                                                    </select>
                                                    por página
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End-Tab-Bar -->
                                    <!-- Tab-Content -->
                                    <div class="tab-content home-4">
                                        <!-- Shop Product-->
                                        <div id="shop-product" class="tab-pane active">
                                            <div class="row">
                                                @foreach ($productosLike as $item)
                                                       <!-- Start-single-product -->
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="single-product shop-mar-bottom">
                                                        {{-- <div class="sale">-5%</div> --}}
                                                        <div class="sale-border"></div>
                                                            <div class="product-img-wrap" style="max-height: 300px; min-height:300px;"> 
                                                                @if(file_exists("assets/productos/".trim($item->idproducto).".jpg"))
                                                                    <a class="product-img img-responsive" style="max-height: 200px; min-height:200px;" href="{{route('single-product',trim($item->idproducto))}}"> <img src="/assets/productos/{{trim($item->idproducto)}}.jpg" alt="product-image" /></a>
                                                                @else
                                                                    
                                                                    <a class="product-img img-responsive" style="max-height: 200px, min-height:200px;" href="{{route('single-product',trim($item->idproducto))}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                                @endif
                                                                
                                                                <div class="add-to-link"> 
                                                                    {{-- <a href="#">
                                                                        <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                                                    </a> --}}
                                                                    <a data-toggle="modal" data-code="{{trim($item->idproducto)}}" class="vista-modal" data-target="#productModal" href="#">
                                                                        <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                                                    </a>
                                                                    {{-- <a href="#">
                                                                        <div><i class="fa fa-random"></i><span>Comparar</span></div>
                                                                    </a> --}}
                                                                </div>
                                                                <div class="add-to-cart">
                                                                    <a href="#" class="add-carrito" data-id='{{trim($item->idproducto)}}' title="add to cart">
                                                                        <div><i class="fa fa-shopping-cart"></i><span>Añadir</span></div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="product-info text-center">
                                                                <div class="product-content">
                                                                    <a href="#"><h4 class="pro-name">{{str_limit($item->descripcion, 20)}}</h4></a>
                                                                    <div class="pro-rating">
                                                                        @if ($item->Graba_Iva == 'S')
                                                                            IVA Incluido
                                                                        @else
                                                                            Producto sin IVA
                                                                        @endif 
                                                                    </div>
                                                                    <div class="pro-price">
                                                                        <span class="price-text">Precio:</span>
                                                                        <span class="normal-price">
                                                                            @if ($item->Graba_Iva == 'S')
                                                                                ${{round(($item->$precioAc*$parametros->iva)+$item->$precioAc,2)}}
                                                                            @else
                                                                                ${{round($item->$precioAc,2)}}
                                                                            @endif 
                                                                        </span>
                                                                       <!--  <span class="old-price"><del>${{round($item->$precioAc*0.3+$item->$precioAc,2)}}</del></span> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End-single-product -->
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- End-Shop-Product-->
                                        <!-- Shop List -->
                                        <div id="shop-list" class="tab-pane">
                                            @foreach ($productosLike as $item2)
                                                <!-- start-Single-Shop-list-->
                                            <div class="single-shop">
                                                    <div class="row">
                                                        <!-- single-product-start -->
                                                        <div class="single-product">
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <div class="product-img-wrap"> 
                                                                    @if(file_exists("assets/productos/".trim($item2->idproducto).".jpg"))
                                                                        <a class="product-img img-responsive" style="max-height: 280px; min-height:280px;" href="{{route('single-product',trim($item2->idproducto))}}"> <img src="/assets/productos/{{trim($item2->idproducto)}}.jpg" alt="product-image" /></a>
                                                                    @else
                                                                        <a class="product-img img-responsive" style="max-height: 280px, min-height:280px;" href="{{route('single-product',trim($item2->idproducto))}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                                    @endif
                                                                    {{-- <a class="product-img" href="#"> <img src="images/product/14.jpg" alt="product-image" /></a> --}}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                <div class="product-info text-left">
                                                                    <div class="product-content shop">
                                                                        <a href="#"><h3 class="pro-name">{{$item2->descripcion}}</h3></a>
                                                                        <div class="pro-rating">
                                                                            @if ($item2->Graba_Iva == 'S')
                                                                                <p>IVA INCLUIDO</p>
                                                                            @else
                                                                                <p>Producto sin IVA</p>
                                                                            @endif 
                                                                        </div>
                                                                        <div class="pro-price">
                                                                            <span class="price-text">Precio:</span>
                                                                            <span class="normal-price">
                                                                            @if ($item2->Graba_Iva == 'S')
                                                                                ${{round(($item2->$precioAc*$parametros->iva)+$item2->$precioAc,2)}}
                                                                            @else
                                                                                ${{round($item2->$precioAc,2)}}
                                                                            @endif 
                                                                            {{-- ${{round($item2->$precioAc,2)}} --}}
                                                                        </span>
                                                                        <!-- <span class="old-price"><del>${{round($item2->$precioAc,2)}}</del></span> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="shop-article text-left">
                                                                <h3>Codigo del Producto: {{$item2->idproducto}}</h3>
                                                                </div>
                                                                <div class="shop-button-area">
                                                                    <div class="add-to-cartbest shop">
                                                                        <a href="#" class='add-carrito' title="add to cart">
                                                                            <div><span>Añadir</span></div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="add-to-link shop"> 
                                                                    <a href="#">
                                                                        <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                                                    </a>
                                                                    <a href="#">
                                                                        <div><i class="fa fa-random"></i><span>Comparar</span></div>
                                                                    </a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <!-- single-product-end -->
                                                    </div>
                                                </div>
                                                <!-- end-Single-Shop-list-->
                                            @endforeach
                                            
                                        </div>
                                        <!-- End Shop List -->
                                    </div>
                                    <!-- End Tab Content -->
                                    <!-- Tab Bar -->
                                    <div class="tab-bar tab-bar-bottom">
                                        <div class="tab-bar-inner">
                                            <ul role="tablist" class="nav nav-tabs">
                                                <li class="active"><a title="Grid" data-toggle="tab" href="#shop"><i class="fa fa-th-large"></i><span class="grid" title="Grid">Cuadricula</span></a></li>
                                                <li><a title="List" data-toggle="tab" href="#shop-list"><i class="fa fa-list"></i><span class="list">Listado</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="toolbar">
                                            <div class="sorter">
                                                <div class="sort-by">
                                                    <label class="sort-none">Ordenar por</label>
                                                    <select>
                                                        <option value="position">Ranking</option>
                                                        <option value="name">Nombre</option>
                                                        <option value="price">Precio</option>
                                                    </select>
                                                    <a class="up-arrow" href="#"><i class="fa fa-long-arrow-up"></i></a>
                                                </div>
                                            </div>
                                            <div class="pages">
                                                <div>
                                                    {!! $productosLike->render()!!}
                                                </div>
                                                
                                                {{-- <strong>Página:</strong>
                                                <ol>
                                                    <li class="current">1</li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#" title="Next"><i class="fa fa-arrow-right"></i></a></li>
                                                </ol> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Tab Bar -->
                                </div>
                                <!-- End Shop Product Tab Area -->
                            </div>
                            <!-- End Shop Product View -->
                        </div>
                    </div>
                </div>
            </div>
            <!--shop-product-area-end--> 
			<br>
            <!--Start-newsletter-wrap-->
            <div class="news-letter-wrap text-center home-4">
                <div class="container">
                    <div class="row">
                        <div class="news-subscribe">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="letter-text">
                                    <h3><span class="h-color">No</span> se pierda <br> <span><img src="{{asset('/assets/themebasic/images/newsletter/1.png')}}" alt=""></span></h3>
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
        <!-- Quickview-product-strat -->
        @include('modal')
        <!-- End quickview product -->
		<!-- all js here -->
		@include('js-end')
    </body>
</html>
        