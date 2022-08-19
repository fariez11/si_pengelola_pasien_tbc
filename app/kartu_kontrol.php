<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kartu_kontrol extends Model
{
    protected $table = 'kartu_kontrol';
    protected $fillable = [
        'id', 'tanggal','id_pasien','cek_obat','cek_dahak','keterangan','foto'
    ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('kartu_kontrol')->orderBy('id','DESC')->take(1)->get();
    }
}
