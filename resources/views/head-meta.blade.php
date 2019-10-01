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
    

    <style>
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #cc2520;
    border-color: #150932;

    
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
    height: 200px;
}
.home-1 .layer-1-1 .title1 {
    color: #f30202;
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




</style>
</head>

