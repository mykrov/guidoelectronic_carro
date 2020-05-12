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
                                <p>Revisión Final</p>
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
                                    <li class="shop-pro">Revisión Final</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- coupon-area start -->
            <div class="coupon-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="coupon-accordion">
                                <!-- ACCORDION START -->
                                <h3>Es usted cliente? <span id="showlogin">Click aquí para Iniciar Sesión</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <p class="coupon-text">Al inciar sesión, usted podrá rastrear su pedido facilmente y mantener un registro de todas sus comprar.</p>
                                        <form action="#" data-toggle="validator" role="form">
                                            <p class="form-row-first">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" required />
                                            </p>
                                            <p class="form-row-last">
                                                <label>Contraseña  <span class="required">*</span></label>
                                                <input type="password" required />
                                            </p>
                                            <p class="form-row">					
                                                <input type="submit" value="Iniciar Sesión" />
                                                <label>
                                                    <input type="checkbox" />
                                                     Recuerdame
                                                </label>
                                            </p>
                                            <p class="lost-password">
                                                <a href="#">¿Ha olvidado su contraseña?</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <!-- ACCORDION END -->						
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            {{-- <div class="coupon-accordion">	
                                <!-- ACCORDION START -->
                                <h3>¿Tiene un cupón? <span id="showcoupon">Click aqui para ingresar tu cupón</span></h3>
                                <div id="checkout_coupon" class="coupon-checkout-content">
                                    <div class="coupon-info">
                                        <form action="#" data-toggle="validator" role="form">
                                            <p class="checkout-coupon">
                                                <input type="text" placeholder="Código Cupón" pattern="^[A-z0-9]{1,}$" required />
                                                <input type="submit" value="Aplicar Cupón" />
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <!-- ACCORDION END -->						
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- coupon-area end -->		
            <!-- checkout-area start -->
            <div class="checkout-area">
                <div class="container">
                    <div class="row">
                        <form action="#">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox-form">						
                                    <h3>Detalles de facturación</h3>
                                    <div class="row">
									<form data-toggle="validator" role="form">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Nombre <span class="required">*</span></label>										
                                            <input type="text" placeholder="" value="{{$user->nombre}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Apellido <span class="required">*</span></label>										
                                                <input type="text" placeholder=""  value="{{$user->apellido}}"required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Nombre de Empresa</label>
                                                <input type="text" placeholder=""  value="{{$user->empresa}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Dirección <span class="required">*</span></label>
                                                <input type="text" placeholder="Calle y sector"  value="{{$user->direccion}}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">									
                                                <input type="text" placeholder="Apartamento, Oficina, referencias de locales"  value="{{$user->referencia}}" (Opcional) />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="country-select">
                                                <label>País <span class="required">*</span></label>
                                                <select>
                                                  <option value="ecuador">Ecuador</option>
                                                </select> 										
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Ciudad <span class="required">*</span></label>
                                                <input type="text" placeholder="Ciudad"  value="{{$user->ciudad}}"required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Código Postal <span class="required">*</span></label>										
                                                <input type="text" placeholder="Código Postal"  value="{{$user->codigo_postal}}" pattern="^[0-9]{1,}$" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Celular 1 <span class="required">*</span></label>										
                                                <input type="text" placeholder=""  value="{{$user->celular1}}" pattern="^[0-9]{1,}$" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Correo Electrónico <span class="required">*</span></label>										
                                                <input type="email"  value="{{$user->correo}}"placeholder="" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Celular 2 </label>										
                                                <input type="text" placeholder=""  value="{{$user->celular2}}" pattern="^[0-9]{1,}$"  />
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list create-acc">	
                                                <input id="cbox" type="checkbox" />
                                                <label>¿Desea crear una cuenta?</label>
                                            </div>
                                            <div id="cbox_info" class="checkout-form-list create-account">
                                                <p>Cree una cuenta ingresando la información a continuación. Si es un cliente ya registrado, por favor, inicie sesión en la parte superior de la página.</p>
                                                <label>Contraseña de la Cuenta  <span class="required">*</span></label>
                                                <input type="password" placeholder="contraseña" />	
                                            </div>
                                        </div> --}}
										
                                    </div>
                                    <div class="different-address">
                                            <div class="ship-different-title">
                                                <h3>
													<input id="ship-box" type="checkbox" />
                                                    <label>¿Enviar a otra dirección el pedido?</label>
                                                </h3>
                                            </div>
                                        <div id="ship-box-info" class="row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Nombre <span class="required">*</span></label>										
													<input type="text" placeholder=""  required/>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Apellido <span class="required">*</span></label>										
													<input type="text" placeholder="" required />
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="checkout-form-list">
													<label>Dirección <span class="required">*</span></label>
													<input type="text" placeholder="Calle y sector" required />
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="checkout-form-list">									
													<input type="text" placeholder="Apartamento, Oficina, referencias de locales (Opcional)" />
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="country-select">
													<label>País <span class="required">*</span></label>
													<select>
													  <option value="ecuador">Ecuador</option>
													  <option value="colombia">Colombia</option>
													  <option value="peru">Perú</option>
													  <option value="brasil">Brasil</option>
													  <option value="venezuela">Venezuela</option>
													  <option value="bolivia">Bolivia</option>
													  <option value="europa">Europa</option>
													  <option value="usa">USA</option>
													</select> 										
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="checkout-form-list">
													<label>Ciudad <span class="required">*</span></label>
													<input type="text" placeholder="Ciudad" required />
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Código Postal <span class="required">*</span></label>										
													<input type="text" placeholder="Código Postal" pattern="^[0-9]{1,}$" required />
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Celular 1 <span class="required">*</span></label>										
													<input type="text" placeholder="" pattern="^[0-9]{1,}$" required />
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Correo Electrónico <span class="required">*</span></label>										
													<input type="email" placeholder="" required />
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="checkout-form-list">
													<label>Celular 2 </label>										
													<input type="text" placeholder="" pattern="^[0-9]{1,}$"  />
												</div>
											</div>							
                                        </div>
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Nota al transportista del pedido</label>
                                                <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notas especiales para la entrega." ></textarea>
                                            </div>									
                                        </div>
                                    </div>													
                                </div>
                            </div>	
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="your-order">
                                    <h3>Orden</h3>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Producto</th>
                                                    <th class="product-total">Total</th>
                                                </tr>							
                                            </thead>
                                            <tbody>
                                                @if (!is_null(Session::get('carro')))
                                                @foreach (Session::get('carro') as $item)
                                                <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{$item['nombre']}} <strong class="product-quantity"> × {{$item['cantidad']}}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                        <span class="amount">${{round($item['precio'],2) * round($item['cantidad'],2) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                @php
                                                if (!is_null(Session::get('carro'))) {
                                                    $subtotal = 0.0;
                                                    $total2 = 0.0;
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
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                <td><span class="amount">${{$subtotal}}</span></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>IVA 12%</th>
                                                    <td><span class="amount">${{$iva}}</span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Envío</th>
                                                    <td>
                                                        <h5>Acordar con Vendedor</h5>
                                                        {{-- <ul>
                                                            <li>
                                                                <input type="radio" name="envio" required />
                                                                <label>
                                                                    Tarifa Fija: <span class="amount">$7.00</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="envio" required />
                                                                <label>Envio Gratuito:</label>
                                                            </li>
                                                            <li></li>
                                                        </ul> --}}
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Orden Total</th>
                                                    <td><strong><span class="amount">${{$subtotal+$iva}}</span></strong>
                                                    </td>
                                                </tr>								
                                            </tfoot>
                                        </table>
                                    </div>
                     

                                   <div class="payment-method">
                                        {{-- caja de pago --}}
                                        {{-- <form id="test-form" action=""></form> --}}
                                   
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                          <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                              <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Transferencia Bancaria
                                                </a>
                                              </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                              <div class="panel-body">
                                                <p>Haga su pago directamente en nuestra cuenta bancaria. Al realizarlo notificanos para validar la operación.</p>
                                                <h4><b>Banco del Pacifico</b></h4>
                                                <h4>Cta. Corriente:  7559817</h4>  
                                                <h4>JAQUELINE BURGOS HUILCAPI</h4>
                                                <h4>CI: 1202302285</h4>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                              <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Pago contra entrega (Sólo Guayaquil)
                                                </a>
                                              </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                              <div class="panel-body">
                                                 <p>Puede recibir sus productos en la comodidad de su casa y relaizar el pago al momento de la entrega.</p>
                                              </div>
                                            </div>
                                          </div>
                                          {{--  <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                              <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  Tarjeta de Crédito o Débito (A través de PAYPAL)
                                                </a>
                                              </h4>
                                            </div>
                                           <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                              <div class="panel-body">
                                                <p>Pague con PayPal; Puede pagar con su tarjeta de crédito si no tiene una cuenta de PayPal.</p>
                                              </div>
                                            </div> 
                                          </div>
                                        </div>	--}}							
                                        <div class="order-button-payment">
                                            <input id="realizar-pedido" type="submit" value="Realizar Pedido" />
                                        </div> 
                                    </div> 
									</form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- checkout-area end -->
            <!--Start-footer-wrap-->
            @include('footer')
            <!--End-footer-wrap-->
        </div>
        <!--End-main-wrapper-->
        
        @include('js-end')
        {{-- <script src="https://cdn.kushkipagos.com/kushki-checkout.js"></script> --}}
        
        {{-- <script type="text/javascript">
            var kushki = new KushkiCheckout({
                form: "form-kushkipay",
                merchant_id: "20000000107774610000",
                amount: "{{$subtotal+$iva}}",
                currency: "USD",
                payment_methods:["credit-card"], // Payments Methods enabled
                is_subscription: false, // Optional
                inTestEnvironment: true, 
                regional:false // Optional
            });
        </script> --}}
       <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            var tipo = '{{Session::get('tipo')}}'
            if(exist){
                swal("Resultado del Proceso:",msg, tipo);
            }
        </script>
    </body>
</html>     