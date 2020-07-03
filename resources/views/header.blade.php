
<!--Start-Header-area-->
<header>
    <script>var iva_global = {{ $parametros->iva }};</script>
    <div class="header-top-wrap home-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="header-top-left">
                        <!--Start-Header-language-->
                        <div class="dropdown top-language-wrap"> <a role="button" data-toggle="dropdown" data-target="#" class="top-language dropdown-toggle" href="#"> <img src="{{asset('assets/themebasic/images/flag/es.png')}}" alt="language"> Español <span class="caret"></span> </a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a role="menuitem" href="#"><img src="{{asset('assets/themebasic/images/flag/es.png')}}" alt="language"> Español </a></li>
                                {{-- <li role="presentation"><a role="menuitem" href="#"><img src="{{asset('assets/themebasic/images/flag/e.png')}}" alt="language"> English </a></li> --}}
                            </ul>
                        </div>
                        <!--End-Header-language-->
                        <!--Start-Header-currency-->
                        <div class="dropdown top-currency-wrap"> <a role="button" data-toggle="dropdown" data-target="#" class="top-currency dropdown-toggle" href="#"><span class="usd-icon"><i class="fa fa-usd"></i></span> USD <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a role="menuitem" href="#"> $ - Dolar Americano</a></li>
                                {{-- <li role="presentation"><a role="menuitem" href="#"> € - Euro </a></li> --}}
                            </ul>
                        </div>
                        <!--End-Header-currency-->
                        <!--Start-welcome-message-->
                        <div class="welcome-mg hidden-xs"><span>Bienvenidos!</span></div>
                        <!--End-welcome-message--> 
                    </div>
                </div>
                <!-- Start-Header-links -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="header-top-right">
                        <div class="top-link-wrap">
                            <div class="single-link">
                                @if (Session::get('usuario-nombre') == '' or null)
                                
                                @else
                                <div class="my-account"><a href="{{route('cuenta')}}"><span class="">{{Session::get('usuario-nombre')}}</span></a></div>    
                                @endif
                                {{-- <div class="wishlist"><a href="wishlist.html"><span class="">Deseos</span></a></div> --}}
                                <div class="check"><a href="{{route('checkout')}}"><span class="">Revisión Final</span></a></div>
                                @if (Session::get('usuario-nombre') == '' or null)
                                <div class="login"><a href="{{route('login')}}"><span  class="">Iniciar Sesión</span></a></div>
                                @else
                                <div class="login"><a href="{{route('logout')}}"><span  class="">Cerrar Sesión</span></a></div>    
                                @endif

                            </div>
                        </div>
                        
                    </div>

                </div>
                    <!-- End-Header-links -->
            </div>
        </div>
    </div>
    <!--Start-header-mid-area-->
    <div class="header-mid-wrap home-4">
        <div class="container">
            <div class="header-mid-content">
                <div class="row">
                    <!--Start-logo-area-->
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="header-logo">
                            {{-- @php
                             $imgweb = array();
                            @endphp
                            @foreach ($imagen as $item)
                                @php
                                    $imgweb[$item->nombre_seccion] = $item->nombre;
                                @endphp
                            @endforeach --}}
                            <a href="{{route('index')}}"><img src="{{asset('assets/themebasic/images/logo/'.$imagen['logo1'])}}" alt="Mt-Shop" style="max-height:80px;"></a>
                           
                        </div>
                    </div>
                    <!--End-logo-area-->
                    <!--Start-gategory-searchbox-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div id="search-category-wrap">
                            <form class="header-search-box" action="/search" method="POST">
                                <div class="search-cat">
                                    {{ csrf_field() }}
                                    <select class="category-items" name="category">
                                        <option value="TODAS">Todas</option>
                                        @foreach ($cates as $cate)
                                            <option value="{{ trim($cate->idcategoria)}}">{{$cate->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="search" placeholder="Buscar aquí..." id="text-search" name="text">
                                <button id="btn-search-category" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--End-gategory-searchbox-->
                    <!--Start-cart-wrap-->    
                
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
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="carro-div">
                        <ul class="header-cart-wrap">
                            <li>
                                @if (Session::has('carro'))
                                    <a class="cart" href="#">{{count(Session::get('carro'))}} Items</a>
                                    <div class="mini-cart-content">
                                        @php
                                            $subtotal = 0.0
                                        @endphp
                                        <div class="cart-products-list scrollOn">
                                            @foreach (Session::get('carro') as $proCarrito)
                                            <div class="sing-cart-pro">
                                                <div class="cart-image">
                                                    @if (file_exists("assets/productos/".trim($proCarrito['item']).".jpg"))
                                                    <a href="#"><img src="{{asset('assets/productos/'.$proCarrito['item'].'.jpg')}}" alt=""></a>
                                                    @else
                                                    <a href="#"><img src="{{asset('assets/productos/SINIMAGEN.jpg')}}" alt=""></a>  
                                                    @endif
                                                    
                                                </div>
                                                <div class="cart-product-info">
                                                    <a href="#" class="product-name">{{$proCarrito['nombre']}} </a>
                                                    <div class="cart-price">
                                                        <span class="quantity"><strong> {{$proCarrito['cantidad']}}</strong></span>
                                                        @if ($proCarrito['gr_iva'] == 'S')
                                                            <span class="p-price">x ${{round(round($proCarrito['precio'],2)*$parametros->iva + round($proCarrito['precio'],2),2) }}</span>
                                                        @else
                                                            <span class="p-price">x ${{round($proCarrito['precio'],2)}}</span>
                                                        @endif
                                                        
                                                    </div>
                                                    <a class="edit-pro" title="edit"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a class="remove-pro" data-code={{$proCarrito['item']}} title="remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            @php
                                                if ($proCarrito['gr_iva'] == 'S') {
                                                    $subtotal += floatval($proCarrito["precio"] * $parametros->iva + round($proCarrito['precio'],2));
                                                } else {
                                                    $subtotal += floatval($proCarrito["precio"]);
                                                }
                                                
                                                
                                            @endphp
                                            
                                            @endforeach
                                        </div>
                                        <div class="cart-price-list">
                                            <p class="price-amount">
                                                <span class="cart-subtotal">Total :</span><span>${{round($subtotal,2)}}</span>
                                            </p>
                                            <div class="cart-checkout">
                                                <a class="vaciar-carro" href="javascript:void(0)">Vaciar Carro</a>
                                            </div>
                                            <div class="view-cart">
                                            <a href="{{route('carro')}}">Ver Orden</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @else
                                    <a class="cart" href="#">0 items</a>
                                    
                                @endif
                            </li>
                        </ul>
                    </div>
                    <!--End-cart-wrap-->
                </div>
            </div>    
        </div>
    </div>
    
    <!--End-header-mid-area-->
    <!--Start-Mainmenu-area -->
    <div class="mainmenu-area home-4 hidden-sm hidden-xs">
        <div id="sticker"> 
            <div class="container">
                <div class="row">   
                    <div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
                    <div class="log-small"><a class="logo" href="{{route('index')}}"><img alt="Mt-Shop" src="{{asset('assets/themebasic/images/logo/'.$imagen['logo2_nav'])}}"></a></div>
                        <div class="mainmenu home-4">
                            <nav>
                                <ul id="nav">
                                    <li ><a href="{{route('index')}}">Inicio</a>
                                    </li>
                                    <li><a href="{{route('nosotros')}}">Quienes Somos</a></li>
                                    <li><a href="{{route('cuenta')}}">Mi Cuenta</a></li>
                                    <li class="angle-down"><a href="#">Categorias</a>
                                        <ul class="sub-menu">
                                                @foreach ($cates as $cate)
                                                    <li class="licat" style=" width: 20%;float: left;list-style: none;"><a class="{{$cate->idcategoria}}" href="{{route('categoria-search',trim($cate->idcategoria))}}">{{$cate->nombre}}</a></li>
                                                @endforeach
                                        </ul>
                                    </li>
                                    {{-- <li><a href="wishlist.html">Mis Deseos</a></li> --}}
                                    <li><a href="{{route('guiacompra')}}">Como Comprar</a></li>
                                    <li><a href="{{route('politicas')}}">Politicas</a></li>
                                    <li><a href="{{route('tarifas')}}">Tarifas</a></li>
                                    <li><a href="{{route('contacto')}}">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>        
                    </div>
                </div>
            </div>
        </div>      
    </div>
    <!--End-Mainmenu-area-->
    <!--Start-Mobile-Menu-Area -->
    <div class="mobile-menu-area visible-sm visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul>
                                <li ><a href="{{route('index')}}">Inicio</a>
                                </li>
                                <li><a href="{{route('nosotros')}}">Quienes Somos</a></li>
                                <li><a href="{{route('cuenta')}}">Mi Cuenta</a></li>
                                <li><a href="#">Categorias</a>
                                    <ul>
                                        @foreach ($cates as $cate)
                                            <li><a class="{{$cate->idcategoria}}" href="{{route('categoria-search',$cate->idcategoria)}}">{{$cate->nombre}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- <li><a href="wishlist.html">Mis Deseos</a></li> --}}
                                <li><a href="{{route('guiacompra')}}">Como Comprar</a></li>
                                <li><a href="{{route('politicas')}}">Politicas</a></li>
                                <li><a href="{{route('tarifas')}}">Tarifas</a></li>
                                <li><a href="{{route('contacto')}}">Contacto</a></li>
                            </ul>
                        </nav>
                    </div>					
                </div>
            </div>
        </div>
    </div>
    <!--End-Mobile-Menu-Area -->
</header>
<!--End-Header-area-->