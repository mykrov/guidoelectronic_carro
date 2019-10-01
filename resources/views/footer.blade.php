<footer class="footer-area">
        <div class="footer-top-area home-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                        <div class="footer-logo">
                        <a href="{{route('index')}}"><img src="{{asset('assets/themebasic/images/logo/'.$imagen['logo2'])}}" alt="{{$texto->where('seccion','Empresa_nombre')->first()->contenido}}"></a>
                        </div>
                        <!--footer-text-start-->
                        <div class="footer-top-content">
                            <p class="des">{{$texto->where('seccion','Empresa_descripcion')->first()->contenido}}</p>
                            <div class="footer-read-more">
                            <a href="{{route('nosotros')}}">Leer mas</a>
                                 <span><i class="fa fa-long-arrow-right"></i></span>
                            </div>
                        </div>
                        <!--footer-text-end-->
                        <!--footer-link-area-start-->
                        <div class="social-icon">
                            <h4>Síguenos</h4>
                            <a class="faceb" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                             <a class="twitt" href="#" title="Twitter" ><i class="fa fa-twitter"></i></a>
                            <a class="tumb" href="#" title="Tumblr"><i class="fa fa-tumblr"></i></a>
                            <a class="google" href="#" title="Google-plus"><i class="fa fa-google-plus"></i></a>
                            <a class="dribb" href="#" title="Dribbble"><i class="fa fa-dribbble"></i></a>
                        </div>
                        <!--footer-link-area-end-->
                    </div>
                    <!--footer-tag-area-start-->
                    <div class="tag-area">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <h3 class="wedget-title">Últimos Tags</h3>
                            <div class="footer-top-content">
                                <ul>
                                    <li><a href="#">archivos</a></li>
                                    <li><a href="#">consumo</a></li>
                                    <li><a href="#">descartables</a></li>
                                    <li><a href="#">energía</a></li>
                                    <li><a href="#">escritura</a></li>
                                    <li><a href="#">insumos_de_limpieza</a></li>
                                    <li><a href="#">papelería</a></li>
                                    <li><a href="#">seguridad</a></li>
                                    <li><a href="#">suministros_de_tecnología</a></li>
                                    <li><a href="#">útiles_de_oficina</a></li>
                                    <li><a href="#">útiles_escolares</a></li>
                                </ul>
                                <div class="view-all-tag">
                                    <ul>
                                        <li><a href="#">Ver todos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--footer-tag-area-end-->
                    <!--footer-account-area-start-->
                    <div class="footer-account-area footer-none">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <h3 class="wedget-title">Mi cuenta</h3>
                            <div class="footer-top-content">
                                <ul>
                                    @if (Session::get('usuario-nombre') == '' or null)
                                    <li><a href="{{route('login')}}">Inicio Sesión</a></li>
                                    @else
                                    <li><a href="{{route('cuenta')}}">Mi cuenta</a></li>
                                    @endif 
                                <li><a href="{{route('carro')}}">Mi carrito</a></li>
                                <li><a href="{{route('contacto')}}">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--footer-account-area-end-->
                    <!--footer-contact-info-start-->
                    <div class="footer-contact-info">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <h3 class="wedget-title">Contactenos</h3>
                            <div class="footer-contact">
                                <p class="adress"><label>Dirección:</label><span class="ft-content">{{$texto->where('seccion','Empresa_direccion')->first()->contenido}}</span></p>
                                <p class="phone"><label>Teléfono:</label><span class="ft-content phone-num"><span class="phone1">{{$texto->where('seccion','Empresa_tlf')->first()->contenido}}</span></span></p>
                                <p class="web"><label>Email:</label><span class="ft-content web-site"><a href="mailto: {{$texto->where('seccion','Empresa_email')->first()->contenido}}">{{$texto->where('seccion','Empresa_email')->first()->contenido}}</a></span></p>
                            </div>
                        </div>
                    </div>
                    <!--footer-contact-info-end-->
                </div>
            </div>
        </div>
        <!--footer-top-area-end-->
        <!--footer-bottom-area-start-->
        <div class="footer-bottom-area home-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="copy-right">
                            <span> Copyright &copy; Birobid. {{ now()->year }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="payment-area">
                            <ul>
                                <li><a title="Paypal" href="#"><img src="{{asset('assets/themebasic/images/payment/1.png')}}" alt="Paypal"></a></li>
                                <li><a title="Visa" href="#"><img src="{{asset('assets/themebasic/images/payment/2.png')}}" alt="Visa"></a></li>
                                <li><a title="Bank" href="#"><img src="{{asset('assets/themebasic/images/payment/3.png')}}" alt="Bank"></a></li>
                                <li class="hidden-xs"><a title="Mastercard" href="#"><img src="{{asset('assets/themebasic/images/payment/4.png')}}" alt="Mastercard"></a></li>
                                <li><a title="Discover" href="#"><img src="{{asset('assets/themebasic/images/payment/5.png')}}" alt="Discover"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-bottom-area-end-->
    </footer>