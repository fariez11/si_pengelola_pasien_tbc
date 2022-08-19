@extends('layout.petugas')


@section('menu')
      <li class="nav-item">
        <a class="nav-link" href="/petugas">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/pdatpas">
          <i class="fas fa-fw fa-procedures"></i>
          <span>Data Pasien</span></a>
      </li>
@endsection

  <?php
       $gen = array('Laki-laki','Perempuan');
       $tip = array('Berat','Sedang','Ringan');
       $sta = array('Aktif','Tidak Aktif');
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
                <a href="create_desa" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambah" ><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></a>
            </div>
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

      <div class="card-body">
          <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Tipe Pasien</th>
              <th>Pendamping</th>
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
                    <?php if($dat->tipe_pasien == 'Ringan'){?>
                      <a style="background-color: #ff6600;color: white;padding:7px;border-radius: 5px;">ringan</a>
                    <?php }else if($dat->tipe_pasien == 'Sedang'){?>
                      <a style="background-color: #ff3300;color: white;padding:7px;border-radius: 5px;">sedang</a>
                    <?php }else if($dat->tipe_pasien  == 'Berat'){ ?>
                      <a style="background-color: #ff0000;color: white;padding:7px;border-radius: 5px;">berat</a>
                    <?php } ?>
                  </center>
              </td>
              <td>{{$dat->name}}</td>
              <td style="width: 140px;">
                  <!-- <a class="btn btn-info" data-toggle="modal" data-target="#det{{$dat->idal}}" style="color: white;"><i class="fas fa-info-circle"></i></a> -->
                  <a href="/pet_pas:kk={{$dat->idpa}}" class="btn btn-info" style="color: white;"><i class="fas fa-address-card"></i></a>
                  <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$dat->idal}}" style="color: black;"><i class="fas fa-edit"></i></a>
                  <a href="/pet_pas:del={{$dat->idal}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>

  <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content card border-left-success shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Pasien</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <style type="text/css">
              td{
                padding: 5px;
              }
            </style>
            <form action="{{url('/pet_add_pas')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <?php if($pas == null){ ?>
                        <input type="hidden" name="idp" value="1" readonly="">
                <?php }else{?>
                  @foreach($idp as $id) 
                      <input type="hidden" name="idp" value="{{$id->id+1}}" readonly="">
                  @endforeach
                <?php } ?>
                <div class="row">
                  <div class="col-md-6">
                     <table style="width: 100%;">
                        <input type="hidden" name="pus" class="form-control" value="{{Session::get('ipus')}}" readonly="">
                        <tr>
                          <td>KADER</td>
                          <td>:</td>
                          <td style="width: 245px;">
                            <?php 
                                $ip = Session::get('ipus');
                                $kader = DB::SELECT("select*from kader a, users b where a.id_user = b.id and id_puskesmas = '$ip' and b.level ='pendamping'");
                            ?>
                            <select class="form-control" name="idk">
                                <option></option>
                                @foreach($kader as $kad)
                                <option value="{{$kad->id}}">{{$kad->name}}</option>
                                @endforeach                              
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>NAMA</td>
                          <td>:</td>
                          <td><input type="text" name="nama" class="form-control" required="" autocomplete="off"></td>  
                        </tr>
                         <tr>  
                          <td>TGL LAHIR</td>
                          <td>:</td>
                          <td><input type="date" name="tgl" maxlength="16" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>GENDER</td>
                          <td>:</td>
                          <td>
                              <select name="gend" class="form-control">
                                <option></option>
                                @foreach($gen as $ge)
                                <option>{{$ge}}</option>
                                @endforeach
                              </select>    
                          </td>
                        </tr>
                        <tr>  
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="number" name="no" maxlength="16" class="form-control" required="" autocomplete="off"></td>
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
                                <option></option>
                                @foreach($tip as $ti)
                                <option>{{$ti}}</option>
                                @endforeach
                              </select>    
                          </td>
                        </tr>
                        <?php if($alam == null){ ?>
                            <input type="hidden" name="ida" value="1" readonly="">
                        <?php }else{?>
                          @foreach($ida as $id)
                              <input type="hidden" name="ida" value="{{$id->id+1}}" readonly="">
                          @endforeach
                        <?php } ?>
                        <tr>
                          <td>ALAMAT</td>
                          <td>:</td>
                          <td><input type="text" name="alam" class="form-control"  required="" autocomplete="off"></td>
                        </tr>
                         <tr>
                          <td>RT / RW</td>
                          <td>:</td>
                          <td>
                              <input type="number" name="rt" class="form-control" placeholder="RT" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                              <input type="number" name="rw" class="form-control" placeholder="RW" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                          </td>
                        </tr>
                        <tr>
                          <td>KECAMATAN</td>
                          <td>:</td>
                          <td><input type="text" name="kec" class="form-control"  autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>DESA</td>
                          <td>:</td>
                          <td><input type="text" name="desa" class="form-control"  autocomplete="off"></td>
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
            <form action="/pet_pas:upd={{$upd->idal}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                     <table style="width: 100%;">
                        <tr>
                          <td>PUSKESMAS</td>
                          <td>:</td>
                          <td style="width: 245px;">
                           <select class="form-control" name="pus">
                                <?php $pus = DB::SELECT("select*from puskesmas");?>
                                @foreach($pus as $pus)
                                <?php if ($pus->id == $upd->id_puskesmas){ ?>
                                   <option value="{{$pus->id}}" selected="">{{$pus->nama}}</option>
                                <?php }else{ ?>
                                  <option value="{{$pus->id}}">{{$pus->nama}}</option>
                                <?php }?>
                                @endforeach
                            </select>
                          </td>
                        </tr>
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
                        <tr>
                          <td>STATUS PASIEN</td>
                          <td>:</td>
                          <td>
                              <select name="stat" class="form-control">
                                  @foreach($sta as $st)
                                <?php if ($st == $upd->status){ ?>
                                   <option selected="">{{$st}}</option>
                                <?php }else{ ?>
                                  <option>{{$st}}</option>
                                <?php }?>
                                @endforeach
                              </select>    
                          </td>
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

    @foreach($data as $det)
    <div class="modal fade" id="det{{$det->idal}}">
      <div class="modal-dialog modal-md">
        <div class="modal-content card border-left-info shadow" style="border-radius: 10px;">
          <div class="modal-header">
            <h4 class="modal-title">Detail Data Pasien</h4>
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
            $id = $det->idal;
            $sql = DB::SELECT("select*,a.telp as no, a.id_alamat as idal, c.nama as nampus from pasien a, alamat b, puskesmas c where a.id_alamat = b.id and a.id_alamat = b.id and c.id = a.id_puskesmas and a.id_alamat = '$id'");
          ?>
          @foreach($sql as $de)
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <center>
                  <img src="assets/profil/pasien.png" style="width:85%;border-radius: 10px;">
                </center> 
              </div>
              <div class="col-md-8">
                 <table style="width: 100%;">
                    <tr>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td><?= date('d M Y',strtotime($de->tgl_lahir)); ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td>{{$de->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>No Telp</td>
                        <td>:</td>
                        <td>{{$de->no}}</td>
                    </tr>
                    <tr>
                        <td>Puskesmas</td>
                        <td>:</td>
                        <td>{{$de->nampus}}</td>
                    </tr>
                    <tr>
                        <td>Tgl Daftar</td>
                        <td>:</td>
                        <td><?= date('d M Y',strtotime($de->tgl_daftar)); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{$de->status}}</td>
                    </tr> 
                    <tr>
                        <td>Tipe Pasien</td>
                        <td>:</td>
                        <td>{{$de->tipe_pasien}}</td>
                    </tr>                       
                </table>
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</button>
          </div>
          @endforeach
        </div>
      </div>
      </div>
      @endforeach

</div>
@endsection

   