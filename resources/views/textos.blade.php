<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Administracion</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{asset('assets/admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('assets/admin/css/sb-admin.css')}}    " rel="stylesheet">

  <style>
      .imgtable {
       
        max-width:180px;
        max-height:70px;
        
    }
    .table td {
        text-align: center;
        vertical-align:middle;
    }
    .nase{
        font-weight: 600;
        color:green;
        font-size: 18px;
    }

    .bg-dark {
        background-color: #58a2ec !important;
    }
    .table .thead-dark th {
        color: #fff;
        background-color: #0e414c;
        border-color: #000000;
    }

    .form-group label{
        font-size: 1.2rem;
        font-weight: 600;
        color:green;
    }
  </style>

</head>

<body id="page-top" class="">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1" href="{{route('admin')}}">Administración</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    

    <!-- Navbar -->
  

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav ">
      <li class="nav-item">
          <a class="nav-link" href="{{route('admin')}}">
              <i class="fas fa-fw fa-image"></i>
              <span>Imagenes</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('colores')}}">
              <i class="fas fa-fw fa-paint-brush"></i>
              <span>Colores</span>
          </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="{{route('textos')}}">
        <i class="fas fa-fw fa-comment"></i>
        <span>Textos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>PAGOS</span>
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('salir')}}">
              <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Salir</span></a>
      </li>
  </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Administracion</a>
          </li>
          <li class="breadcrumb-item active">Textos</li>
        </ol>
         <!-- Page Content -->
        <div class="row">
            <div class="col-md-8" id="table-div">
                <form id="form-text">
                    <div class="col-md-12">
                        <div>
                            <h5>Bienvenido: {{\Session::get('administrator')}}</h5>
                    </div>
                        <h3>Textos de la WEB </h3>
                        @foreach ($textos as $text)
                            @if ($text->tipo == 'text')
                            <div class="form-group">
                                <label for="{{$text->seccion}}">{{$text->nombre}}:</label>
                                <input type="text" class="form-control" id="{{$text->seccion}}" name="{{$text->seccion}}" placeholder="{{$text->contenido}}" value="{{$text->contenido}}">
                            </div>
                            @else
                            <div class="form-group">
                                <label for="{{$text->seccion}}">{{$text->nombre}}:</label>
                                <textarea class="form-control" name="{{$text->seccion}}" id="{{$text->seccion}}" rows="3">{{$text->parrafo}}</textarea>
                            </div>
                            @endif
                        @endforeach
                        <button id="guardar-btn" type="submit" class="btn btn-primary btn-block">Guardar Textos</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                   
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Birobid 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('assets/admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('assets/admin/js/sb-admin.min.js')}}"></script>

  <script>

   

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('submit','#form-text',function(e){
        
        e.preventDefault();
        $("#guardar-btn").prop('disabled',false);
        data = $("#form-text").serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "{{route('text-save')}}",
            data: data,
            dataType: "JSON",
            success: function (response) {
                if(response == "exito"){
                    console.log(response);
                    $("#guardar-btn").prop('disabled',false);
                    $("#content-wrapper").load(document.URL +  ' #content-wrapper');

                }else{
                    console.log(response);
                    alert("error al subir archivo");
                }
            }
        });

    });
  </script>

</body>

</html>
