<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class puskesmas extends Model
{
    protected $table = 'puskesmas';
    protected $fillable = [
        'id', 'nama','telp','id_alamat','foto'
    ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('puskesmas')->orderBy('id','DESC')->take(1)->get();
    }
}
