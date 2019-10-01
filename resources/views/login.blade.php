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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center">
                            <div class="single-ban-top-content">
                                <p>Inicio Sesión</p>
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
                            <div class="login-content banner-r-b">
                                <h2 class="login-title">Inicio Sesión</h2>
                                <p>Hola, Bienvenido a tu cuenta</p>
                                <div class="social-sign" style="margin-bottom:2rem;">
                                    <a href="javascrip:void(0)" id="clienteadm" style=" background-color:crimson;">¿Ya eres usuario de Nuestra Empresa?</a>
                                </div>
                                {{-- <div class="social-sign">
                                    <a class="banner-r-b" href="#"><i class="fa fa-facebook"></i> Iniciar Sesión con Facebook</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i> Iniciar Sesión con twitter</a>
                                </div> --}}
                                <form data-toggle="validator" role="form" id="form-login">
                                    {{ csrf_field() }}
                                    <label>Correo Electrónico</label>
                                    <input type="text" required name="email" id="user"/>
                                    <label>Contraseña</label>
                                    <input type="password" required name="password" id="password"/>
                                    <div class="login-lost">
                                        <span class="log-rem">
                                            <input type="checkbox" />
                                            <label>Recordarme!</label>
                                        </span>
                                        <span class="forgot-login">
                                            <a href="#">¿Olvidaste tu contraseña?</a>
                                        </span>
                                    </div>
                                    <input class="login-sub" type="submit" id="login-btn" value="Iniciar Sesión" />
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							
                            <div class="login-content login-margin">
                                <h2 class="login-title">Crear una nueva cuenta</h2>
                                <p>Cree su propia cuenta personalizada.</p>
                                <form data-toggle="validator" role="form" id="form_register">
                                    {{ csrf_field() }}
                                    <div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Correo Electrónico</label>
                                                <input type="email" placeholder="Dirección de correo válida" id="emailr" name="email" required data-parsley-type="email"/>
                                                <label>Contraseña</label>
                                                <input type="password" placeholder="Al menos 6 cracteres" id="password1r" name="password" required minlength="6" />
                                                <label>Repita Contraseña</label>
                                                <input type="password" placeholder="Ingrese nuevamente" id="password2r" name="password2" required required data-parsley-equalto="#password1r" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Nombre <span class="required">*</span></label>										
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
										{{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="login-lost">
												<span class="log-rem">
													<input id="cbox" type="checkbox" name="es_empresa" />
													<label>¿Es usted una empresa?</label>
												</span>
											</div>
                                            <div id="cbox_info" class="checkout-form-list create-account">
												<div class="checkout-form-list">
													<label>Nombre de Empresa</label>
													<input type="text" placeholder="" name="nombre_empre"/>
													<label>RUC</label>
													<input type="text" pattern="^[0-9]{1,}$" maxlength="13" minlength=13 placeholder="RUC" name="ruc_empre" />
													<label>Adjuntar RUC (Documento en PDF)</label>
													<input type="file" class="login-sub" id="pdf_ruc" accept=".pdf">
													<label>Planilla de Servicios Basicos (Documento en PDF)</label>
													<input type="file" class="login-sub" accept=".pdf">
													<label>Nombramiento del Representante Legal (Documento en PDF)</label>
													<input type="file" class="login-sub" accept=".pdf">
													<label>Cédula del Representante Legal (Formato JPG o PNG)</label>
													<input type="file" class="login-sub" accept=".jpg,.png">
												</div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Dirección <span class="required">*</span></label>
                                                <input type="text" placeholder="Calle y sector" name="dir1" required />
												<input type="text" name="dir2" placeholder="Apartamento, Oficina, referencias de locales (Opcional)" />
												<div class="country-select">
													<label>País <span class="required">*</span></label>
													<select name="pais">
													  <option value="ecuador">Ecuador</option>
													</select> 										
												</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Ciudad <span class="required">*</span></label>
                                                <input type="text" placeholder="Ciudad" name="ciudad" required />
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="checkout-form-list">
                                                <label>Celular  <span class="required">*</span></label>										
                                                <input type="text" name="tlf1" placeholder="Celular" pattern="^[0-9]{1,}$" maxlength="12" minlength=7 required />
                                            </div>
                                        </div>
                                        							
                                    </div>
                                    <h4 id="error-validacionr" style="color:red"></h4>
                                    <input class="login-sub" id="register-btn" type="submit" value="Registrarse" />
                                </form>
                                <div class="sign-up-today">
                                    <h2 class="login-title">Registrese hoy y podrá:</h2>
                                    <ul>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>Acelerar su camino a través del checkout</span>
                                            </span>									
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>Rastree su pedido facilmente</span>
                                            </span>									
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-check-square-o"></i>
                                                <span>Mantenga un registro de todas sus comprar</span>
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

            $("#login-btn").click(function(e){

                e.preventDefault();

                var user = $("#user").val();
                var password = $("#password").val();

                var form = $("#form-login").serialize();

                $.ajax({
                type: "POST",
                url: "{{route('login-process')}}",
                data: form,
                success: function (response) {
                        if(response == 'logueado'){
                            $(location).attr('href','/');
                        } else{
                            swal("Error en los datos!", "Verifique los datos de inicio de sesión.", "error");                                                       
                        }
                    }
                });

            });

            $('#register-btn').click(function(e){
               // $('#register-btn').prop('disabled',true);
                
                e.preventDefault();
                var formulario = $("#form_register").serialize();
                var emailr = $("#password1r").parsley();
                var con1r = $("#password1r").parsley();
                var con2r = $("#password2r").parsley();
                
                var total = 0;
                var tipo = $("#id_type").val();
                var num_ide = document.getElementById("numero_identidad").value;
                var total = 0;
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
                    if ($("#form_register").parsley().isValid()) {

                        $("#error-validacionr").text("");
                        $.ajax({
                            type: "POST",
                            url: "{{route('register')}}",
                            data: formulario,
                            success: function (response) {
                                if (response == 'registrado') {
                                    $("#btn-register").attr("disabled", false);
                                    swal("Registado!", "Por favor 'ACTIVE' su usuario con el link  de activación que enviamos a su correo.", "success");                           
                                    $('#form_register')[0].reset();
                                  
                                } else if (response == "campos_vacios") {
                                    swal("Upss","Verifica que todos los datos obligatorios esten llenos y que el email y/o RUC no esté ya registrado", "error");
                                    $("#btn-register").attr("disabled", false);

                                } else if (response == "ruc_registrado") {
                                    swal("Atención","El número de identificación ingresado ya se encuentra registrado", "error");
                                    $("#btn-register").attr("disabled", false);
                                } else if(response == "ruc_invalido"){
                                    swal("Atención","El RUC ingresado es incorrecto", "error");
                                    $("#btn-register").attr("disabled", false);
                                }
                            }
                        });

                    } else {
                        $("#error-validacionr").text("Verifique los campos del formulario");
                        $('#register-btn').prop('disabled',false);

                    }
                }
              
            });

            $("#clienteadm").click(function(e){
                e.preventDefault();
                $("#modal-registrado").modal("show");
            });

            $("#consultar-btn").click(function(e){
              
                e.preventDefault();
                var identificacion = $("#documento-identi").val();
                
                if(identificacion != ''){
                    $.ajax({
                    type: "POST",
                    url: "{{route('consultarADM')}}",
                    data: {"identi":identificacion},
                    dataType: "json",
                    success: function (response) {
                        if(response["res"] == "encontrado"){
                            $("#resultado-consulta").html("Encontrado: "+response["dato"]+", cree una contraseña en indique Email a continuación:");
                            $('.desac').removeAttr("disabled");
                            $("#documento-identi").attr('disabled',true);
                        }else if (response["res"] == "no-encontrado"){
                            $("#modal-registrado").modal("hide");
                            swal("Atención","El número ingresado no se encuenra en registrado en nuestra WEB, proceda a registrarse","info");
                        }else if(response["res"] == "encontrado-condatos"){
                            $("#modal-registrado").modal("hide");
                            swal("Atención","Al parecer ya tiene una cuenta en esta web con el Email: "+response["dato"] +", de Click en ¿Olvidaste tu Contraseña? en caso de no recordarla.","info");
                        }
                    }
                });
                }else{
                    $("#modal-registrado").modal("hide");
                    swal("Atención","Tiene que indicar un número de Identificación.","error");
                }
            });


            $("#set-pass").click(function(e){
                e.preventDefault();
                var email = $("#email-pedido").parsley();
                var con1 = $("#contrasena1").parsley();
                var con2 = $("#contrasena2").parsley();
                
                if(!email.isValid()){
                    $("#error-validacion").text("El email no es correcto.");
                };
                if(!con1.isValid()){
                    $("#error-validacion").text("Verifique la contraseña.");
                };
                if(!con2.isValid()){
                    $("#error-validacion").text("Las contraseñas no coinciden.");
                };

                if($("#form-seteo").parsley().isValid()){
                    $("#error-validacion").text("");
                    
                    var contr = $("#contrasena1").val();
                    var emaild = $("#email-pedido").val()
                    var identificacion = $("#documento-identi").val();

                    $.ajax({
                        type: "POST",
                        url: "{{route('seteo-data')}}",
                        data: {"email":emaild,"contrasena":contr,"ruc":identificacion},
                        dataType: "json",
                        success: function (response) {
                            if(response["res"] == "actualizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Exito","Hemos configurado tu contraseña y correo, enviamos un email para que puedas verificar tu cuenta a: "+response["dato"],"info");

                            }else if(response["res"] == "no-actualizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Error","Problema al actualizar los datos: "+response["dato"],"error");

                            }else if(response["res"] == "email-utilizado"){
                                $("#modal-registrado").modal("hide");
                                swal("Inconveniente","El email que indicó ya está siendo utilizado por otro usuario.","info");
                            }

                        }
                    });
                }

            });

            $(".forgot-login").click(function(e){
                e.preventDefault();
                $("#modal-recuperar").modal("show");
                
            });

            $("#consultar-email").click(function(e){

                var email = $("#email-recuperar").parsley();
                e.preventDefault();
               
                if(email.isValid()){
                    
                    $("#consultar-email").prop('disabled',true);

                    $.ajax({
                        type: "POST",
                        url: "{{route('recuperar')}}",
                        data: {'email':$("#email-recuperar").val()},
                        dataType: "json",
                        success: function (response) {
                            if(response['res']== "process-open"){
                                $("#modal-recuperar").modal("hide");
                                swal("Revisar Correo","Se envió un Email al correo indicado con un enlace para que resetee su contraseña.","info");
                            }else if (response["res"] == "no-finded"){
                                $("#consultar-email").prop('disabled',false);   
                                $("#modal-recuperar").modal("hide");
                                swal("Correo no Encontrado","El Email que indicó no fue encontrado.","error");
                            }
                        }
                    });
                }
            });

        </script>
    </body>
</html>     