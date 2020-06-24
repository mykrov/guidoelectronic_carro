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
                                <p>{{$producto->descripcion}}</p>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!--start-shop-head -->
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="index.html"><span>Inicio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">{{$producto->descripcion}}</li>
                                </ul>
                            </div>
                            <!--end-shop-head-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!--start-signle-page-->
            <div class="single-page-area home-4 padding-t">
                <!-- Single Product details Area -->
                <div class="single-product-details-area">
                    <!-- Single Product View Area -->
                    <div class="single-product-view-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                    <!-- Single Product View -->
                                    <div class="single-procuct-view">
                                        <!-- Simple Lence Gallery Container -->
                                        <div class="simpleLens-gallery-container" id="p-view">
                                            <div class="simpleLens-container tab-content">
                                                <div class="tab-pane active" id="p-view-1">
                                                    <div class="simpleLens-big-image-container">
                                                        
                                                            @if(file_exists("assets/productos/".trim($producto->idproducto).".jpg"))
                                                            <a class="simpleLens-lens-image" data-lens-image="/assets/productos/{{trim($producto->idproducto)}}.jpg">
                                                                <img src="/assets/productos/{{trim($producto->idproducto)}}.jpg"  class="simpleLens-big-image" alt="product">
                                                            </a>
                                                            @else
                                                            <a class="simpleLens-lens-image" data-lens-image="images/single-p/b1.jpg">
                                                                <img src="/assets/productos/SINIMAGEN.jpg"  class="simpleLens-big-image" alt="product">
                                                            </a>
                                                            @endif
                                                        
                                                    </div>
                                                </div>
                                                {{-- <div class="tab-pane" id="p-view-2">
                                                    <div class="simpleLens-big-image-container">
                                                        <a class="simpleLens-lens-image" data-lens-image="images/single-p/b2.jpg">
                                                            <img src="images/single-p/m2.jpg" class="simpleLens-big-image" alt="product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="p-view-3">
                                                    <div class="simpleLens-big-image-container">
                                                        <a class="simpleLens-lens-image" data-lens-image="images/single-p/b3.jpg">
                                                            <img src="images/single-p/m3.jpg" class="simpleLens-big-image" alt="product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="p-view-4">
                                                    <div class="simpleLens-big-image-container">
                                                        <a class="simpleLens-lens-image" data-lens-image="images/single-p/b4.jpg" >
                                                            <img src="images/single-p/m4.jpg" class="simpleLens-big-image" alt="product">
                                                        </a>
                                                    </div>
                                                </div> --}}
                                                <div class="tab-pane" id="p-view-5">
                                                    <div class="simpleLens-big-image-container">
                                                        <a class="simpleLens-lens-image" data-lens-image="images/single-p/b5.jpg" >
                                                            
                                                            <img src="images/single-p/m5.jpg" class="simpleLens-big-image" alt="product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="p-view-6">
                                                    <div class="simpleLens-big-image-container">
                                                        <a class="simpleLens-lens-image" data-lens-image="images/single-p/b6.jpg">
                                                            <img src="images/single-p/m6.jpg" class="simpleLens-big-image" alt="product">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Simple Lence Thumbnail -->
                                            {{-- <div class="simpleLens-thumbnails-container text-center">
                                                <div id="single-product" class="owl-carousel custom-carousel">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="active"><a href="#p-view-1" role="tab" data-toggle="tab"><img src="assets/images/producto/{{trim($producto->idproducto)}}.jpg" alt="productd"></a></li>
                                                        <li class="last-li"><a href="#p-view-2" role="tab" data-toggle="tab"><img src="images/single-p/s2.jpg" alt="productd"></a></li>
                                                        <li class="hidden-md hidden-xs hidden-sm"><a href="#p-view-3" role="tab" data-toggle="tab"><img src="images/single-p/s3.jpg" alt="productd"></a></li>
                                                    </ul>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class=""><a href="#p-view-4" role="tab" data-toggle="tab"><img src="images/single-p/s4.jpg" alt="productd"></a></li>
                                                        <li class="last-li"><a href="#p-view-5" role="tab" data-toggle="tab"><img src="images/single-p/s5.jpg" alt="productd"></a></li>
                                                        <li class="hidden-md hidden-xs hidden-sm"><a href="#p-view-6" role="tab" data-toggle="tab"><img src="images/single-p/s6.jpg" alt="productd"></a></li>
                                                    </ul>
                                                </div>
                                            </div> --}}
                                            <!-- End Simple Lence Thumbnail -->
                                        </div>
                                        <!-- End Simple Lence Gallery Container -->
                                    </div>
                                    <!-- End Single Product View -->
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 single-product-details">
                                    <div class="single-pro">
                                        <div class="product-name">
                                            <h3><a href="">Codigo de Producto: {{$producto->idproducto}}</a></h3>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-content">
                                     <!--        <div class="pro-rating single-p">
                                                <ul class="single-pro-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li class="r-grey"><i class="fa fa-star"></i></li>
                                                    <li class="r-grey"><i class="fa fa-star-half-o"></i></li>
                                                </ul>
                                                <div class="rating-links">
                                                    <a href="#">1 Comentario(s)</a>
                                                    <span class="separator">|</span>
                                                    <a href="#" class="add-to-review">Añadir comentario</a>
                                                </div>
                                            </div><br> -->
                                            <div class="pro-price single-p">
                                                <span class="price-text">Precio:</span>
                                                <span class="normal-price">
                                                    @if ($producto->Graba_Iva == 'S')
                                                        ${{round((round($producto->$precioAc,2)*$parametros->iva) + round($producto->$precioAc,2),2) . ' IVA incluido'}}
                                                        
                                                    @else
                                                        ${{round($producto->$precioAc,2)}}
                                                    @endif 
                                                </span>
                                            </div>
                                        </div>
                                        <p>Disponibilidad: <span class="signle-stock">En stock</span></p>
                                        <div class="product-reveiw">
                                            <h5>{{$producto->descripcion}}</h5>
                                        </div>
										{{-- <div>
											<h4>Colores</h4>
											<table class="table-color-select" >
											<tr>
												<td bgcolor="yellow" width="40px" height="40px"></td>
												<td bgcolor="blue" width="40px" height="40px"></td>
												<td bgcolor="red" width="40px" height="40px"></td>
												<td bgcolor="black" width="40px" height="40px"></td>
												<td bgcolor="green" width="40px" height="40px"></td>
											</tr>
											</table>
										</div> --}}
										<br>
                                        <div class="">
                                            <div class="quick-add-to-cart">
                                                <form method="post" class="cart">
                                                    <div class="qty-button"> 	
                                                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">

                                                        <div class="box-icon button-plus"> 
                                                            <input type="button" class="qty-increase " onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+">
                                                        </div>	
                                                        <div class="box-icon button-minus">
                                                            <input type="button" class="qty-decrease" onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) qty_el.value--;return false;" value="-">
                                                        </div>
                                                    </div>
													<div class="add-to-cartbest single-add2">
                                                    <a href="#" data-code="{{trim($producto->idproducto)}}" class="add-2" title="add to cart">
															<div><span>Añadir</span></div>
														</a>
													</div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- <div class="single-pro-cart">
                                            <div class="add-to-link single-p"> 
                                                <a href="#" title="Añadir a Deseos">
                                                    <div><i class="fa fa-heart"></i></div>
                                                </a>
                                                <a href="#" title="Email">
                                                    <div><i class="fa fa-envelope"></i></div>
                                                </a>
                                                <a href="#" title="Comparar">
                                                    <div><i class="fa fa-random"></i></div>
                                                </a>
                                            </div>
                                        </div> --}}
                                        <div class="clear"></div>
                                        <!-- social-markting end -->
                                        <div class="social-icon-img">
                                            <a href="#">
                                                <img src="images/icon/s.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product View Area -->
                </div>
                        <!-- End Single details Area -->
            </div>
            <!--End-signle-page-->
            <!-- Single Description Tab -->
			<div class="single-product-description">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="product-description-tab custom-tab">
								<!-- tab bar -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#product-des" data-toggle="tab">Descripción del Producto</a></li>
									{{-- <li><a href="#product-rev" data-toggle="tab">Comentarios</a></li> --}}
								</ul>
								<!-- Tab Content -->
								<div class="tab-content">
									<div class="tab-pane active" id="product-des">
										<p>{{$producto->descripcion}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Single Description Tab -->
            <!-- Start-featured-area-->
            {{-- @include('destacados') --}}
            <!--End-featured-area-->

             
			<br>
            <!--Start-newsletter-wrap-->
<!--             <div class="news-letter-wrap text-center home-4">
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
            </div> -->
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
		<!-- jquery latest version -->
        @include('js-end')
        <script>
        $(document).on('click','.add-2',function(e){
            e.preventDefault();
            var producto = $(this).data('code');
            var cantidad = $("#qty").val();
            var token = $('meta[name="csrf-token"]').attr('content');
           
            $.ajax({
                type: "POST",
                url: "/carro-add",
                data: {'_token': token,'code':producto,'cantidad':cantidad},
                dataType: 'json',
                success: function (data) {
                    console.log(location.href);
                    $("header").load( location.href+(" header"));
                }
            });

        });
        </script>
    </body>
</html>     