<!doctype html>
<html class="no-js" lang="en">
    @include('head-meta')
    <style>
  

    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.42857143;
        border: 1px solid #ccc;
        border-radius: 4px 4px 0 0;
        font-weight: 700;
        font-size: 1.5rem;
        color: #00b200;
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="single-ban-top-content">
                                <p>Mi Cuenta</p>
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
                            <div class="shop-head-menu" >
                                <ul>
                                <li><i class="fa fa-home"></i><a class="shop-home" href="{{route('index')}}"><span>Incio</span></a><span><i class="fa fa-angle-right"></i></span></li>
                                    <li class="shop-pro">Mi cuenta  </li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!-- wishlist-area start -->
            <div class="wishlist-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="wishlist-content">
                                <div style="margin-bottom: 3rem;">
                                    <h4><strong>Usuario: </strong>{{Session::get('usuario-nombre')}}</h4>
                                    
                                </div>
                                <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#home">Pedidos</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Datos de la Cuenta</a></li>
                                        
                                      </ul>
                                    
                                      <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                                <form action="#" style="margin-top:3rem;">
                                                    <div class="text-center " style="padding-bottom: 3rem">
                                                         <h3>Lista de Pedidos Anteriores</h3>
                                                    </div>
                                                        <div class="table-responsive" style="width: 100%">
                                                            <table  id="table1" class="table table-striped">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th class="product-remove"><span class="nobr">ID</span></th>
                                                                        <th class="product-thumbnail">SubTotal</th>
                                                                        <th class="product-name"><span class="nobr">Iva</span></th>
                                                                        <th class="product-price"><span class="nobr"> Total </span></th>
                                                                        <th class="product-stock-stauts"><span class="nobr"> Fecha</span></th>
                                                                        <th class="product-add-to-cart"><span class="nobr">Articulos </span></th>
                                                                        <th><span class="nobr">Tipo de Pago</span></th>
                                                                        <th>Referencia</th>
                                                                        <th><span class="nobr">Estado</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($cabeceras as $cabe)
                                                                    <tr>
                                                                        <td class="product-remove">{{$cabe->idventas}}</td>
                                                                        <td class="product-thumbnail">${{$cabe->subtotal}}</td>
                                                                        <td class="product-name">${{$cabe->iva}}</td>
                                                                        <td class="product-price">${{$cabe->total}}</td>
                                                                        <td class="product-stock-status">{{$cabe->fecha}}</td>
                                                                        <td class="product-add-to-cart"><button class="btn btn-secondary detalle-ped" data-pedido="{{$cabe->idventas}}">Ver Articulos</button></td>
                                                                        <td>{{ $cabe->tipoPago }}</td>
                                                                        <td>{{$cabe->idusuario.'-'.$cabe->idventas}}</td>
                                                                        <td>
                                                                            @if ($cabe->estadoPago == "APROBADO")
                                                                                <strong style="color:green">{{ $cabe->estadoPago }}</strong>
                                                                            @elseif ($cabe->estadoPago == "PENDIENTE")
                                                                                <strong style="color:#499ed0">{{ $cabe->estadoPago }}</strong>
                                                                            @elseif ($cabe->estadoPago == "RECHAZADO")
                                                                                <strong style="color:red">{{ $cabe->estadoPago }}</strong>
                                                                            @elseif($cabe->estadoPago == 'ConflictoPTP')
                                                                                <div style="align-content: center">
                                                                                    <strong style="color:#d88a23">No Pagado</strong><br>
                                                                                    <button data-venta="{{ $cabe->idventas }}" class="btn btn-xs" style="background-color: coral; color:white">Reintentar Pago</button>
                                                                                </div>
                                                                            @else
                                                                                <strong style="color:gray">{{ $cabe->estadoPago }}</strong>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>	
                                                    </form>
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                                <form data-toggle="validator" role="form" id="form_register" style="margin-top:2rem;">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Correo Electrónico</label>
                                                                <input type="email" placeholder="" name="email" readonly value=" {{$dataus->correo}}" />
                                                                    <label>Contraseña</label>
                                                                    <input type="password" placeholder="" name="password" required />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Nombre <span class="required">*</span></label>										
                                                                    <input type="text" placeholder="" name="name" required value=" {{$dataus->nombre}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Apellido <span class="required">*</span></label>										
                                                                    <input type="text" placeholder="" name="lastname" required value=" {{$dataus->apellido}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="country-select">
                                                                    <label>Identificación <span class="required">*</span></label>										
                                                                    <select name="id_type">
                                                                      <option value="cedula" selected>Cédula</option>
                                                                      <option value="ruc">Ruc</option>
                                                                      <option value="pasaporte">Pasaporte</option>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="checkout-form-list">									
                                                                    <input type="text" name="num_id" placeholder="Numero de Identificación" pattern="^[0-9]{1,}$" maxlength="13" minlength=10 required value=" {{$dataus->numero_identificacion}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="login-lost">
                                                                    <span class="log-rem">
                                                                        <input id="cbox" type="checkbox" name="es_empresa" />
                                                                        <label>¿Es usted una empresa?</label>
                                                                    </span>
                                                                </div>
                                                                <div id="cbox_info" class="checkout-form-list create-account">
                                                                    <div class="checkout-form-list">
                                                                        <label>Nombre de Empresa</label>
                                                                        <input value=" {{$dataus->empresa}}" type="text" placeholder="" name="nombre_empre"/>
                                                                        <label>RUC</label>
                                                                        <input value=" {{$dataus->ruc}}" type="text" pattern="^[0-9]{1,}$" maxlength="13" minlength=13 placeholder="RUC" name="ruc_empre" />
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
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Dirección <span class="required">*</span></label>
                                                                    <input type="text" placeholder="Calle y sector" name="dir1" required value=" {{$dataus->direccion}}"/>
                                                                    <input type="text" name="dir2" value=" {{$dataus->referencia}}" placeholder="Apartamento, Oficina, referencias de locales (Opcional)" />
                                                                    <div class="country-select">
                                                                        <label>País <span class="required">*</span></label>
                                                                        <select name="pais">
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
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Ciudad <span class="required">*</span></label>
                                                                    <input type="text" placeholder="Ciudad" name="ciudad" required value=" {{$dataus->ciudad}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="checkout-form-list">
                                                                    <label>Celular <span class="required">*</span></label>										
                                                                    <input value=" {{$dataus->celular1}}" type="text" name="tlf1" placeholder="Celular1" pattern="^[0-9]{1,}$" maxlength="12" minlength=7 required />
                                                                </div>
                                                            </div>
                                                        							
                                                        </div>
                                                        <div class="text-center" style="padding-bottom: 3rem;">
                                                              <input class="login-sub btn btn-lg btn-info " id="register-btn" type="submit" value="Modificar Datos" />
                                                        </div>
                                                    </form>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wishlist-area end -->
            <!-- start-wishlist-area-->
            
            <!-- end-wishlist-area-->
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
             
        </div>
        <!--End-main-wrapper-->

        <div id="DetModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="cab-modal">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped " id="table-modal">
                        <thead class="thead-dark" style=" background: black;color: #FFF;font-size: 1.5rem;">
                           <tr>
                               <th>Producto</th>
                               <th>Cantidad</th>
                               <th>Precio</th>
                               <th>Paga Iva</th>
                               <th>Total</th>
                           </tr>
                        </thead>
                        <tbody id="table-body" >

                        </tbody>
                        </table> 
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
        <script src="{{asset('assets/themebasic/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/themebasic/js/dataTables.bootstrap.min.js')}}"></script>
    </body>
        <script>
            $(document).ready(function() {
                $('#table1').DataTable(


                    {


                        "language":{
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                        },
                        "order": [[ 0, "desc" ]]
                    }
                );

                $(document).on('click','.detalle-ped',function(e){
                    
                    e.preventDefault();

                    var venta = $(this).data('pedido');
                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: "/detallePed",
                        data: {'_token':token,'venta':venta},
                        dataType: "json",
                        success: function (response) {
                            //console.log(response);
                            $("#table-body > tr").remove();
                            $("#cab-modal").html("Detalles de  Pedido Nº: "+venta);
                            response.forEach(item => {
                                console.log(item['DetPrecio']);
                                $("#table-body").append('<tr><td>'+item['ProNombre']+'</td><td>'+item['DetCantidad']+'</td><td>$'+parseFloat(item['DetPrecio']).toFixed(2)+'</td><td>'+item['DetGrabaIva']+'</td><td>$'+parseFloat(item['DetNeto']).toFixed(2)+'</td></tr>');
                                
                                $("#DetModal").modal('show');
                            });
                        }
                    });

                });
            } );


        </script>
        
</html>     