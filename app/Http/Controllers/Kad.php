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
use App\pasien;
use App\kartu_kontrol;


class Kad extends Controller
{
    public function datapas()
    {	
		$ka = Session::get('kader');
        $idp = pasien::getId();
        $pas = pasien::all();
        $pasien = DB::SELECT("select *, a.id_alamat as idal, a.id as idpa, a.tipe_pasien as tipe from pasien a, alamat b where a.id_alamat = b.id and a.id_alamat = b.id and a.id_kader = '$ka'");
        $pus = puskesmas::all();
        $pus = puskesmas::all();
        $alam = alamat::all();
        $ida = alamat::getId();
        
        return view('/kader/data_pas',['data'=>$pasien,'pas'=>$pas,'idp'=>$idp,'pus'=>$pus,'alam'=>$alam,'ida'=>$ida]);
    }

    public function addpas(Request $request)
    {

        $ip = $request->idp;
        $ik = Session::get('kader');
        $ipu = $request->pus;
        $na = $request->nama;
        $tgl = $request->tgl;
        $gen = $request->gend;
        $no = $request->no;
        $ti = $request->tipe;
        $tgd = date('Y-m-d');
        $sta = 'Aktif';


        $id = $request->ida;
        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;


        $cek = DB::SELECT("select*from pasien where nama = '$na'");
        foreach ($cek as $key) {
            $u1 = $key->nama;
        };
        if (count($cek) == 1){
            return redirect('/kdatpas')->with('error','.');
        }else{

        $data = new pasien();
            $data->id = $ip;
            $data->id_kader = $ik;
            $data->id_alamat = $id;
            $data->id_puskesmas = $ipu;
            $data->nama = ucfirst($na);
            $data->tgl_lahir = $tgl;
            $data->jenis_kelamin = $gen;
            $data->telp = $no;
            $data->tipe_pasien = $ti;
            $data->tgl_daftar = $tgd;
            $data->status = $sta;
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
        return redirect('kdatpas')->with('addpas','.');
    }

    public function kkpas($id)
    {   
        $data = DB::SELECT("select*from kartu_kontrol where id_pasien = '$id' order by tanggal DESC");
        $idk = kartu_kontrol::getId();

        return view('/kader/data_kk',['data'=>$data,'idk'=>$idk]);
    }

    public function addkk(Request $request)
    {

        $id = $request->idk;
        $idp = $request->idp;
        $tg = $request->tgl;
        $ob = $request->obat;
        $da = $request->dahak;
        $ke = $request->ket;
        $gambar = $request->file('foto');

        if($gambar ==null){
            $foto = 'defaultprofile.png';           
        }else{
            $foto = $gambar->getClientOriginalName();
            $request->file('foto')->move("assets/kk/", $foto);
        }


        $cek = DB::SELECT("select*from kartu_kontrol where tanggal = '$tg'");

        if (count($cek) == 1){
             return redirect()->back()->with('error','.');
        }else{

        $data = new kartu_kontrol();
            $data->id = $id;
            $data->tanggal = $tg;
            $data->id_pasien = $idp;
            $data->cek_obat = $ob;
            $data->cek_dahak = $da;
            $data->keterangan = $ke;
            $data->foto = $foto;
            $data->save(); 

        }
        return redirect()->back()->with('adddata','.');
    }

    public function updkk(Request $request,$id)
    {

        $tg = $request->tgl;
        $ob = $request->obat;
        $da = $request->dahak;
        $ke = $request->ket;

        $data = DB::table('kartu_kontrol')->where('id',$id)->update(['tanggal'=>$tg,'cek_obat'=>$ob,'cek_dahak'=>$da,'keterangan'=>$ke]);

        return redirect()->back()->with('upddata','.');
    }

    public function delkk($id){
        

        DB::table('kartu_kontrol')->where('id',$id)->delete();

        return redirect()->back()->with('deldata','.');
    }

    public function updpas(Request $request,$id)
    {

        $na = $request->nama;
        $tgl = $request->tgl;
        $gen = $request->gend;
        $no = $request->no;
        $ti = $request->tipe;
        $tgd = date('Y-m-d');
        $sta = 'Aktif';


        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;

        $data = DB::table('alamat')->where('id',$id)->update(['jalan'=>$na,'RT'=>$rt,'RW'=>$rw,'kecamatan'=>$ke,'desa'=>$de]);

        $data = DB::table('pasien')->where('id_alamat',$id)->update(['nama'=>$na,'tgl_lahir'=>$tgl,'jenis_kelamin'=>$gen,'telp'=>$no,'tipe_pasien'=>$ti]);


        return redirect('kdatpas')->with('updpas','.');
    }

    public function delpas($id){
        

        DB::table('alamat')->where('id',$id)->delete();
        DB::table('pasien')->where('id_alamat',$id)->delete();

        return redirect('kdatpas')->with('delpas','.');
    }
}
