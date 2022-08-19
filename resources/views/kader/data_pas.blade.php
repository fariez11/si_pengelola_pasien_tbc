@extends('layout.kader')


@section('menu')
      <li class="nav-item">
        <a class="nav-link" href="/kader">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/kdatpas">
          <i class="fas fa-fw fa-procedures"></i>
          <span>Data Pasien</span></a>
      </li>
@endsection

  <?php
       $gen = array('Laki-laki','Perempuan');
       $tip = array('Berat','Sedang','Ringan');
  ?>
@section('content')
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
  </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
              <div class="row">
                <div class="col-md-2" style="margin-bottom: 10px;">
                    <!-- <a href="create_desa" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambah" ><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></a>
                </div> -->
                <div class="col-md-10">
                    <?php if(Session::get('adddata')){ ?>
                        <div class="alert" style="color: #155724;background-color: #d4edda;border-color: #c3e6cb;margin-bottom: 0px;">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                             Data telah disimpan !!! 
                        </div>
                    <?php }else if(Session::get('upddata')){ ?> 
                      <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px;">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                             Data telah diubah !!! 
                        </div>
                    <?php }else if(Session::get('deldata')){ ?> 
                      <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                             Data telah dihapus !!! 
                        </div>
                    <?php }else if(Session::get('error')){ ?> 
                      <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                            Username , Password dan Email telah digunakan !!!
                        </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>

            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama Pasien</th>
                  <th>Alamat</th>
                  <th>Tipe Pasien</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                  ?>
                @foreach($data as $dat)
                <tr>
                  <td style="width: 50px;text-align: center;">{{$no++}}</td>
                  <td>{{$dat->nama}}</td>
                  <td>{{$dat->jalan}}</td>
                  <td style="width: 110px;padding-top: 20px;">
                    <center>
                    <?php if($dat->tipe == 'Ringan'){?>
                      <a style="background-color: #ff6600;color: white;padding:7px;border-radius: 5px;">ringan</a>
                    <?php }else if($dat->tipe == 'Sedang'){?>
                      <a style="background-color: #ff3300;color: white;padding:7px;border-radius: 5px;">sedang</a>
                    <?php }else if($dat->tipe == 'Berat'){ ?>
                      <a style="background-color: #ff0000;color: white;padding:7px;border-radius: 5px;">berat</a>
                    <?php } ?>
                  </center>
                  </td>
                  <td style="width: 100px;">
                      <!-- <a class="btn btn-info" data-toggle="modal" data-target="#det{{$dat->idal}}" style="color: white;"><i class="fas fa-info-circle"></i></a> -->
                      <a href="/kad_pas:kk={{$dat->idpa}}" class="btn btn-info" style="color: white;"><i class="fas fa-address-card"></i></a>
                      <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$dat->idal}}" style="color: black;"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>

      @foreach($data as $edit)
      <div class="modal fade" id="edit{{$edit->idal}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content card border-left-warning shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Pasien</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <style type="text/css">
              td{
                padding: 5px;
              }
            </style>
            <?php
              $id = $edit->idal;
              $sql = DB::SELECT("select*, a.id_alamat as idal from pasien a, alamat b where a.id_alamat = b.id and a.id_alamat = b.id and a.id_alamat = '$id'");
            ?>
            @foreach($sql as $upd)
            <form action="/kad_pas:upd={{$upd->idal}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                     <table style="width: 100%;">
                        <tr>
                          <td>NAMA</td>
                          <td>:</td>
                          <td><input type="text" name="nama" class="form-control" value="{{$upd->nama}}" required="" autocomplete="off"></td>  
                        </tr>
                         <tr>  
                          <td>TGL LAHIR</td>
                          <td>:</td>
                          <td><input type="date" name="tgl" maxlength="16" class="form-control" value="{{$upd->tgl_lahir}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>GENDER</td>
                          <td>:</td>
                          <td>
                              <select name="gend" class="form-control">
                                @foreach($gen as $ge)
                                <?php if ($ge == $upd->jenis_kelamin){ ?>
                                   <option selected="">{{$ge}}</option>
                                <?php }else{ ?>
                                  <option>{{$ge}}</option>
                                <?php }?>
                                @endforeach
                              </select>    
                          </td>
                        </tr>
                        <tr>  
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="number" name="no" maxlength="16" class="form-control" value="{{$upd->telp}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>  
                          <td>TGL DAFTAR</td>
                          <td>:</td>
                          <td><input type="date" name="tgd" maxlength="16" class="form-control" value="{{$upd->tgl_daftar}}" required="" autocomplete="off"></td>
                        </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table style="width: 100%;">
                        <tr>
                          <td>TIPE PASIEN</td>
                          <td>:</td>
                          <td>
                              <select name="tipe" class="form-control">
                                  @foreach($tip as $ti)
                                <?php if ($ti == $upd->tipe_pasien){ ?>
                                   <option selected="">{{$ti}}</option>
                                <?php }else{ ?>
                                  <option>{{$ti}}</option>
                                <?php }?>
                                @endforeach
                              </select>    
                          </td>
                        </tr>
                        <tr>
                          <td>ALAMAT</td>
                          <td>:</td>
                          <td><input type="text" name="alam" class="form-control" value="{{$upd->jalan}}" required="" autocomplete="off"></td>
                        </tr>
                         <tr>
                          <td>RT / RW</td>
                          <td>:</td>
                          <td>
                              <input type="number" name="rt" class="form-control" value="{{$upd->RT}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                              <input type="number" name="rw" class="form-control" value="{{$upd->RW}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                          </td>
                        </tr>
                        <tr>
                          <td>KECAMATAN</td>
                          <td>:</td>
                          <td><input type="text" name="kec" class="form-control"  value="{{$upd->kecamatan}}" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>DESA</td>
                          <td>:</td>
                          <td><input type="text" name="desa" class="form-control"  value="{{$upd->desa}}" autocomplete="off"></td>
                        </tr>
                    </table>
                  </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="fas fa-check-circle"></i> Simpan</button>
            </div>
            </form>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach 

      

</div>
@endsection

   