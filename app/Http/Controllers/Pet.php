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

class Pet extends Controller
{
    public function datapas()
    {	
		$ka = Session::get('kader');
		$ipus = Session::get('ipus');
        $idp = pasien::getId();
        $pas = pasien::all();
        $pasien = DB::SELECT("select*, a.id_alamat as idal , a.id as idpa from pasien a, alamat b,kader c, users d where a.id_alamat = b.id and a.id_alamat = b.id and a.id_kader = c.id and c.id_user = d.id and a.id_puskesmas = '$ipus'");
        $pus = puskesmas::all();
        $pus = puskesmas::all();
        $alam = alamat::all();
        $ida = alamat::getId();
        
        return view('/petugas/data_pas',['data'=>$pasien,'pas'=>$pas,'idp'=>$idp,'pus'=>$pus,'alam'=>$alam,'ida'=>$ida]);
    }

    public function addpas(Request $request)
    {

        $ip = $request->idp;
        $ik = $request->idk;
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
            return redirect('/pdatpas')->with('error','.');
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
        return redirect('pdatpas')->with('addpas','.');
    }

    public function kkpas($id)
    {   
        $data = DB::SELECT("select*from kartu_kontrol where id_pasien = '$id' order by tanggal DESC");
        $idk = kartu_kontrol::getId();
        $sql = DB::SELECT("select*,a.telp, a.id_alamat as idal,a.nama as napas from pasien a, alamat b where a.id_alamat = b.id and a.id = '$id'");

        return view('/petugas/data_kk',['data'=>$data,'idk'=>$idk,'sql'=>$sql]);
    }

    public function updpas(Request $request,$id)
    {

        $ipu = $request->pus;
        $na = $request->nama;
        $tgl = $request->tgl;
        $gen = $request->gend;
        $no = $request->no;
        $ti = $request->tipe;
        $tgd = $request->tgd;
        $sta = $request->stat;


        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $ke = $request->kec;
        $de = $request->desa;

        $data = DB::table('alamat')->where('id',$id)->update(['jalan'=>$al,'RT'=>$rt,'RW'=>$rw,'kecamatan'=>$ke,'desa'=>$de]);

        $data = DB::table('pasien')->where('id_alamat',$id)->update(['id_puskesmas'=>$ipu,'nama'=>$na,'tgl_lahir'=>$tgl,'tgl_daftar'=>$tgd,'jenis_kelamin'=>$gen,'telp'=>$no,'tipe_pasien'=>$ti,'status'=>$sta]);


        return redirect('pdatpas')->with('updpas','.');
    }

    public function delpas($id){
        

        DB::table('alamat')->where('id',$id)->delete();
        DB::table('pasien')->where('id_alamat',$id)->delete();

        return redirect('pdatpas')->with('delpas','.');
    }
}
