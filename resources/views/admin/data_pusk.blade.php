@extends('layout.admin')


@section('menu')
   <li class="nav-item">
      <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item active">
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

@section('content')

      <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Data Puskesmas</h1>
        </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambah" ><i style="font-size:16px;" class="fas fa-plus-circle"><span style="font-family: segoe UI;font-size: 16px;font-weight: normal;"> Tambah Data</span></i></button>
                    </div>
                    <div class="col-md-10">
                        <?php if(Session::get('addpusk')){ ?>
                            <div class="alert" style="color: #155724;background-color: #d4edda;border-color: #c3e6cb;margin-bottom: 0px;">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                 Data telah disimpan !!! 
                            </div>
                        <?php }else if(Session::get('updpusk')){ ?> 
                            <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px;">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                 Data telah diubah !!! 
                            </div>
                        <?php }else if(Session::get('delpusk')){ ?> 
                          <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px;">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> 
                                 Data telah dihapus !!! 
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
                      <th>Puskesmas</th>
                      <th>Alamat</th>
                      <th>RT</th>
                      <th>RW</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $dat)
                    <tr>
                       <td style="width: 50px;text-align: center;">{{$dat->id}}</td>
                        <td>{{$dat->nama }}</td>
                        <td>{{$dat->jalan}}</td>
                        <td>{{$dat->RT}}</td>
                        <td>{{$dat->RW}}</td>
                        <td style="width: 90px;">
                            <!-- <a href="/adm_wil:map={{$dat->id}}" class="btn btn-primary" style="color: white;"><i class="fas fa-map"></i></a> -->
                            <a type="button" class="btn btn-warning" style="color: black;" data-toggle="modal" data-target="#edit{{$dat->idal}}"><i class="fas fa-edit"></i></a>
                            <a href="/adm_pusk:del={{$dat->idal}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


      <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-success shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data</h4>
            </div>
           <form action="{{url('/adm_add_pusk')}}" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="modal-body">
              <div class="row">
                <!-- <div class="col-md-5">
                   <center>
                      FOTO <br>
                       <img id="image-preview" style="width: 270px; height: 180px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 10px;"><br>
                        <input type="file" name="gambar" class="form-control" id="image-source" onchange="previewImage();" style="width: 100%;" autocomplete="off"><br>
                      </center>
                  </div> -->
                  <div class="col-md-12">
                    <?php if($pus == null){ ?>
                         <input type="hidden" name="idp" value="1" readonly="">
                    <?php }else{?>
                      @foreach($idpus as $id)
                          <input type="hidden" name="idp" value="{{$id->id+1}}" readonly="">
                      @endforeach
                    <?php } ?>
                  <style type="text/css">
                    td{
                      padding: 5px;
                    }
                  </style>
                    <table>
                        <tr>
                          <td>NAMA PUSKESMAS</td>
                          <td>:</td>
                          <td style="width: 230px;">
                             <input type="text" name="nama" step="any" class="form-control" required="" autocomplete="off">
                          </td>
                        </tr>
                        <tr>
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="number" name="no" class="form-control"  autocomplete="off"></td>
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

    @foreach($data as $dat)
      <div class="modal fade" id="edit{{$dat->idal}}">
        <div class="modal-dialog modal-md">
          <div class="modal-content card border-left-warning shadow" style="border-radius: 10px;">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data</h4>
            </div>
            <?php
              $id = $dat->idal;
              $edit = DB::SELECT("select*, b.id as idal from puskesmas a, alamat b where a.id_alamat = b.id and b.id = '$id'");
            ?>
            @foreach($edit as $ed)
           <form action="/adm_pusk:upd={{$ed->idal}}" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="modal-body">
              <div class="row">
                <!-- <div class="col-md-5">
                   <center>
                      FOTO <br>
                       <img id="image-preview" style="width: 270px; height: 180px;margin: 10px 0px 10px 0px;border:1px solid white;border-radius: 10px;"><br>
                        <input type="file" name="gambar" class="form-control" id="image-source" onchange="previewImage();" style="width: 100%;" autocomplete="off"><br>
                      </center>
                  </div> -->
                  <div class="col-md-12">
                  <style type="text/css">
                    td{
                      padding: 5px;
                    }
                  </style>
                    <table>
                        <tr>
                          <td>NAMA PUSKESMAS</td>
                          <td>:</td>
                          <td style="width: 230px;">
                             <input type="text" name="nama" step="any" class="form-control" value="{{$ed->nama}}" required="" autocomplete="off">
                          </td>
                        </tr>
                        <tr>
                          <td>NO TELP</td>
                          <td>:</td>
                          <td><input type="number" name="no" class="form-control"  value="{{$ed->telp}}" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>ALAMAT</td>
                          <td>:</td>
                          <td><input type="text" name="alam" class="form-control"  value="{{$ed->jalan}}" required="" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>RT / RW</td>
                          <td>:</td>
                          <td>
                              <input type="number" name="rt" class="form-control" value="{{$ed->RT}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                              <input type="number" name="rw" class="form-control" value="{{$ed->RW}}" required="" autocomplete="off" style="width: 45%;display: inline-grid;">
                          </td>
                        </tr>
                        <tr>
                          <td>KECAMATAN</td>
                          <td>:</td>
                          <td><input type="text" name="kec" class="form-control"  value="{{$ed->kecamatan}}"autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>DESA</td>
                          <td>:</td>
                          <td><input type="text" name="desa" class="form-control"  value="{{$ed->desa}}"autocomplete="off"></td>
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
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68"></script> 
<script type="text/javascript">
var geocoder;
var map;
var polygonArray = [];

function initialize() {
  map = new google.maps.Map(
    document.getElementById("map_canvas"), {
      center: new google.maps.LatLng(-7.814406, 112.009495),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  var drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYGON,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [
        google.maps.drawing.OverlayType.POLYGON
      ]
    },
    /* not useful on jsfiddle
    markerOptions: {
      icon: 'images/car-icon.png'
    }, */
    circleOptions: {
      fillColor: '#ffff00',
      fillOpacity: 1,
      strokeWeight: 5,
      clickable: false,
      editable: true,
      zIndex: 1
    },
    polygonOptions: {
      fillColor: '#BCDCF9',
      fillOpacity: 0.5,
      strokeWeight: 2,
      strokeColor: '#57ACF9',
      clickable: false,
      editable: false,
      zIndex: 1
    }
  });
  console.log(drawingManager)
  drawingManager.setMap(map)

  google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
    // document.getElementById('info').innerHTML += "polygon points:" + "<br>";
    for (var i = 0; i < polygon.getPath().getLength(); i++) {
      document.getElementById('info').innerHTML += polygon.getPath().getAt(i).toUrlValue(6) + " ";
    }
    polygonArray.push(polygon);
  });

}
google.maps.event.addDomListener(window, "load", initialize);
</script>
@endsection