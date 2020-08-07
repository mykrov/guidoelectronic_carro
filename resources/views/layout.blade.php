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
            <!--Start-latest-products-wrap-->
            <div class="latest-products-wrap home-4">
                <div class="container">
                    <div id="publicidad-owl" class="text-center" style="padding-top: 1rem; padding-bottom: 1rem;">
                        <div class="item">
                            <img class="img img-fluid" style="border-radius:1rem;" alt="GuidoEectronic" src="{{asset('assets/themebasic/images/banner/publi.jpg')}}" />
                        </div>
                        <div class="item">
                            <img class="img img-fluid" style="border-radius:1rem;" alt="GuidoEectronic" src="{{asset('assets/themebasic/images/banner/publi2.jpg')}}"/>
                        </div>
                        <div class="item">
                            <img class="img img-fluid" style="border-radius:1rem;" alt="GuidoEectronic" src="{{asset('assets/themebasic/images/banner/tarjetas.jpg')}}"/>
                        </div>
                    </div>
                    <div class="row">
				        <!--start-categry-area-->
                        <div class="col-lg-3 col-md-3">
                            <div class="category-main-wrap home-4 hidden-sm hidden-xs">
                                <div class="category-title">
                                    <h3>Categorias</h3>
                                </div>
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @include('banners') 
                        <div class="col-lg-9 col-md-9 padding-t">
                            <div class="latest-content text-center">
                                <div class="section-heading">
                                    <h3 class="animate__animated animate__bounce" ><span class="h-color">Productos</span> Nuevos</h3>
                                </div>
                            </div>
                            {{-- aqui esta el problema --}}
                            <div class="featured-carousel2 indicator"> 
                                @foreach ($proNuevos as $itemNuevo)
                                    <!-- Start-single-product -->
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="single-product">
                                             <div class="product-img-wrap"> 
                                                @if(file_exists("assets/productos/".trim($itemNuevo->idproducto).".jpg"))
                                                    <a class="product-img" href="single/{{trim($itemNuevo->idproducto)}}"> <img src="/assets/productos/{{trim($itemNuevo->idproducto)}}.jpg" alt="product-image" /></a>
                                                @else
                                                    
                                                    <a class="product-img" href="single/{{trim($itemNuevo->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                @endif
                                                <div class="add-to-link"> 
                                                    <a data-toggle="modal" data-code="{{trim($itemNuevo->idproducto)}}" class="vista-modal" data-target="#productModal" href="#">
                                                        <div>
                                                            <i class="fa fa-eye"></i><span>Vista Rápida</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($itemNuevo->idproducto)}}">
                                                        <div>
                                                            <i class="fa fa-shopping-cart"></i><span>Añadir</span>
                                                        </div>
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
                            {{-- aqui termina el problema --}}
                            @include('destacados')
                            <div class="row">
                                <div class="">
                                    <div class="section-heading">
                                        <p style="font-size: 50px;" class="my-element" ><span class="h-color">Promociones</span></p>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner banner-r-b">
                                            <a href="#"><img class="img-fluid" alt="electronica" src="{{asset('assets/productos/promocion/camara8final.jpg') }}" style=" height: auto;" /></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="electronica" src="{{asset('assets/productos/promocion/camarafinal.jpg') }}" style=" height: auto;" /></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12" style="padding-top: 2rem">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="electronica" src="{{asset('assets/productos/promocion/soporte.jpg') }}"  style=" height: auto;"/></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="single-banner">
                                            <a href="#"><img class="img-fluid" alt="electronica" src="{{asset('assets/productos/promocion/sonido.jpg') }}"  style=" height: auto;"/></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End-latest-products-wrap-->
            <div class="banner-area padding-t home-4 banner-dis">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-banner banner-r-b">
                                <a href="#"><img alt="GuidoElectronic" style="width:90%" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL'])}}" /></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="single-banner">
                                <a href="#"><img alt="GuidoElectronic" style="width:90%" src="{{asset('assets/themebasic/images/banner/'.$imagen['bannerL2'])}}" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <!--End-banner-area-->
            <div class="clear">
            </div>
            @include('footer')
            
            @include('modal')
            @include('js-end')
            @if (session('compraResult') != '')
                <script>
                    swal("Pedido Registrado con Exito","{{ session('compraResult') }}", "success");
                </script> 
            @endif
            
            @if(session('message') != '')
                @include('message')
            @endif
        </div> 

        <script>
            $(document).ready(function(){
                var owl1 = $('#publicidad-owl');
                owl1.owlCarousel({
                    autoPlay: true, 
                    slideSpeed:2000,
                    items : 1,
                    pagination:false,
                    navigation:false,
                    stopOnHover: true,
                    navigationText:["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
                    itemsDesktop : [1199,1],
                    itemsDesktopSmall : [980,1],
                    itemsTablet : [767,1],
                    itemsMobile : [479,1]                  
                });
            });  
        </script>
        <!--END Start-main-wrapper-->
    </body>
</html>     