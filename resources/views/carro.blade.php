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
            <!--Start-Header-area-->
           @include('header')
            <!--End-Header-area-->
            <!--start-single-heading-banner-->
            <div class="single-banner-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="single-ban-top-content">
                                <p>Carrito de Compras</p>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="index.html"><span>Inicio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Carrito de Compras</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- cart-main-area start-->
            <div class="cart-main-area home-4">
                <div class="container carro-table">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>RECUERDA: El monto minimo del pedido debe ser mayor a {{$monto_min}}$.</h4>
                            <form action="#">				
                                <div class="table-content table-responsive">
                                    <table style="border: 2px solid black; border-collapse: collapse;">
                                        <thead>
                                            <tr style="border: 1px solid black; background-color: #EEE; font-size: 17px;">
                                                <th class="product-thumbnail">Imagen</th>
                                                <th class="product-name">Producto</th>
                                                <th class="product-price">Precio</th>
                                                <th class="product-quantity">Cantidad</th>
                                                <th class="product-subtotal">SubTotal</th>
                                                <th class="product-IVA">IVA</th>
                                                <th class="product-remove">Remover</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @if (!is_null(Session::get('carro')))
                                           @foreach (Session::get('carro') as $proCarrito)
                                           <tr>
                                               @if (file_exists("assets/productos/".trim($proCarrito['item']).".jpg"))
                                               <td class="product-thumbnail"><a href="#"><img src="{{asset('assets/productos/'.$proCarrito['item'].'.jpg')}}" alt=""></a></td>
                                               @else
                                               <td class="product-thumbnail"><a href="#"><img src="{{asset('assets/productos/SINIMAGEN.jpg')}}" alt=""></a></td>
                                               @endif
                                               {{-- <td class="product-thumbnail"><a href="#"><img src="images/cart/3.jpg" alt="" /></a></td> --}}
                                               <td class="product-name"><a href="#">{{$proCarrito['nombre']}}</a></td>
                                               <td class="product-price"><span class="amount">${{round($proCarrito['precio'],2)}}</span></td>
                                               <td class="product-quantity"><input type="number" data-id="{{$proCarrito['item']}}" class="input-cantidad" value="{{$proCarrito['cantidad']}}" /></td>
                                               <td class="product-subtotal">${{round(floatval($proCarrito['precio'])*floatval($proCarrito['cantidad']),2)}}</td>
                                               @if ($proCarrito['gr_iva'] == "S")
                                               <td class="product-IVA">${{round((floatval($proCarrito['precio'])*floatval($proCarrito['cantidad']))*0.12,2)}}</td>
                                               @else
                                               <td class="product-IVA">$0</td>
                                               @endif
                                               <td class="product-remove"><a href="#" class="remove-item" data-code="{{$proCarrito['item']}}"><i class="fa fa-times"></i></a></td>
                                           </tr>
                                           @endforeach
                                           @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                                        {{-- <div class="buttons-cart home-4">
                                            <input class="banner-r-b" type="submit" value="Actualizar Carrito" />
                                            <a href="#">Continue al Envío</a>
                                        </div>
                                        <div class="coupon">
											<form data-toggle="validator" role="form">
												<h3>Cupón</h3>
												<p>Ingresa el código del cupón si tienes uno.</p>
												<input type="text" placeholder="Código Cupón" pattern="^[A-z0-9]{1,}$" required />
												<input type="submit" value="Aplicar Cupón" />
											</form>
                                        </div> --}}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                        <div class="cart_totals">
											<form data-toggle="validator" role="form" id="car_checkout">
                                            <h2>Total del Carrito</h2>
                                            <table>
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        @php
                                                        if (!is_null(Session::get('carro'))) {
                                                            $subtotal = 0.0;
                                                            $total = 0.0;
                                                            $iva = 0.0;
                                                            foreach(Session::get('carro') as $itemC){
                                                                $itemSub = round(floatval($itemC['precio'])*floatval($itemC['cantidad']),2); 
                                                                $subtotal += $itemSub;
                                                                if($itemC['gr_iva'] == 'S'){
                                                                    $iva += round((floatval($itemC['precio'])*floatval($itemC['cantidad']))*0.12,2);
                                                                }
                                                            }
                                                        } else {
                                                            $subtotal = 0.0;
                                                            $total = 0.0;
                                                            $iva = 0.0;
                                                        }
                                                        @endphp
                                                    <td><span class="amount">${{$subtotal}}</span></td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>IVA 12%</th>
                                                    <td><span class="amount">${{$iva}}</span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td>
                                                            <strong><span class="amount" id="amount">{{$subtotal+$iva}}</span></strong>
                                                            
                                                        </td>
                                                    </tr>											
                                                </tbody>
                                            </table>
                                            </form>
                                            
                                            </div>
                                                <div class="stay-touch-area touch-textarea continue-butt">
                                                @if (($subtotal+$iva) >= $monto_min)
                                                <a href="{{route('checkout')}}"  type="submit" class="hvr-underline-from-left">CheckOut</a>
                                                
                                                <a href="{{route('checkout')}}" ><input class="hvr-underline-from-left" id="submit-disable" type="submit" value="Proceder al Checkout"></a>
                                                @else
                                                <a href="{{route('checkout')}}"  type="submit" class="hvr-underline-from-left">CheckOut</a>
                                                
                                                <a href="{{route('checkout')}}" ><input class="hvr-underline-from-left" id="submit-disable" DISABLED type="submit" value="Proceder al Checkout"></a>
                                                    
                                                @endif
                                                
                                                
                                            </div>
                                    </div>
                                </div>
                            </form>	
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart-main-area end -->

			
            <!--Start-footer-wrap-->
            @include('footer')
            <!--End-footer-wrap-->
             
        </div>
        <!--End-main-wrapper-->

		<!-- all js here -->
		<!-- jquery latest version -->
        @include('js-end')
        <script>
            $( document ).ready(function() {
                
                
          

            
            $(document).on('click','.remove-item',function(e){
                e.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                var code = $(this).data('code');
                $.ajax({
                    type: "POST",
                    url: "{{route('delete-item')}}",
                    data: {'_token':token,'code':code},
                    dataType: "json",
                    success: function (response) {
                        $("header").load( location.href+(" header"));
                        $(".cart-main-area").load( location.href+(" .cart-main-area"));
                    }
                });

            });

            $(".hvr-underline-from-left").click(function(e){
                e.preventDefault();
                location.href = 'checkout';
            });


            $(document).on('change','.input-cantidad',function(e){
                e.preventDefault();
                var cantidad = $(this).val();
                var item = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "{{route('change-cant')}}",
                    data: {'_token':$('meta[name="csrf-token"]').attr('content'),'code':item,'cantidad':cantidad},
                    dataType: "json",
                    success: function (response) {
                        $("header").load( location.href+(" header"));
                        $(".cart-main-area").load( location.href+(" .cart-main-area"));
                  
                        
                    }
                });
            });
        });
        </script>
    </body>
</html>     