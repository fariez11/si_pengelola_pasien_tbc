<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/actlog', 'Controller@actlog');

Route::get('/admin', function () {
    return view('/admin/home');
});

Route::get('/adatpusk', 'Admin@datapusk');
Route::get('/adm_add_pusk', 'Admin@addpusk');
Route::get('/adm_pusk:upd={id}', 'Admin@updpusk');
Route::get('/adm_pusk:del={id}', 'Admin@delpusk');

Route::get('/adatuser', 'Admin@datauser');
Route::post('/adm_add_user', 'Admin@adduser');
Route::post('/adm_user:upd={id}', 'Admin@upduser');
Route::get('/adm_user:del={id}', 'Admin@deluser');

Route::get('/petugas', function () {
    return view('/petugas/home');
});

Route::get('/pdatpas', 'Pet@datapas');
Route::post('/pet_add_pas', 'Pet@addpas');
Route::get('/pet_pas:kk={id}', 'Pet@kkpas');
Route::post('/pet_pas:upd={id}', 'Pet@updpas');
Route::get('/pet_pas:del={id}', 'Pet@delpas');


Route::get('/kader', function () {
    return view('/kader/home');
});

Route::get('/kdatpas', 'Kad@datapas');
Route::post('/kad_add_pas', 'Kad@addpas');
Route::get('/kad_pas:kk={id}', 'Kad@kkpas');
Route::post('/kad_pas:upd={id}', 'Kad@updpas');
Route::get('/kad_pas:del={id}', 'Kad@delpas');

Route::post('/kad_add_kk', 'Kad@addkk');
Route::post('/kad_kk:upd={id}', 'Kad@updkk');
Route::get('/kad_kk:del={id}', 'Kad@delkk');

Route::get('/logout', 'Controller@logout');

