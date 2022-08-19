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
       $ceko = array('minum','tidak minum');
       $cekd = array('kental','encer','tidak ada');
       $tip = array('Berat','Sedang','Ringan');
  ?>
@section('content')
    <div class="container-fluid">

      <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kartu Kontrol</h1>
      </div> -->

      <div class="row">


          @foreach($sql as $pas)
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div class="row">
                    <div class="col-md-10">
                      <h5 class="m-0 font-weight-bold"><i class="fas fa-user" style="margin-top: 8px;"></i> Detail {{ucfirst($pas->napas)}}</h5>
                    </div>
                    <div class="col-md-2">
                      <a href="/pdatpas" type="button" class="btn btn-secondary btn-md" style="float: right;"><i style="font-size:14px;" class="fas fa-chevron-circle-left"><span style="font-family: segoe UI;font-size: 10px;font-weight: normal;"></span></i></a>
                    </div>
                 </div>
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
                                <a style="background-color: #2fe04c;color: white;padding:5px;border-radius: 5px;"><i class="fa fa-check-circle"></i> aktif</a>
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
                  <div class="col-md-7">
                      <h5 class="font-weight-bold" style="padding-top: 10px;"><i class="fas fa-notes-medical"></i> Kartu Kontrol</h5>
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
                      <th>Keterangan</th>
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
                      <td>{{$dat->keterangan}}</td>
                      <td style="width: 115px;">
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

  </div>
@endsection
