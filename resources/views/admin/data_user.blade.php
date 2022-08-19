@extends('layout.admin')


@section('menu')
    <li class="nav-item">
      <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="/adatpusk">
        <i class="fas fa-fw fa-clinic-medical"></i>
        <span>Data Puskesmas</span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/adatuser">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Pengguna</span></a>
    </li>

@endsection

    <?php
      $gen = array('Laki-laki','Perempuan');

      $lev = array('petugas','pendamping');

    ?>

@section('content')
      <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
        </div>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                  <div class="col-md-2">
                      <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambah" ><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></button>
                  </div>
                  <div class="col-md-10">
                       <?php if(Session::get('adduser')){ ?>
                              <div class="alert" style="color: #155724;background-color: #d4edda;border-color: #c3e6cb;margin-bottom: 0px;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                   Data telah disimpan !!!
                              </div>
                          <?php }else if(Session::get('upduser')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                   Data telah diubah !!!
                              </div>
                          <?php }else if(Session::get('deluser')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                   Data telah dihapus !!!
                              </div>
                          <?php }else if(Session::get('error')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                                  Nama telah digunakan !!!
                              </div>
                          <?php } ?>
                  </div>
              </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <!-- <th>Tgl_lahir</th> -->
                      <th>Puskesmas</th>
                      <th>Level</th>
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
                      <td>{{$dat->name}}</td>
                      <td>{{$dat->username}}</td>
                      <!-- <td>{{$dat->tgl_lahir}}</td> -->
                      <td>{{$dat->puskesmas}}</td>
                      <td>{{$dat->level}}</td>
                      <td style="width: 135px;">
                          <a class="btn btn-info" data-toggle="modal" data-target="#info{{$dat->idal}}" style="color: white;"><i class="fas fa-info-circle"></i></a>
                          <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$dat->idal}}" style="color: black;"><i class="fas fa-edit"></i></a>
                          <a href="/adm_user:del={{$dat->idal}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
               </div>
            </div>
        </div>


      <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-xl">
          <div class="modal-content card border-left-success shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Petugas</h4>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <style type="text/css">
              td{
                padding: 5px;
              }
            </style>
            <form action="{{url('/adm_add_user')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <div class="row">
                   <div class="col-md-2">
                      <center>
                        FOTO<br>
                       <img id="image-preview" style="width: 140px; height: 140px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 100px;"><br>
                        <input type="file" name="foto" class="form-control" id="image-source" onchange="previewImage();" style="width: 180px;" autocomplete="off"><br><br>
                      </center>
                  </div>
                  <div class="col-md-5">
                    <?php if($data == null){ ?>
                     <input type="hidden" name="idu" value="1" readonly="">
                    <?php }else{?>
                      @foreach($idp as $id)
                          <input type="hidden" name="idu" value="{{$id->id+1}}" readonly="">
                      @endforeach
                    <?php } ?>
                    <table style="width: 100%;">
                        <tr>
                          <td>LEVEL</td>
                          <td>:</td>
                          <td style="width: 245px;">
                            <select class="form-control" name="sta">
                                <option></option>
                                @foreach($lev as $lev)
                                <option>{{$lev}}</option>
                                @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>PUSKESMAS</td>
                          <td>:</td>
                          <td style="width: 245px;">
                            <select class="form-control" name="pus">
                                <option></option>
                                @foreach($pus as $pus)
                                <option value="{{$pus->id}}">{{$pus->nama}}</option>
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
                          <td>EMAIL</td>
                          <td>:</td>
                          <td><input type="email" name="email" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>USERNAME</td>
                          <td style="width: 16px;">:</td>
                          <td style="width: 245px;"><input type="text" name="user" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>PASSWORD</td>
                          <td>:</td>
                          <td><input type="text" name="pass" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                    </table>
                  </div>
                  <div class="col-md-5">
                    <table style="width: 100%;">
                        <tr>
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="text" name="no" maxlength="16" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>TGL LAHIR</td>
                          <td>:</td>
                          <td><input type="date" name="tgl" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>PEKERJAAN</td>
                          <td>:</td>
                          <td><input type="text" name="pek" class="form-control" required="" autocomplete="off"></td>
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
                          <td>KEC / DESA</td>
                          <td>:</td>
                          <td>
                            <input type="text" name="kec" class="form-control" placeholder="kecamatan" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                            <input type="text" name="desa" class="form-control" placeholder="desa" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                        </tr>
                    </table>
                  </div>
              </div>
            </div>

            <div class="modal-footer justify-content-between">
              <a href="/adatuser" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batal</a>
              <button class="btn btn-primary"><i class="fas fa-check-circle"></i> Simpan</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      @foreach($data as $id)
      <div class="modal fade" id="info{{$id->idal}}">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-info shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Info {{$id->name}}</h4>
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
                $id = $id->idal;
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
                        <td>{{$tad->tgl_lahir}}</td>
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
                        <td>{{$tad->tgl_masuk}}</td>
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
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    @foreach($data as $edit)
    <div class="modal fade" id="edit{{$edit->idal}}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content card border-left-edit shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Petugas</h4>
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
              $sql = DB::SELECT("select*,a.id as us, c.id as idal, d.nama as puskesmas, b.telp as telp ,b.foto from users a, kader b , alamat c, puskesmas d where a.id = b.id_user and b.id_alamat = c.id and b.id_puskesmas = d.id and c.id = '$id' ");
            ?>
            @foreach($sql as $upd)
            <form action="/adm_user:upd={{$upd->idal}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

            <div class="modal-body">
                <div class="row">
                   <div class="col-md-2">
                      <center style="padding-top: 10px;">
                        FOTO<br>
                       <img  src="assets/profil/{{$upd->foto}}" width="140" height="140" style="border:1px solid grey;border-radius: 100px;"><br>
                        <input type="file" name="foto" class="form-control" style="width: 180px;margin-top: 10px;"autocomplete="off"><br><br>
                      </center>
                  </div>
                  <div class="col-md-5">
                    <table style="width: 100%;">
                        <tr>
                          <td>PUSKESMAS</td>
                          <td>:</td>
                          <td style="width: 245px;">
                            <input type="hidden" name="idu" value="{{$upd->us}}">
                            <select class="form-control" name="pus">
                                <?php $pus = DB::SELECT("select*from puskesmas");?>
                                @foreach($pus as $pus)
                                <?php if ($pus->id == $upd->id){ ?>
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
                          <td><input type="text" name="nama" class="form-control" value="{{$upd->name}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>EMAIL</td>
                          <td>:</td>
                          <td><input type="email" name="email" class="form-control" value="{{$upd->email}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>USERNAME</td>
                          <td style="width: 16px;">:</td>
                          <td style="width: 245px;"><input type="text" name="user" value="{{$upd->username}}" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>PASSWORD</td>
                          <td>:</td>
                          <td><input type="text" name="pass" class="form-control" value="{{$upd->password}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="number" name="no" maxlength="16" value="{{$upd->telp}}" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                    </table>
                  </div>
                  <div class="col-md-5">
                    <table style="width: 100%;">
                        <tr>
                          <td>TGL LAHIR</td>
                          <td>:</td>
                          <td><input type="date" name="tgl" maxlength="16" value="{{$upd->tgl_lahir}}" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>PEKERJAAN</td>
                          <td>:</td>
                          <td><input type="text" name="pek" maxlength="16" value="{{$upd->pekerjaan}}" class="form-control" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>ALAMAT</td>
                          <td>:</td>
                          <td><input type="text" name="alam" class="form-control"  value="{{$upd->jalan}}" required="" autocomplete="off"></td>
                        </tr>
                         <tr>
                          <td>RT / RW</td>
                          <td>:</td>
                          <td>
                              <input type="number" name="rt" class="form-control" placeholder="RT" value="{{$upd->RT}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                              <input type="number" name="rw" class="form-control" placeholder="RW" value="{{$upd->RW}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
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
                          <td><input type="text" name="desa" class="form-control" value="{{$upd->desa}}" autocomplete="off"></td>
                        </tr>
                    </table>
                  </div>
              </div>
            </div>

            <div class="modal-footer justify-content-between">
              <a href="/adatuser" class="btn btn-danger" ><i class="fas fa-times-circle"></i> Batal</a>
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
