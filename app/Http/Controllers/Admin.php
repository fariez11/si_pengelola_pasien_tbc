<?php

namespace App\Http\Controllers;

use Session;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Authenticate;
use DB;
use App\User;
use App\kader;
use App\puskesmas;
use App\alamat;


class Admin extends Controller
{
  	
	public function datapusk()
    {
        $idpus = puskesmas::getId();
        $pusk = DB::SELECT("select*, b.id as idal from puskesmas a, alamat b where a.id_alamat = b.id");
        $pus = puskesmas::all();
        $alam = alamat::all();
        $ida = alamat::getId();
        
        return view('/admin/data_pusk',['pus'=>$pus,'data'=>$pusk,'idpus'=>$idpus,'ida'=>$ida,'alam'=>$alam]);
    }

    public function addpusk(Request $request)
    {

        $ip = $request->idp;
        $na = $request->nama;
        $no = $request->no;
        // $gambar = $request->file('foto');
        // $foto = $gambar->getClientOriginalName();
        // $request->file('foto')->move("assets/puskesmas/", $foto);



        $id = $request->ida;
        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;


        $cek = DB::SELECT("select*from puskesmas where nama = '$na'");
        foreach ($cek as $key) {
            $u1 = $key->nama;
        };
        if (count($cek) == 1){
            return redirect('/adatapet')->with('error','.');
        }else{

        $data = new puskesmas();
            $data->id = $ip;
            $data->nama = ucfirst($na);
            $data->telp = $no;
            $data->id_alamat = $id;
            // $data->foto = $foto;
            $data->save(); 

        $data = new alamat();
            $data->id = $id;
            $data->jalan = $al;
            $data->RT = $rt;
            $data->RW = $rw;
            $data->desa = $de;
            $data->kecamatan = $ke;
            $data->save();

        }
        return redirect('adatpusk')->with('addpusk','.');
    }


    public function updpusk(Request $request,$id)
    {

        $na = $request->nama;
        $no = $request->no;
        // $gambar = $request->file('foto');
        // $foto = $gambar->getClientOriginalName();
        // $request->file('foto')->move("assets/puskesmas/", $foto);


        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;
        $data = DB::table('puskesmas')->where('id_alamat',$id)->update(['nama'=>$na,'telp'=>$no]);

        $data = DB::table('alamat')->where('id',$id)->update(['jalan'=>$al,'RT'=>$rt,'RW'=>$rw,'kecamatan'=>$ke,'desa'=>$de]);
        

        return redirect('adatpusk')->with('updpusk','.');
    }

    public function delpusk($id){
        // $gam = DB::SELECT("select*from petugas where PET_ID = $id");
        // foreach ($gam as $key) {
        //     $image_path = "assets/foto/$key->FOTO";  
        //     if(File::exists($image_path)) {
        //     File::delete($image_path);
        //     }
        // }

        DB::table('alamat')->where('id',$id)->delete();
        DB::table('puskesmas')->where('id_alamat',$id)->delete();

        return redirect('adatpusk')->with('delpusk','.');
    }



    public function datauser()
    {
            $idp = User::getId();
            $user = DB::SELECT("select*, c.id as idal, d.nama as puskesmas from users a, kader b , alamat c, puskesmas d where a.id = b.id_user and b.id_alamat = c.id and b.id_puskesmas = d.id order by level DESC");
            $kad = kader::all();
            $idpus = puskesmas::getId();
            $pus = puskesmas::all();
            $alam = alamat::all();
            $ida = alamat::getId();
            
            return view('/admin/data_user',['data'=>$user,'kad'=>$kad,'idp'=>$idp,'idpus'=>$idpus,'pus'=>$pus,'ida'=>$ida,'alam'=>$alam]);
    }

      public function adduser(Request $request)
    {

        $iu = $request->idu;
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $le = $request->sta;


        $ip = $request->pus;
        $no = $request->no;
        $tgl = $request->tgl;
        $pek = $request->pek;
        $tgm = date('Y-m-d');
        $sta = 'Aktif';
         $gambar = $request->file('foto');

        if($gambar ==null){
            $foto = 'defaultprofile.png';           
        }else{
            $foto = $gambar->getClientOriginalName();
            $request->file('foto')->move("assets/foto/", $foto);
        }

        $id = $request->ida;
        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;

      
        $data = new User();
            $data->id = $iu;
            $data->name = $na;
            $data->email = $em;
            $data->username = $us;
            $data->password = $pa;
            $data->level = $le;
            $data->save();

        $data = new kader();
            $data->id = $iu;
            $data->id_user = $iu;
            $data->id_alamat = $id;
            $data->id_puskesmas = $ip;
            $data->telp = $no;
            $data->tgl_lahir= $tgl;
            $data->pekerjaan = $pek;
            $data->tgl_masuk = $tgm;
            $data->status = $sta;
            $data->foto = $foto;
            $data->save();

        $data = new alamat();
            $data->id = $id;
            $data->jalan = $al;
            $data->RT = $rt;
            $data->RW = $rw;
            $data->desa = $de;
            $data->kecamatan = $ke;
            $data->save();

        
        return redirect('adatuser')->with('adduser','.');
    }

    public function upduser(Request $request,$id)
    {

        $iu = $request->idu;
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $le = 'pendamping';


        $ip = $request->pus;
        $no = $request->no;
        $tgl = $request->tgl;
        $pek = $request->pek;
        $tgm = date('Y-m-d');
        $sta = 'Aktif';
        if($request->file('foto') == null){
            $foto = 'defaultprofile.png';
        }else{
        $gambar = $request->file('foto');
        $foto = $gambar->getClientOriginalName();
        $request->file('foto')->move("assets/profil/", $foto);
        }

        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;

        $data = DB::table('users')->where('id',$iu)->update(['name'=>$na,'email'=>$em,'username'=>$us,'password'=>$pa]);

        $data = DB::table('kader')->where('id_alamat',$id)->update(['id_puskesmas'=>$ip,'telp'=>$no,'tgl_lahir'=>$tgl,'pekerjaan'=>$pek,'foto'=>$foto]);

        $data = DB::table('alamat')->where('id',$id)->update(['jalan'=>$al,'RT'=>$rt,'RW'=>$rw,'kecamatan'=>$ke,'desa'=>$de]);
        
        return redirect('adatuser')->with('upduser','.');
    }

    public function deluser($id){
        $gam = DB::SELECT("select*from kader where id_alamat = $id");
        foreach ($gam as $key) {
            $idu = $key->id_user;
            if($key->foto == 'defaultprofile.png'){

            }else{
                $image_path = "assets/foto/$key->foto";
                if(File::exists($image_path)) {
                File::delete($image_path);
                }
            }
        }

        DB::table('alamat')->where('id',$id)->delete();
        DB::table('kader')->where('id_alamat',$id)->delete();
        DB::table('users')->where('id',$idu)->delete();

        return redirect('adatuser')->with('deluser','.');
    }
   

}
