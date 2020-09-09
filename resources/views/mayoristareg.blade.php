<!doctype html>
<html class="no-js" lang="en">
    @include('head-meta')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
           
            
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            background-color: aquamarine;
            cursor: inherit;
            display: block;
        }
    </style>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center">
                            <div class="single-ban-top-content">
                                <p>Formulario para Mayorista</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-single-heading-banner-->
            <!--start-single-heading-->
            <div class="signle-heading login-m">
                <div class="container">
                    <div class="row">
                        <!--start-shop-head -->
                        <div class="col-lg-12">
                            <div class="shop-head-menu">
                                <ul>
                                    <li><i class="fa fa-home"></i><a class="shop-home" href="index.html"><span>Incio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Inicio Sesión</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- login-area start -->
            <div class="login-area">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="login-content login-margin">
                                <h2 class="login-title">Formulario de Mayorista</h2>
                                <p>Llene los campos y adjunte los documentos necesarios para aplicar.</p>
                                <p>Campos con <span style="color: red; font-size:2rem">*</span> son obligatorios</p>
                                <form data-toggle="validator" role="form" id="form_register_mayor" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Correo Electrónico<span class="required">*</span></label>
                                                <input type="email" placeholder="Dirección de correo válida" id="emailr" name="email" required data-parsley-type="email"/>
                                                {{-- <label>Contraseña</label>
                                                <input type="password" placeholder="Al menos 6 cracteres" id="password1r" name="password" required minlength="6" />
                                                <label>Repita Contraseña</label>
                                                <input type="password" placeholder="Ingrese nuevamente" id="password2r" name="password2" required required data-parsley-equalto="#password1r" /> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label> Nombre<span class="required">*</span></label>										
                                                <input type="text" placeholder="Su nombre" id="nombre" name="name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Apellido <span class="required">*</span></label>										
                                                <input type="text" placeholder="Su apellido" name="lastname" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="country-select">
                                                <label>Identificación <span class="required">*</span></label>										
                                                <select name="id_type" id="id_type">
                                                  <option value="cedula" selected>Cédula</option>
                                                  <option value="ruc">Ruc</option>
                                                  <option value="pasaporte">Pasaporte</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">									
                                                <input type="text" name="num_id" id="numero_identidad" placeholder="Numero de Identificación" maxlength="13" minlength=10 required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label> Nombre de Representante</label>										
                                                <input type="text" placeholder="Nombre de Representante" id="nombrerepre" name="namerepre" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="country-select">
                                                <label>Identificación Representante</label>										
                                                <select name="id_type2" id="id_type2">
                                                  <option value="cedula" selected>Cédula</option>
                                                  <option value="ruc">Ruc</option>
                                                  <option value="pasaporte">Pasaporte</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">									
                                                <input type="text" name="num_id_repre" id="numero_identidad_repre" placeholder="Identificació Representante" maxlength="13" minlength=10 />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">									
                                                <span class="btn btn-primary btn-file" style="width: 100%">
                                                    Imagen de Documento de Identidad<input type="file" name="file_id" id="file_id"  accept="image/x-png,image/jpg,image/jpeg" required>
                                                    <label class="custom-file-label2" for="file_id" style="color:white">Seleccionar</label>
                                                 </span>
                                            </div>
                                            <div class="checkout-form-list">									
                                                <span class="btn btn-primary btn-file" style="width: 100%">
                                                    Imagen de Papeleta Votación<input type="file" name="papeleta_id" id="papeleta_id" accept="image/x-png,image/jpg,image/jpeg"  required>
                                                    <label class="custom-file-label3" for="papeleta_id" style="color:white">Seleccionar</label>
                                                 </span>
                                            </div>
                                            <div class="checkout-form-list">									
                                                <span class="btn btn-primary btn-file" style="width: 100%">
                                                    Imagen de Recibo <input type="file" name="recibo_id" id="recibo_id" accept="image/x-png,image/jpg,image/jpeg"  required>
                                                    <label class="custom-file-label" for="recibo_id" style="color:white">Seleccionar</label>
                                                 </span>
                                            </div>
                                        </div>
                                      								
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Dirección <span class="required">*</span></label>
                                                <input type="text" placeholder="Calle y sector" name="dir1" required />
												<input type="text" name="dir2" placeholder="Apartamento, Oficina, referencias de locales (Opcional)" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="country-select">
                                                <label>Ciudad<span class="required">*</span></label>
                                                <select name="ciudad" id="Ciudad" required>
                                                    @foreach ($provincias as $provi)
                                                       <option value="{{$provi->codigo}}">{{$provi->nombre}}</option>
                                                    @endforeach                                            
                                                </select>
                                                <!-- <input type="text" placeholder="Ciudad" name="ciudad" required /> -->
                                            </div>
                                             <div class="country-select" style="display:none;">
                                                <label>Canton<span >*</span></label>
                                                <select name="canton" id="Canton" >                           
                                                </select>
                                                <!-- <input type="text" placeholder="Ciudad" name="ciudad" required /> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Telf. Celular  <span class="required">*</span></label>										
                                                <input type="text" name="tlf1" placeholder="Celular" pattern="^[0-9]{1,}$" maxlength="12" minlength=7 required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Telf. Domicilio  <span class="required">*</span></label>										
                                                <input type="text" name="tlf2" placeholder="Domicilio" pattern="^[0-9]{1,}$" maxlength="12" minlength=7 required />
                                            </div>
                                        </div>
                                        							
                                    </div>
                                    <h4 id="error-validacionr" style="color:red"></h4>
                                    <input class="login-sub" id="register-btn" type="submit" value="APLICAR" />
                                </form>
                                <div class="sign-up-today">
                                    <h2 class="login-title">La Información será Evaluada:</h2>
                                    <ul>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>El Minimo de compras para Mayoristas es 100$</span>
                                            </span>									
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>Los documentos debe ser en formato JPG no mayores a 200Kb</span>
                                            </span>									
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>De ser aceptada la solicitud nos comunicaremos via telefónica.</span>
                                            </span>									
                                        </li>
                                    </ul>
                                </div>							
                            </div>
							
                        </div>
                    </div>
                </div>
            </div>
            <!-- login-area end -->	

            <!--Start-footer-wrap-->
           @include('footer')
            <!--End-footer-wrap-->
             
        </div>
        <!--End-main-wrapper-->
        <!-- Quickview-product-strat -->
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
                                        <img alt="" src="">
                                    </div>
                                </div>
                                <!-- product-images -->
                                <!-- product-info -->
                                <div class="product-info">
                                    <h1>Ejemplo Producto</h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="normal-price">$333.00</span>
                                        </div>
                                    </div>
                                    <a href="shop-grid.html" class="see-all">Mirar todas las caracteristicas</a>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="french-hens" value="3">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit">Añadir al carrito</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        Texto de ejemplo.
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Compartir este producto</h3>
                                            <ul class="social-icons">
                                                <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a>
                                                </li>
                                                <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a>
                                                </li>
                                            </ul>
                                        </div>
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
        <!-- End quickview product -->
        <!-- Modal -->
<div id="modal-registrado" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Usuarios del Sistema ADM</h4>
        </div>
        <div class="modal-body">
          <h3 class="text-center">Introduzca el número de documento con el que está registrado en ADM (RUC ó Cedula)</h3>
          <div>
            <div class="form-group">
                <label for="usr">Número</label>
                <input type="text" class="form-control" id="documento-identi" maxlength="13">
            </div>
              <button id="consultar-btn" class="btn btn-primary btn-lg text-center">Consultar</button>
          </div>
          <div class="row">
                <div id="formulario-si">
                        <form id="form-seteo" action="">
                                <div class="col-md-12">
                                    <h5 id="resultado-consulta" style="color:forestgreen; margin-top:1rem"></h5>
                                </div>
                                    
                                <div class="form-group col-sm-12 col-md-6">
                                        <label for="usr">Crear Contraseña</label>
                                        <input type="password" class="form-control desac" id="contrasena1" required placeholder="Minino 6 caracteres" data-parsley-minlength="6" maxlength="20" disabled>
                                        <input type="password" class="form-control desac" id="contrasena2" required data-parsley-equalto="#contrasena1" placeholder="Repita la Contraseña" maxlength="20" disabled>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                        <label for="usr">Email</label>
                                        <input type="email" data-parsley-type="email" required class="form-control desac" id="email-pedido" placeholder="Email para Pedidos" maxlength="50" disabled>
                                        <button class="btn-sm btn btn-black" id="set-pass">Enviar</button>
                                </div>
                        </form>
                        <h4 id="error-validacion"></h4>
                  </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<div id="modal-recuperar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Recuperar Contraseña</h4>
        </div>
        <div class="modal-body">
            <h3 class="text-center">Introduzca el Correo Electrónico con el que esta registrado</h3>
            <div>
            <div class="form-group">
                <label for="usr">Correo</label>
                <input type="email" data-parsley-type="email" required  class="form-control" id="email-recuperar" maxlength="100">
            </div>
                <button id="consultar-email" class="btn btn-primary btn-lg text-center">Consultar</button>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
    
        
		<!-- all js here -->
        @include('js-end')
        {{-- <script src="{{asset('assets/themebasic/js/ruc_jquery_validator.min.js')}}"></script> --}}
        <script src="{{asset('assets/themebasic/js/parsley.min.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#register-btn').click(function(e){
              
                e.preventDefault();
                var formulario = $("#form_register").serialize();
                var emailr = $("#emailr").parsley();
                // var con1r = $("#password1r").parsley();
                // var con2r = $("#password2r").parsley();
                
                var total = 0;
                var tipo = $("#id_type").val();
                var num_ide = document.getElementById("numero_identidad").value;
                var longitud = num_ide.length;
                var longcheck = longitud - 1;


                if (tipo == "cedula") {
                    if (num_ide !== "" && longitud === 10){
                        for(i = 0; i < longcheck; i++){
                            if (i%2 === 0) {
                            var aux = num_ide.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                            } else {
                            total += parseInt(num_ide.charAt(i)); // parseInt o concatenará en lugar de sumar
                            }
                        }
                        total = total % 10 ? 10 - total % 10 : 0;

                        if (num_ide.charAt(longitud-1) == total) {
                            registrar();
                            console.log("Cedula Válida");
                        }else{
                            swal("Upss","Verifica el número de Cedula", "error");
                            console.log("Cedula Inválida");
                            $('#register-btn').prop('disabled',false);
                        }
                    }else{
                        swal("Upss","Formato de número de cedula está vacio o incorrecto.", "error");
                        $('#register-btn').prop('disabled',false);
                    }
                    
                } else if (tipo == "ruc"){
                    if (longitud == 13) {
                        registrar();
                    } else {
                        swal("Upss","Formato de RUC es muy corto.", "error");
                        $('#register-btn').prop('disabled',false);
                    }
                    
                } else{
                    registrar();
                }

                function registrar(){
                    
                    if ($("#form_register_mayor").parsley().isValid()) {
                        $("#error-validacionr").text("");
                        
                        var form_data = new FormData(document.getElementById("form_register_mayor"));

                        $.ajax({
                            url:"{{ route('mayoristareg') }}",
                            method:"POST",
                            data:form_data,
                            dataType:'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(data)
                            {
                                if(data.estado == 'enviado'){
                                    swal("Formulario Enviado","Verificaremos la información y nos pondremos en contacto.", "success");
                                }else{
                                    swal("Error Enviado Formulario","Por Favor intente más tarde.", "error");
                                }
                            }
                        })
                    } else {
                        $("#error-validacionr").text("Verifique los campos del formulario");
                        $('#register-btn').prop('disabled',false);

                    }
                }
              
            });

            $('#Ciudad').change(function(event) {
                $('#Canton')
                .find('option')
                .remove()
                .end();
                let provin = $(this).children("option:selected").val()
                $.ajax({
                    url: '{{route("getcantones")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {provincia: provin },
                })
                .done(function(data2) {
                    $.each(data2,function(i, item){
                        $('#Canton').append($('<option>', { 
                            value: item.codigo,
                            text : item.nombre 
                        }));
                    });
                     
                })
                .fail(function() {
                    console.log("error");
                });
            });


            $('#recibo_id').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
            $('#file_id').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label2').html(fileName);
            })
            $('#papeleta_id').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label3').html(fileName);
            })
        </script>
    </body>
</html>     