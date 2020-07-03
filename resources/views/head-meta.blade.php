<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$texto->where('seccion','Empresa_nombre')->first()->contenido}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
   
   
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800i" rel="stylesheet">
    
    <!-- favicon icon -->
    <link rel="shortcut icon" type="images/png" href="{{asset('assets/themebasic/images/'.$imagen['favicon'])}}">
    
    <!-- all css here -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/themebasic/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/themebasic/css/toastr.css')}}">

    <!-- modernizr css -->
    <script src="{{asset('assets/themebasic/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    

    <style>
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #00b200;
    border-color: #150932;

    
}

/* Make the element pulse (grow large and small slowly) */
/* Usage
    .myElement {
        animation: pulsate 1s ease-out;
        animation-iteration-count: infinite;
        opacity: 1; 
    }
*/
@-webkit-keyframes pulsate {
    0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
    50% {opacity: 1.0;}
    100% {-webkit-transform: scale(1.1, 1.1); opacity: 0.0;}
}

/* Make the element's opacity pulse*/
/* Usage
    .myElement {
        animation: opacityPulse 1s ease-out;
        animation-iteration-count: infinite;
        opacity: 0; 
    }
*/
@-webkit-keyframes opacityPulse {
    0% {opacity: 0.5;}
    50% {opacity: 1.0;}
    100% {opacity: 0.5;}
}

/* Make the element's background pulse. I call this alertPulse because it is red. You can call it something more generic. */
/* Usage
    .myElement {
        animation: alertPulse 1s ease-out;
        animation-iteration-count: infinite;
        opacity: 1; 
    }
*/
@-webkit-keyframes alertPulse {
    0% {background-color: #9A2727; opacity: 1;}
    50% {opacity: red; opacity: 0.75; }
    100% {opacity: #9A2727; opacity: 1;}
}

.swal-button--cancelar{
  background-color: #b9284d;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
}

.swal-button--confirm{
  background-color: #1bbd5f;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
}


/* Make the element rotate infinitely. */
/* 
Usage
    .myElement {
        animation: rotating 3s linear infinite;
    }
*/
@keyframes rotating {
  from {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  to {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.scrollOn {
    max-height: 250px;
    overflow-y: scroll;
    overflow-x: hidden;
}

.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    line-height: 1.5rem;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 2px solid #ddd;
}

.single-banner-top {
    background: url({{asset('assets/themebasic/images/bg/bg-t2.jpg')}}) no-repeat top center / cover;
    height: 110px;
}
.home-1 .layer-1-1 .title1 {
    color: #00b200;
    font-size: 60px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-align: center;
}

.business-policy-wrap {
    background: rgba(0, 0, 0, 0) url({{asset('assets/themebasic/images/shipping/'.$imagen['parallax1'])}}) no-repeat fixed center center / cover;
    position: relative;
    padding: 60px 0;
    overflow: hidden;
    margin: 50px 0 0;
}

.main-testimonial {
    background: rgba(0, 0, 0, 0) url({{asset('assets/themebasic/images/newsletter/'.$imagen['parallax2'])}}) no-repeat fixed center center / cover;
    position: relative;
    overflow: hidden;
    height: auto;
    padding: 130px 0;
    width: 100%;
    z-index: 99;
}

.header-search-box {
    background-color: #fff;
    width: 100%;
    position: relative;
    float: left;
    z-index: 111;
    border: 2px solid;
    border-radius: 3px;
}

.my-element2 {
  display: inline-block;
  margin: 0 0.5rem;
  animate__repeat:2;

  animation: flipInY ; /* referring directly to the animation's @keyframe declaration */
  animation-duration: 3s; /* don't forget to set a duration! */

}

.my-element {
    animation: pulsate 2s ease-out;
    animation-iteration-count: infinite;
    opacity: 1; 
}
</style>
</head>

