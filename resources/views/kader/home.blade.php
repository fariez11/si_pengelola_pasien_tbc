@extends('layout.kader')


@section('menu')
      <li class="nav-item active">
        <a class="nav-link" href="/kader">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/kdatpas">
          <i class="fas fa-fw fa-procedures"></i>
          <span>Data Pasien</span></a>
      </li>
@endsection
<?php
    
    $ipus = Session::get('ipus');
    $ka = Session::get('kader');
    $kader = DB::SELECT("select count(*) as kad from users a, kader b where a.id = b.id_user and b.id_puskesmas = '$ipus' and level = 'pendamping'");
    $pasien = DB::SELECT("select count(*) as pas from pasien where id_puskesmas = '$ipus'");
    $pasien2 = DB::SELECT("select count(*) as pas from pasien where id_kader = '$ka'");

?>

@section('content')
  <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Puskesmas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{Session::get('nampus')}}</div>
                      
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pendamping</div>
                      
                          <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($kader as $kad) {{$kad->kad}} Orang @endforeach</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pasien per Puskemas</div>
                    
                          <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($pasien as $pas) {{$pas->pas}} Pasien @endforeach</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pasien ditangani</div>
                    
                          <div class="h5 mb-0 font-weight-bold text-gray-800">@foreach($pasien2 as $pas) {{$pas->pas}} Pasien @endforeach</div>
                     
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-check fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                      

    </div>

    
     
  </div>



@endsection
