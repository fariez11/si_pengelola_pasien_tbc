<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'id', 'id_alamat','id_kader','id_puskesmas','nama','tgl_lahir','jenis_kelamin','telp','tipe_pasien','tgl_daftar','status'
    ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('pasien')->orderBy('id','DESC')->take(1)->get();
    }
}
