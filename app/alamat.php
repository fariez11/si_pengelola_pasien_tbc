<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class alamat extends Model
{
    protected $table = 'alamat';
    protected $fillable = [
        'id', 'jalan','RT','RW','desa','kecamatan','lat','lng','marker'
    ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('alamat')->orderBy('id','DESC')->take(1)->get();
    }
}
