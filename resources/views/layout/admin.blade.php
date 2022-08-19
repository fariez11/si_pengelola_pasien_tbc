<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="assets/back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="assets/back/css/sb-admin-2.min.css" rel="stylesheet">

  <link href="assets/back/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar">


      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SI PENGELOLA PENDERITA TBC <!-- <sup>2</sup --></div>
      </a>

      <hr class="sidebar-divider my-0">


      @yield('menu')
      <br>
     

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Session::get('nama')}}</span>
                <img class="img-profile rounded-circle" src="assets/profil/{{Session::get('fp')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#info{{Session::get('idal')}}" style="cursor: pointer;">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
               <!--  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        


      @yield('content')




        </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Fariez Ilham A & Khoirul Badarudin 2020</span>
          </div>
        </div>
      </footer>


    </div>


  </div>



  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


   
    <div class="modal fade" id="info{{Session::get('idal')}}">
      <div class="modal-dialog modal-md">
        <div class="modal-content card border-left-info shadow" style="border-radius: 10px;">
          <div class="modal-header">
            <h4 class="modal-title">Info {{Session::get('nama')}}</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
          </div>  
          <div class="modal-body">
            <style type="text/css">
              td{
                padding: 5px;
              }
            </style>
            <?php
              $id = Session::get('idal');
              $query = DB::SELECT("select*from users a, kader b, alamat c where a.id = b.id_user and b.id_alamat = c.id and c.id ='$id'");
            ?>
            @foreach($query as $tad)
            <div class="row">
              <div class="col-md-4">
                <center>
                  <img src="assets/profil/{{$tad->foto}}" width="120" height="120" style="border:1px solid grey;border-radius: 100px;">
                </center>
                <br>
              </div>
              <div class="col-md-8">
                <table align="center">
                    <tr>
                      <td>TGL LAHIR</td>
                      <td>:</td>
                      <td><?= date('d M Y',strtotime($tad->tgl_lahir)); ?></td>
                    </tr>
                    <tr>
                      <td>EMAIL</td>
                      <td>:</td>
                      <td>{{$tad->email}}</td>
                    </tr>
                    <tr>
                      <td>PASSWORD</td>
                      <td>:</td>
                      <td>{{$tad->password}}</td>
                    </tr>
                    <tr>
                      <td>NO TELP</td>
                      <td>:</td>
                      <td>{{$tad->telp}}</td>
                    </tr>
                    <tr>
                      <td>PEKERJAAN</td>
                      <td>:</td>
                      <td>{{$tad->pekerjaan}}</td>
                    </tr>
                    <tr>
                      <td>TGL MASUK</td>
                      <td>:</td>
                      <td><?= date('d M Y',strtotime($tad->tgl_masuk)); ?></td>
                    </tr>
                    <tr>
                      <td>ALAMAT</td>
                      <td>:</td>
                      <td>{{$tad->jalan}}</td>
                    </tr>
                    <tr>
                      <td>RT / RW</td>
                      <td>:</td>
                      <td>{{$tad->RT}} / {{$tad->RW}}</td>
                    </tr>
                </table>
              </div>
            </div>
            @endforeach
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Penting !!!</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda Yakin ingin keluar ?</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
          <a class="btn btn-primary" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/back/vendor/jquery/jquery.min.js"></script>
  <script src="assets/back/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/back/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/back/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/back/vendor/chart.js/Chart.min.js"></script>

   <!-- Page level plugins -->
  <script src="assets/back/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/back/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/back/js/demo/datatables-demo.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <!-- <script type="text/javascript" src="assets/back/js/jquery-1.4.2.min.js"></script> -->
  <script type="text/javascript" src="assets/back/js/polygon.min.js"></script>

  <script type="text/javascript">
    function previewImage() {
    document.getElementById("image-preview").style.display = "inline";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
  
    $(document).ready(function() {
        $('#select2').select2();
    });

    $(document).ready(function() {
        $('#select3').select2();
    });

   $(function() {
    $('#wila').hide(); 
    $('#wilk').hide(); 
    $('#level').change(function(){
        if($('#level').val() == 'admin') {
            $('#wila').show(); 
            $('#wilk').hide(); 
        } else if($('#level').val() == 'kader') { 
            $('#wila').hide(); 
            $('#wilk').show(); 
        } 
      });
    });

  $(document).ready(function() {
    $("#nmap").click(function() {
      $("#tmap").toggle();
    });
  });

  </script>
</body>

</html>
