<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/back/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- <link href="assets/back/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

</head>

<body class="bg-gradient-success">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9" style="margin-top: 40px;">

        <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 20px;">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sistem Informasi Pengelola Penderita TBC</h1>
                    <img src="assets/img/LOGO KOTA KEDIRI.png" style="width: 80px;margin-right: 30px;">
                    <img src="assets/img/dinkes.png" style="width: 80px;">
                    <br>
                    <div class="col-md-16" style="margin:10px 0px 10px 0px;">
                       <?php if(Session::get('errlog')){ ?>
                              <div class="alert" style="color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;margin-bottom: 0px;border-radius: 20px;font-size: 16px;text-align: left;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                   Silahkan login terlebih dahulu !!!
                              </div>
                          <?php }else if(Session::get('gagal')){ ?>
                              <div class="alert" style="color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;margin-bottom: 0px;border-radius: 20px;font-size: 16px;text-align: left;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                   Username dan Password tidak cocok !!!
                              </div>
                          <?php }else if(Session::get('error')){ ?> 
                            <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;border-radius:20px;font-size: 16px;text-align: left;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                  Akun anda belum terverifikasi !!!
                              </div>
                          <?php } ?>
                    </div>                  
                  </div>
                  <form class="user" action="/actlog" method="get">
                    <div class="form-group">
                      <input type="text" name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button class="btn btn-success btn-user btn-block">Login</button>
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                  <!-- <div class="text-center">
                    Belum punya akun ? <a class="small" href="/registrasi">Daftar disini</a>
                    <br>
                    <a class="small" href="#" data-toggle="modal" data-target="#logoutModal" >belum terverifikasi ?</a>
                  </div> -->
                </div>
              </div>
              <div class="col-lg-6 d-none d-lg-block" style="background-image: url(assets/img/alun.png);background-size: 100% 100%;"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Perhatikan !!!</h5>
          <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button> -->
        </div>
        <div class="modal-body" style="text-align: center;">
            Dimohon Untuk menghubungi petugas puskesmas terdekat.<br>
            Terima Kasih.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
          <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
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
  <!-- <script src="assets/back/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

</body>

</html>
