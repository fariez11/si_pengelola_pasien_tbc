<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class kader extends Model
{
    protected $table = 'kader';
    protected $fillable = [
        'id', 'id_user','id_alamat','id_puskesmas','id_admin','nama','telp','tgl_lahir','pekerjaan','tgl_masuk','status'
    ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('kader')->orderBy('id','DESC')->take(1)->get();
    }
}
