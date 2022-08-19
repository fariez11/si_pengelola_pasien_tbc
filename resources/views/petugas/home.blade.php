@extends('layout.petugas')


@section('menu')
      <li class="nav-item active">
        <a class="nav-link" href="/petugas">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pdatpas">
          <i class="fas fa-fw fa-procedures"></i>
          <span>Data Pasien</span></a>
      </li>
@endsection

  <?php

    $ipus = Session::get('ipus');
    $pasien = DB::SELECT("select count(*) as pas from pasien where id_puskesmas = '$ipus'");
  
  ?>

@section('content')

        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Puskesmas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{Session::get('nampus')}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clinic-medical fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pasien</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($pasien as $pas) {{$pas->pas}} Pasien @endforeach</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-procedures fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           <!--  <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Desa</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-map-signs fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kader</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          
         <!--     <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ANGKA BEBAS JENTIK</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-success">80%</div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
                    
          </div>


  </div>


@endsection 