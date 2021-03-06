<div class="featured-product-wrap home-4 padding-t"> 
    <!-- section-heading start -->
    <div class="section-heading">
        <h3><span class="h-color">PRODUCTOS</span> DESTACADOS</h3>
    </div>
    <!-- section-heading end -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="features-tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Cables</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Accesorios de Carro</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Baterias</a></li>
                    <li role="presentation"><a href="#section" aria-controls="messages" role="tab" data-toggle="tab">Convertidor</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--start-home-section-->
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="featured-carousel indicator">
                            @foreach ($tenoNew as $dest1)
                                <!-- Start-single-product -->
                                <div class="col-lg-3">
                                <div class="single-product">
                                    <div class="product-img-wrap"  style="max-height: 300px; min-height:250px;"> 
                                        @if(file_exists("assets/productos/".trim($dest1->idproducto).".jpg"))
                                            <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/{{trim($dest1->idproducto)}}.jpg" alt="product-image" /></a>
                                        @else
                                            
                                            <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                        @endif
                                        {{-- <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a> --}}
                                        <div class="add-to-link"> 
                                            {{-- <a href="#">
                                                <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                            </a> --}}
                                            <a data-toggle="modal" data-target="#productModal" class="vista-modal" data-code="{{trim($dest1->idproducto)}}" href="#">
                                                <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                            </a>
                                            
                                        </div>
                                        <div class="add-to-cart">
                                            <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($dest1->idproducto)}}">
                                                <div><i class="fa fa-shopping-cart "  ></i><span>Añadir</span></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="product-content">
                                            <a href="single/{{trim($dest1->idproducto)}}"><h3 class="pro-name">{{$dest1->descripcion}}</h3></a>
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
                                                @if ($dest1->Graba_Iva == 'S')
                                                ${{round((round($dest1->$precioAc,2)*$parametros->iva) + round($dest1->$precioAc,2),2) . ' IVA incluido'}}
                                                
                                            @else
                                                ${{round($dest1->$precioAc,2)}}
                                            @endif
                                                <!-- </span>
                                                <span class="old-price"><del>${{$dest1->$precioAc}}</del></span> -->
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
                    <!--end-home-section-->
                    <!--start-profile-section-->
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="row">
                            <div class="featured-carousel indicator">
                                    @foreach ($descarNew as $dest1)
                                    <!-- Start-single-product -->
                                    <div class="col-lg-3">
                                        <div class="single-product">
                                            <div class="product-img-wrap"  style="max-height: 300px; min-height:250px;"> 
                                                @if(file_exists("assets/productos/".trim($dest1->idproducto).".jpg"))
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/{{trim($dest1->idproducto)}}.jpg" alt="product-image" /></a>
                                                @else
                                                    
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                @endif
                                                {{-- <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a> --}}
                                                <div class="add-to-link"> 
                                                    {{-- <a href="#">
                                                        <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                                    </a> --}}
                                                    <a data-toggle="modal" data-target="#productModal" class="vista-modal" data-code="{{trim($dest1->idproducto)}}" href="#">
                                                        <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                                    </a>
                                                    
                                                </div>
                                                <div class="add-to-cart">
                                                    <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($dest1->idproducto)}}">
                                                        <div><i class="fa fa-shopping-cart"></i><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info text-center">
                                                <div class="product-content">
                                                    <a href="single/{{trim($dest1->idproducto)}}"><h3 class="pro-name">{{$dest1->descripcion}}</h3></a>
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
                                                            @if ($dest1->Graba_Iva == 'S')
                                                            ${{round((round($dest1->$precioAc,2)*$parametros->iva) + round($dest1->$precioAc,2),2) . ' IVA incluido'}}
                                                                
                                                            @else
                                                                ${{round($dest1->$precioAc,2)}}
                                                            @endif
                                                        </span>
                                                    <!--  <span class="old-price"><del>${{$dest1->$precioAc}}</del></span> -->
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
                    <!--end-profile-section-->
                    <!--start-messages-section-->
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <div class="row">
                            <div class="featured-carousel indicator">
                                    @foreach ($papeNew as $dest1)
                                    <!-- Start-single-product -->
                                    <div class="col-lg-3">
                                        <div class="single-product">
                                            <div class="product-img-wrap"  style="max-height: 300px; min-height:250px;"> 
                                                @if(file_exists("assets/productos/".trim($dest1->idproducto).".jpg"))
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/{{trim($dest1->idproducto)}}.jpg" alt="product-image" /></a>
                                                @else
                                                    
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                @endif
                                                {{-- <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a> --}}
                                                <div class="add-to-link"> 
                                                    {{-- <a href="#">
                                                        <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                                    </a> --}}
                                                    <a data-toggle="modal" data-target="#productModal" class="vista-modal" data-code="{{trim($dest1->idproducto)}}" href="#">
                                                        <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                                    </a>
                                                    
                                                </div>
                                                <div class="add-to-cart">
                                                    <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($dest1->idproducto)}}">
                                                        <div><i class="fa fa-shopping-cart"></i><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info text-center">
                                                <div class="product-content">
                                                    <a href="single/{{trim($dest1->idproducto)}}"><h3 class="pro-name">{{$dest1->descripcion}}</h3></a>
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
                                                            @if ($dest1->Graba_Iva == 'S')
                                                            ${{round((round($dest1->$precioAc,2)*$parametros->iva) + round($dest1->$precioAc,2),2) . ' IVA incluido'}}
                                                
                                                            @else
                                                                ${{round($dest1->$precioAc,2)}}
                                                            @endif
                                                        </span>
                                                        <!-- <span class="old-price"><del>${{$dest1->$precioAc}}</del></span> -->
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
                    <!--end-messages-section-->
                    <!--start-section-section-->
                    <div role="tabpanel" class="tab-pane" id="section">
                        <div class="row">
                            <div class="featured-carousel indicator">
                                    @foreach ($utilNew as $dest1)
                                    <!-- Start-single-product -->
                                    <div class="col-lg-3">
                                        <div class="single-product">
                                            <div class="product-img-wrap" style="max-height: 300px; min-height:250px;"> 
                                                @if(file_exists("assets/productos/".trim($dest1->idproducto).".jpg"))
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/{{trim($dest1->idproducto)}}.jpg" alt="product-image" /></a>
                                                @else
                                                    
                                                    <a class="product-img" href="single/{{trim($dest1->idproducto)}}"> <img src="/assets/productos/SINIMAGEN.jpg" alt="product-image" /></a>
                                                @endif
                                                {{-- <a class="product-img" href="#"> <img src="{{asset('assets/themebasic/images/product/29.jpg')}}" alt="product-image" /></a> --}}
                                                <div class="add-to-link"> 
                                                    {{-- <a href="#">
                                                        <div><i class="fa fa-heart"></i><span>Añadir a Deseos</span></div>
                                                    </a> --}}
                                                    <a data-toggle="modal" data-target="#productModal" class="vista-modal" data-code="{{trim($dest1->idproducto)}}" href="#">
                                                        <div><i class="fa fa-eye"></i><span>Vista Rápida</span></div>
                                                    </a>
                                                    
                                                </div>
                                                <div class="add-to-cart">
                                                    <a href="#" title="add to cart" class="add-carrito" data-id="{{trim($dest1->idproducto)}}">
                                                        <div><i class="fa fa-shopping-cart"></i><span>Añadir</span></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-info text-center">
                                                <div class="product-content">
                                                    <a href="single/{{trim($dest1->idproducto)}}"><h3 class="pro-name">{{$dest1->descripcion}}</h3></a>
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
                                                            @if ($dest1->Graba_Iva == 'S')
                                                ${{round((round($dest1->$precioAc,2)*$parametros->iva) + round($dest1->$precioAc,2),2) . ' IVA incluido'}}
                                                
                                            @else
                                                ${{round($dest1->$precioAc,2)}}
                                            @endif
                                                        </span>
                                                    <!--  <span class="old-price"><del>${{$dest1->$precioAc}}</del></span> -->
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
                    <!--end-section-section-->
                </div>
            </div>				
        </div>
    </div>  
</div>