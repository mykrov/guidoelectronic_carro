<!doctype html>
<html class="no-js" lang="en">
    <style>
        .br-bot{
            border-bottom: 2px solid;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .col-md-6 p{
            text-align: justify;
            font-size: 2rem;
           
        }

        .vcenter{
            display: inline-block;
            vertical-align: middle;
            float: none;
        }

        ul.terminos {
            list-style-type: circle;
            padding: 2rem;
            margin: 2rem;
            font-size: 2rem;

        }

        .condiciones p{
            font-size: 2rem;
        }

        .panel-default {
            border:2px solid #0a841f!important;
            #border-color: ;
            border-radius: 5px !important;
        }
    </style>
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
                                <p>Terminos y Condiciones</p>
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
                                    <li class="shop-pro">Nuestras Politicas:</li>
                                </ul>
                            </div>
                        </div>
                        <!--end-shop-head-->
                    </div>
                </div>
            </div>
            <!--end-single-heading-->
            <!--contact-map-area-start-->
            <div class="map-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 condiciones">
                        
                            <h2 class="text-blue" style="color: #0a841f">Política de garantía:<h2>
                        
                            <p>En caso de que el PRODUCTO se encuentre con un defecto de fábrica, el USUARIO podrá solicitar 
                            el reemplazo por una NUEVA UNIDAD o la DEVOLUCIÓN del importe abonado, siempre y cuando lo comunique
                            en un plazo máximo de 15 DÍAS desde la recepción del PRODUCTO y que éste se encuentre en 
                            perfecto estado y con su embalaje y accesorios originales. El reemplazo por un nuevo PRODUCTO 
                            quedará sujeto a la verificación de daños de fábrica por parte de GuidoElectronic y también a la 
                            disponibilidad del mismo, por lo que GuidoElectronic podrá notificar al USUARIO que el PRODUCTO no 
                            se encuentra disponible y realizará el reembolso del precio pagado por el USUARIO.</p>

                            <p>Para que se autorice la devolución del PRODUCTO por DEFECTOS DE FÁBRICA, éste deberá cumplir los 
                                siguientes requisitos mínimos. En algunos casos, dependiendo de la naturaleza del PRODUCTO, 
                                podrán existir otros requisitos de devoluciones, los cuales serán publicados en la PÁGINA WEB 
                                junto al PRODUCTO.</p>

                        <ul class="terminos">
                            <li>El PRODUCTO debe encontrarse en las mismas condiciones en las que fue entregado al USUARIO. Los daños o defectos en el PRODUCTO no deben haber sido causados por acción u omisión del USUARIO.</li> 
                            <li>El PRODUCTO debe ser devuelto con todos los empaques, envoltorios, facturas, manuales, instrucciones, certificados de garantía, accesorios con los que fue entregado al USUARIO.</li>
                            <li>El PRODUCTO no debe haber sido utilizado, al menos que al momento de haberlo utilizado por primera vez no hubiese funcionado correctamente por un defecto en su fabricación.</li>
                        </ul>

                        <p>GuidoElectronic facilitará al USUARIO la dirección de entrega en Ecuador. En caso de que el servicio de entrega no encuentre al USUARIO o a una persona autorizada por este en el lugar de entrega, se le informará de dicho particular al USUARIO, quien deberá enviar el PRODUCTO a las oficinas principales de GuidoElectronic en Quito – Ecuador dentro de los 2 días siguientes a la notificación de imposibilidad de retiro del PRODUCTO.</p>
                        <p>El servicio de entrega verificará que el PRODUCTO se encuentra en el mismo empaque o envoltorio en el cual se entregó al USUARIO, caso contrario no aceptará la devolución del PRODUCTO y lo notificará a GuidoElectronic .</p>
                        <p>Una vez recibido el PRODUCTO devuelto, GuidoElectronic verificará que el cumplimiento de las condiciones generales y específicas de devoluciones y procesará la devolución, para la reposición del PRODUCTO o la devolución del precio pagado por el USUARIO, conformidad con lo establecido en este documento.</p>
                        
                        <h2 style="padding-top:3rem; color: #0a841f;" class="text-blue" >Política de cancelación y devolución de productos:</h2>

                        <p>GuidoElectronic permite a los USUARIOS que devuelvan los productos adquiridos únicamente en PÁGINA WEB , para lo cual deberán notificar a GuidoElectronic en un plazo máximo de 7 días desde la recepción del PRODUCTO, con su intención de devolver el PRODUCTO especificando la razón de la devolución.</p>
                        <p>En caso de que el PRODUCTO se encuentre con un defecto de fábrica o el USUARIO no se encuentre conforme, por razones de tamaño o color, podrá solicitar la entrega de un nuevo PRODUCTO que cuente con las características ofertada en la PÁGINA WEB. El envío del nuevo PRODUCTO quedará sujeto a la disponibilidad del mismo, por lo que GuidoElectronic podrá notificar al USUARIO que el PRODUCTO no se encuentra disponible y realizará el reembolso del precio pagado por el USUARIO.</p>
                        <p>Para que se autorice la devolución del PRODUCTO al USUARIO, el PRODUCTO adquirido deberá cumplir los siguientes requisitos mínimos. En algunos casos, dependiendo de la naturaleza del PRODUCTO, podrán existir otros requisitos de devoluciones, los cuales serán publicados en la PÁGINA WEB junto al PRODUCTO.</p>
                        <p>El PRODUCTO debe encontrarse en las mismas condiciones en las que fue entregado al USUARIO. Los daños o defectos en el PRODUCTO no deben haber sido causados por acción u omisión del USUARIO.</p>
                        <p>El PRODUCTO debe ser devuelto con todos los empaques, envoltorios, facturas, manuales, instrucciones, certificados de garantía, accesorios con los que fue entregado al USUARIO.</p>
                        <p>El PRODUCTO no debe haber sido utilizado, al menos que al momento de haberlo utilizado siguiendo las especificaciones e instrucciones del PRODUCTO no hubiese funcionado correctamente por un defecto en su fabricación.</p>
                        <p>Si la devolución del PRODUCTO fue solicitada por el USUARIO dentro del plazo para devoluciones, el USUARIO será quien deberá enviar el PRODUCTO de vuelta a las oficinas principales de GuidoElectronic en Quito – Ecuador dentro de los 2 días siguientes a la solicitud de cancelación o devolución del PRODUCTO.</p>
                        <p>Una vez recibido el PRODUCTO devuelto, GuidoElectronic verificará que el cumplimiento de las condiciones de devoluciones y procesará la devolución del precio pagado por el USUARIO, de conformidad con lo establecido en este documento.</p>
                        <p>En los casos que la devolución del PRODUCTO cumpla con lo establecido en este apartado, GuidoElectronic procederá con el reembolso del pago efectuado.</p>
                        <p>En caso de que el pago haya sido realizado en efectivo, el USUARIO señalará la cuenta bancaria de una institución financiera en el Ecuador para que se reembolse el pago realizado en un plazo máximo 5 días desde la aceptación de la devolución del producto por parte de GuidoElectronic. En caso de no señalar una cuenta bancaria o que esta no sea válida, el dinero estará disponible para el retiro por parte del USUARIO en la oficina principal de GuidoElectronic en QUITO.</p>
                        <p>En caso de que el pago haya sido realizado con tarjeta de crédito o débito, se reembolsará el dinero en la tarjeta en los 10 días posteriores a la aceptación de devolución por parte de GuidoElectronic. Este plazo podrán variar y estar sujeto a ciertas condiciones del emisor de la tarjeta.</p>
                        <p>El USUARIO puede elegir que como método de reembolso la emisión de un CUPÓN de GuidoElectronic por el mismo valor del PRODUCTO que había sido adquirido. Dicho CUPÓN podrá ser utilizado en los siguientes 3 MESES en la compra de cualquier otro PRODUCTO de la página web.</p>
                        </div>
                        <div class="row">
                            <section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
                                <div class="container">
                                    <h2 style="color: #0a841f">Preguntas Frecuentes:</h2>
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                      <div class="panel panel-default">
                                        <div class="panel-heading p-3 mb-3" role="tab" id="heading0">
                                          <h3 class="panel-title">
                                            <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                               ¿Qué es PlacetoPay? 
                                            </a>
                                          </h3>
                                        </div>
                                        <div id="collapse0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0">
                                          <div class="panel-body px-3 mb-4">
                                            <p>PlacetoPay es la plataforma de pagos electrónicos que usa GuidoElectronic para procesar en línea las transacciones generadas en la tienda virtual con las formas de pago habilitadas para tal fin.</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
                                          <h3 class="panel-title">
                                            <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                ¿Cómo puedo pagar? 
                                            </a>
                                          </h3>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                          <div class="panel-body px-3 mb-4">
                                            <p>En la tienda virtual de GuidoElectronic usted podrá realizar su pago con los medios habilitados para tal fin. Usted, de acuerdo a las opciones de pago escogidas por el comercio, podrá pagar a través  Diners, Discover, Visa y MasterCard; de todos los bancos con pago corriente y en los diferido, únicamente las tarjetas emitidas por Banco Pichincha, Diners, Loja, BGR y Manabí. </p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading2">
                                                <h3 class="panel-title">
                                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                        ¿Es seguro ingresar mis datos bancarios en este sitio web? 
                                                    </a>
                                                </h3>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                                <div class="panel-body px-3 mb-4">
                                                    <p>Para proteger tus datos GuidoElectronic delega en PlacetoPay la captura de la información sensible. Nuestra plataforma de pagos cumple con los más altos estándares exigidos por la norma internacional PCI DSS de seguridad en transacciones con tarjeta de crédito. Además tiene certificado de seguridad SSL expedido por GeoTrust una compañía Verisign, el cual garantiza comunicaciones seguras mediante la encriptación de todos los datos hacia y desde el sitio; de esta manera, te podrás sentir seguro a la hora de ingresar la información de su tarjeta. <p>
                                                    <p>Durante el proceso de pago, en el navegador se muestra el nombre de la organización autenticada, la autoridad que lo certifica y la barra de dirección cambia a color verde. Estas características son visibles de inmediato y dan garantía y confianza para completar la transacción en PlacetoPay.<p>
                                                    <p>PlacetoPay también cuenta con el monitoreo constante de McAfee Secure y la firma de mensajes electrónicos con Certicámara.</p>
                                                    <p>PlacetoPay es una marca de la empresa colombiana EGM Ingeniería Sin Fronteras S.A.S. </p>    
                                                </div>
                                            </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading p-3 mb-3" role="tab" id="heading3">
                                          <h3 class="panel-title">
                                            <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                ¿Puedo realizar el pago cualquier día y a cualquier hora? 
                                            </a>
                                          </h3>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                          <div class="panel-body px-3 mb-4">
                                            <p>Sí, en GuidoElectronic podrás realizar tus compras en línea los 7 días de la semana, las 24 horas del día a sólo un clic de distancia. </p>
                                          </div>
                                        </div>
                                      </div>
                                    

                                        <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading4">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                    ¿Puedo cambiar la forma de pago?
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                                            <div class="panel-body px-3 mb-4">
                                                <p>Si aún no has finalizado tu pago, podrás volver al paso inicial y elegir la forma de pago que prefieras. Una vez finalizada la compra no es posible cambiar la forma de pago.</p>
                                            </div>
                                            </div>
                                        </div>
                                        

                                        <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading5">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                    ¿Pagar electrónicamente tiene algún valor para mí como comprador? 
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                                            <div class="panel-body px-3 mb-4">
                                                <p>No, los pagos electrónicos realizados a través de PlacetoPay no generan costos adicionales para el comprador. </p>
                                            </div>
                                            </div>
                                        </div>
                                    

                                        <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading6">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                    ¿Qué debo hacer si mi transacción no concluyó?
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                                            <div class="panel-body px-3 mb-4">
                                                <p>En primera instancia deberás revisar si llegó un mail de confirmación del pago en tu cuenta de correo electrónico (la inscrita en el momento de realizar el pago), en caso de no haberlo recibido, deberás contactar a ventas@guidoelectronic.com para confirmar el estado de la transacción.</p>
                                                <p>En caso que tu transacción haya declinado, debes verificar si la información de la cuenta es válida, está habilitada para compras no presenciales y si tienes cupo o saldo disponible. Si después de esto continua con la declinación debes comunicarte con GuidoElectronic. En última instancia, puedes remitir tu solicitud a servicioposventa@placetopay.ec. </p>
                                            </div>
                                            </div>
                                        </div>
                                    
                                        <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading7">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                    ¿Qué debo hacer si no recibí el comprobante de pago?
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                            <div class="panel-body px-3 mb-4">
                                                <p>Por cada transacción aprobada a través de PlacetoPay, recibirás un comprobante del pago con la referencia de compra en la dirección de correo electrónico que indicaste al momento de pagar.  Si no lo recibes, podrás contactar a la línea GuidoElectronic o al correo electrónico GuidoElectronic, para solicitar el reenvío del comprobante a la misma dirección de correo electrónico registrada al momento de pagar. En última instancia, puedes remitir tu solicitud a servicioposventa@placetopay.ec. </p>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    
                                        <div class="panel panel-default">
                                            <div class="panel-heading p-3 mb-3" role="tab" id="heading8">
                                            <h3 class="panel-title">
                                                <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                    ¿No me llegó el producto que compré ¿qué hago?
                                                </a>
                                            </h3>
                                            </div>
                                            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                                            <div class="panel-body px-3 mb-4">
                                                <p>Debes verificar si la transacción fue exitosa en tu extracto bancario. En caso de ser así, debes revisar nuestras políticas de envío en el sitio web GuidoElectronic para identificar los tiempos de entrega.</p>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-contact-map-area-->
            <!--Start-footer-wrap-->
          @include('footer')
            <!--End-footer-wrap-->
        </div>
        <!--End-main-wrapper-->
		@include('js-end')
        
    </body>
</html>
        