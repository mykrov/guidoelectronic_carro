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
  <link href="{{asset('assets/admin/css/sb-admin.css')}}" rel="stylesheet">

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
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
        <div>
                <h5>Bienvenido: {{\Session::get('administrator')}}</h5>
        </div>
         <!-- Page Content -->
        <div class="row">
            
            <div class="col-md-8" id="table-div">
                <table class="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Sección</th>
                            <th>Imagen</th>
                            <th>Carpeta</th>
                            <th>Tamaño</th>
                            <th>Vista Previa</th>
                                                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imagenes as $item)
                            <tr>
                                <td class="nase">{{$item->nombre_seccion}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->directorio}}</td>
                                <td>{{$item->size}}</td>
                                <td  style="background-color:#000; min-width:30%    " class="text-center"><img class="img img-fluid" src="{{asset('assets/themebasic/images/'.$item->directorio.'/'.$item->nombre)}}" alt=""></td>
                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                    <form class="form-horizontal" id="form-img">
                       
                        <div class="form-group">
                            <label class="control-label"><h4>Sección a cambiar</h4></label>
                            <div >
                                <select class="form-control" name="seccion" id="seccion">
                                    @foreach ($imagenes as $item2)
                                        <option value="{{$item2->nombre_seccion}}">{{$item2->nombre_seccion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Seleccionar Imagen</label>
                            <input type="file" name="imagen" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        
                        <div class="form-group" style="margin-top:3rem">
                           <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Enviar">
                        </div>
                    </form>
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


    $(document).on('submit','#form-img',function(e){
        
        e.preventDefault();
        $("#upload").prop('disabled',true);

        
        $.ajax({
            type: "POST",
            url: "{{route('file-upload')}}",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                if(response == "exito"){
                    $("#upload").prop('disabled',false);
                    $("#content-wrapper").load(document.URL +  ' #content-wrapper');

                }else{
                    alert("error al subir archivo");
                }
            }
        });

    });
  </script>

</body>

</html>
