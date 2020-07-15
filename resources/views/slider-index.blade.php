<section class="slider-area home-1">
    <div class="preview-1 home-4">
        <div id="ensign-nivoslider" class="slides">	
            <img src="{{asset('assets/themebasic/images/slider/'.$imagen['slider1'])}}" alt="" title="#slider-direction-1" />
            <img src="{{asset('assets/themebasic/images/slider/'.$imagen['slider2'])}}" alt="" title="#slider-direction-2" />
        </div>
        <!-- direction 1 -->
        <div id="slider-direction-1" class="t-cn slider-direction slider-one">
            <div class="slider-progress"></div>
            <div class="container">
            </div>
        </div>
        <!-- direction 2 -->
        <div id="slider-direction-2" class="slider-direction slider-two">
            <div class="slider-progress"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-left">
                        <div class="slider-content">
                            <!-- layer 1 -->
                            <div class="layer-1-1">
                                <h2 class="title1 wow bounceInRight" data-wow-duration="0.5s" data-wow-delay=".8s">{{$texto->where('seccion','Slider2')->first()->contenido}}</h2>
                            </div>
                            <!-- layer 2 -->
                            <div class="layer-1-2">
                                <p class="title2">
                                    <span class="fashion-1 fashion-2 wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="1s"><i class="fa fa-paperclip" style="font-size:40px;"></i>
                                    </span>
                                </p>
                            </div>
                            <!-- layer 3 -->
                            <div class="layer-1-3 layer-2-3 hidden-xs">
                                <p class="title3  wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="1.5s" >{{$texto->where('seccion','Sub_Slider2')->first()->contenido}}</p>
                            </div>
                            <!-- layer 4 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>