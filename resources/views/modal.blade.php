<div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <!-- modal-content-start-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- product-images -->
                            
                            <div class="product-images">
                                <div class="main-image images">
                                    <img id="modal-imagen" alt="" src="{{asset('assets/themebasic/images/product/')}}">
                                </div>
                            </div>
                            
                            <!-- product-images -->
                            <!-- product-info -->
                            <div class="product-info">
                                <h1 id="modal-nombre"></h1>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span id="modal-precio" class="normal-price"></span>
                                    </div>
                                </div>
                                {{-- <a href="shop-grid.html" class="see-all">Mirar todas las caracteristicas</a> --}}
                                <div class="quick-add-to-cart">
                                   
                                </div>
                                <div  class="quick-desc">
                                    <h1>Codigo deProducto:</h1>
                                    <h2 id="modal-codigo"></h2> 
                                </div>
                                <div class="social-sharing">
                                   
                                </div>
                            </div>
                            <!-- product-info -->
                        </div>
                        <!-- modal-product -->
                    </div>
                    <!-- modal-body -->
                </div>
                <!-- modal-content -->
            </div>
            <!-- modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>