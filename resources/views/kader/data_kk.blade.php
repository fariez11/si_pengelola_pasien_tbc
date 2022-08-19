@extends('layout.kader')


@section('menu')
      <li class="nav-item">
        <a class="nav-link" href="/kader">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/kdatadata">
          <i class="fas fa-fw fa-procedures"></i>
          <span>Data Pasien</span></a>
      </li>
@endsection

  <?php
       $gen = array('Laki-laki','Perempuan');
       $ceko = array('minum','tidak minum');
       $cekd = array('kental','encer','tidak ada');
       $tip = array('Berat','Sedang','Ringan');
  ?>
@section('content')
    <div class="container-fluid">

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kartu Kontrol</h1>
      </div>

      <div class="row">

        @foreach($data as $past)
        <?php
            $id = $past->id_pasien;
            $sql = DB::SELECT("select*,a.telp, a.id_alamat as idal,a.nama as napas from pasien a, alamat b where a.id_alamat = b.id and a.id = '$id'");
        ?>
        @endforeach
          @foreach($sql as $pas)
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold"><i class="fas fa-user"></i> Detail {{ucfirst($pas->napas)}} </h5>
                </div>
                <div class="card-body">
                  <div class="row" style="text-align: center;">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                    <!--   <h5 class="description-header font-weight-bold" style="color: black;">TGL LAHIR</h5>
                      <span class="description-text">{{$pas->tgl_lahir}}</span> -->
                      <center>
                        <img src="assets/profil/pasien.png" style="width:85%;border-radius: 10px;">
                      </center>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="description-block" style="text-align: left;margin-top: 10px;">
                      <!-- <h5 class="description-header font-weight-bold">STATUS</h5> -->
                      <table >
                        <h6>
                        <tr>
                          <td>Daftar</td>
                          <td style="padding: 0px 5px 0px 5px;">:</td>
                          <td> <?= date('d M Y',strtotime($pas->tgl_daftar)); ?></td>
                        </tr>
                        <tr>
                          <td>Status </td>
                          <td style="padding: 0px 5px 0px 5px;">:</td>
                          <td>
                            <?php if($pas->status == 'Aktif'){?>
                                <a style="background-color: #2fe04c;color: white;padding:7px;border-radius: 5px;"><i class="fa fa-check-circle"></i> aktif</a>
                            <?php  }else{ ?>
                                <a style="background-color: #e03b2f;color: white;padding:7px;border-radius: 5px;"><i class="fa fa-times-circle"></i> tidak aktif</a>
                            <?php } ?>
                          </td>
                        </tr>
                        </h6>
                      </table>
                    </div>
                  </div>
                </div>
                  <hr>
                  <style type="text/css">
                    .det tr td{
                      padding: 5px;
                    }
                  </style>
                  <table class="det" style="width: 100%;">
                        <tr>
                            <td>Tgl Lahir</td>
                            <td>:</td>
                            <td>{{$pas->tgl_lahir}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td>{{$pas->jenis_kelamin}}</td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td>:</td>
                            <td>{{$pas->telp}}</td>
                        </tr>
                        <tr>
                            <td>Tipe Pasien</td>
                            <td>:</td>
                            <td>{{$pas->tipe_pasien}}</td>
                        </tr>
                        <tr>
                            <td>RT / RW</td>
                            <td>:</td>
                            <td>{{$pas->RT}} / {{$pas->RW}}</td>
                        </tr>
                        <tr>
                            <td>Desa</td>
                            <td>:</td>
                            <td>{{$pas->desa}}</td>
                        </tr>
                        <tr>
                            <td>Kec</td>
                            <td>:</td>
                            <td>{{$pas->kecamatan}}</td>
                        </tr>
                    </table>
                </div>
              </div>
            </div>
          @endforeach

        <div class="col-xl-8 col-lg-7">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                  <div class="col-md-5">
                     <a href="/kdatpas" type="button" class="btn btn-secondary btn-lg"><i style="font-size:16px;" class="fas fa-chevron-circle-left"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"></span></i></a>
                      <?php
                        $sta = DB::SELECT("select*from pasien where id = '$id'");
                        foreach ($sta as $key ) {
                          if($key->status == 'Aktif'){
                        ?>
                          <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambah" ><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></a>
                        <?php
                          }else{
                        ?>
                          <a href="#" class="btn btn-secondary btn-lg"><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></a>
                        <?php
                          }
                        }
                      ?>
                  </div>
                  <div class="col-md-7">
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
                              tanggal telah digunakan!!!
                          </div>
                      <?php } ?>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <!-- <th>Id</th> -->
                    <th>Tanggal</th>
                    <th>Cek Obat</th>
                    <th>Cek Dahak</th>
                    <!-- <th>Keterangan</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                    ?>
                  @foreach($data as $dat)
                  <tr>
                    <!-- <td style="width: 50px;text-align: center;">{{$no++}}</td> -->
                    <td style="width: 130px;"><?= date('d M Y',strtotime($dat->tanggal)); ?></td>
                    <td style="width: 95px;">{{$dat->cek_obat}}</td>
                    <td style="width: 110px;">{{$dat->cek_dahak}}</td>
                    <!-- <td>{{$dat->keterangan}}</td> -->
                    <td style="width: 160px;">
                        <a class="btn btn-info" data-toggle="modal" data-target="#gambar{{$dat->id}}" style="color: white;"><i class="fas fa-image"></i></a>
                        <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$dat->id}}" style="color: black;"><i class="fas fa-edit"></i></a>
                        <a href="/kad_kk:del={{$dat->id}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>

        </div>
      </div>



      <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-success shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Kontrol</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <style type="text/css">
              td{
                padding: 5px;
              }
            </style>
            <form action="{{url('/kad_add_kk')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <?php if($data == null){ ?>
                        <input type="hidden" name="idk" value="1" readonly="">
                <?php }else{?>
                  @foreach($idk as $id)
                      <input type="hidden" name="idk" value="{{$id->id+1}}" readonly="">
                  @endforeach
                <?php } ?>

                  @foreach($data as $past)
                    <?php
                        $ip = $past->id_pasien;
                    ?>
                  @endforeach
                  <input type="hidden" name="idp" value="{{$ip}}">
                     <table style="width: 100%;">
                        <tr>
                          <td>TGL KUNJUNGAN</td>
                          <td>:</td>
                          <td><input type="date" name="tgl" maxlength="16" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>CEK OBAT</td>
                          <td>:</td>
                          <td>
                              <select name="obat" class="form-control">
                                <option></option>
                                @foreach($ceko as $obat)
                                  <option>{{$obat}}</option>
                                @endforeach
                              </select>
                          </td>
                        </tr>
                        <tr>
                          <td>CEK OBAT</td>
                          <td>:</td>
                          <td>
                              <select name="dahak" class="form-control">
                                <option></option>
                                @foreach($cekd as $dahak)
                                  <option>{{$dahak}}</option>
                                @endforeach
                              </select>
                          </td>
                        </tr>
                        <tr>
                          <td>KETERANGAN</td>
                          <td>:</td>
                          <td><textarea  name="ket" class="form-control" autocomplete="off" style="height:100px;resize: none;"></textarea></td>
                        </tr>
                        <tr>
                          <td>FOTO</td>
                          <td>:</td>
                          <td>
                            <img id="image-preview2" style="width: 290px; height: 140px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 10px;"><br>
                            <input type="file" name="foto" class="form-control" id="image-source2" onchange="previewImage();" style="width: 290px;padding-bottom:-10px;" autocomplete="off">
                         </td>
                        </tr>
                    </table>
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
      <div class="modal fade" id="edit{{$edit->id}}">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-warning shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Kontrol</h4>
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
              $eid = $edit->id;
              $sql = DB::SELECT("select*, cek_dahak as dahak from kartu_kontrol where id = '$eid'");
            ?>
            @foreach($sql as $upd)
            <form action="/kad_kk:upd={{$upd->id}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="modal-body">
                 <table style="width: 100%;">
                    <tr>
                      <td>TGL KUNJUNGAN</td>
                      <td>:</td>
                      <td><input type="date" name="tgl" maxlength="16" class="form-control" value="{{$upd->tanggal}}" required="" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <td>CEK OBAT</td>
                      <td>:</td>
                      <td>
                          <select name="obat" class="form-control">
                            @foreach($ceko as $ob)
                            <?php if ($ob == $upd->cek_obat){ ?>
                               <option selected="">{{$ob}}</option>
                            <?php }else{ ?>
                              <option>{{$ob}}</option>
                            <?php }?>
                            @endforeach
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td>CEK DAHAK</td>
                      <td>:</td>
                      <td>
                          <select name="dahak" class="form-control">
                           @foreach($cekd as $da)
                            <?php if ($da == $upd->dahak){ ?>
                               <option selected="">{{$da}}</option>
                            <?php }else{ ?>
                              <option>{{$da}}</option>
                            <?php }?>
                            @endforeach
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td>KET</td>
                      <td>:</td>
                      <td><textarea  name="ket" class="form-control" autocomplete="off" style="height:100px;resize: none;">{{$upd->keterangan}}</textarea></td>
                    </tr>
                </table>
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


      @foreach($data as $gam)
      <div class="modal fade" id="gambar{{$gam->id}}">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-warning shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Detail Data Kontrol</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <?php
              $eid = $gam->id;
              $sql = DB::SELECT("select*, cek_dahak as dahak from kartu_kontrol where id = '$eid'");
            ?> 
            @foreach($sql as $upd) 
              {{csrf_field()}}
              <div class="modal-body">
                 <center>
                     <img src="assets/kk/{{$upd->foto}}" style="width:75%;border-radius: 10px;">
                     <br>
                     <br>
                     <table style="width: 100%;">
                        <tr>
                          <td style="text-align:center;">KET</td>
                        </tr>
                        <tr>
                          <td>
                              @if($upd->keterangan == null)
                              -
                              @else
                              {{$upd->keterangan}}
                              @endif
                          </td>
                        </tr>
                    </table>
                </center>
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
