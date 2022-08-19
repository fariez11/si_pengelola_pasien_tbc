<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function actlog(Request $request){
        $username = $request->user;
        $password = $request->pass;

        Session::flush();
        $data = DB::table('users')->where([['username',$username],['password',$password]])->get();
        foreach ($data as $key) {
            $nama = $key->username;
            $level = $key->level;
        };

        if (count($data) == 0){
            return redirect('/')->with('gagal','.');
        }
        if($level == 'admin') {
        	$na = DB::SELECT("select LEFT(a.name,20) as nama,b.foto, c.id as idal from users a, kader b , alamat c where a.id = b.id_user and b.id_alamat = c.id and a.username like '$username'");
        	foreach ($na as $nam) {
        		Session::put('username',$username);
        		Session::put('nama',$nam->nama);
        		Session::put('fp',$nam->foto);
                Session::put('idal',$nam->idal);
        	}


            return redirect('/admin');
        }
        else if($level == 'petugas') {

            $na = DB::SELECT("select LEFT(a.name,20) as nama, b.id as kad, b.foto, c.id as ipus, c.nama as nampus, d.id as idal from users a, kader b,puskesmas c, alamat d where a.id = b.id_user and b.id_alamat = d.id and b.id_puskesmas = c.id and a.username like '$username'");
        	foreach ($na as $nam) {
        		Session::put('username',$username);
                Session::put('nama',$nam->nama);
                Session::put('kader',$nam->kad);
        		Session::put('fp',$nam->foto);
                Session::put('nampus',$nam->nampus);
                Session::put('ipus',$nam->ipus);
                Session::put('idal',$nam->idal);
        	}

            return redirect('/petugas');
        }else if($level == 'pendamping') {

            $na = DB::SELECT("select LEFT(a.name,20) as nama, b.id as kad,b.foto, c.id as ipus, c.nama as nampus, d.id as idal from users a, kader b,puskesmas c, alamat d where a.id = b.id_user and b.id_puskesmas = c.id and b.id_alamat = d.id and a.username like '$username'");
            foreach ($na as $nam) {
                Session::put('username',$username);
                Session::put('nama',$nam->nama);
                Session::put('kader',$nam->kad);
                Session::put('fp',$nam->foto);
                Session::put('nampus',$nam->nampus);
                Session::put('ipus',$nam->ipus);
                Session::put('idal',$nam->idal);
            }

            return redirect('/kader');
        }

        else if($level == 4) {

            return redirect('/')->with('error','.');
        }

    }

     public function logout(){

        Session::flush();
        return redirect('/');
    }
}
