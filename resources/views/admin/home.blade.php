@extends('layout.admin')


@section('menu')
      <li class="nav-item active">
        <a class="nav-link" href="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/adatpusk">
          <i class="fas fa-fw fa-clinic-medical"></i>
          <span>Data Puskesmas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/adatuser">
          <i class="fas fa-fw fa-users"></i>
          <span>Data User</span></a>
      </li>
      
@endsection

  <?php
      $pusk = DB::SELECT("select count(*) as pus from puskesmas");
      $jpet = DB::SELECT("select count(*) as pet from users where level = 'petugas'");
      $jkad = DB::SELECT("select count(*) as kad from users where level = 'pendamping'");

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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Puskesmas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> @foreach($pusk as $pus) {{$pus->pus}} Puskesmas @endforeach
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clinic-medical fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Petugas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($jpet as $pet) {{$pet->pet}} Petugas @endforeach</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-map-signs fa-3x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pendamping</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($jkad as $kad) {{$kad->kad}} Pendamping @endforeach</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
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