<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('/',[AuthController::class,'store'])->name('login.store');
});
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Get Kota/Kabupaten By ID Provinsi
    Route::get('get-kota-kabupaten/{prov_id}', function(string $prov_id){
        $kota_kab = App\Models\Kota::where('provinsi_id',$prov_id)->orderBy('nama_kota')->get();
        return response()->json($kota_kab);
    });

    // Get Kecamatan By ID Kota/Kabupaten
    Route::get('get-kecamatan/{kota_kab_id}', function(string $kota_kab_id){
        $kecamatan = App\Models\Kecamatan::where('kota_id',$kota_kab_id)->orderBy('nama_kecamatan')->get();
        return response()->json($kecamatan);
    });

    // Get Kelurahan By ID Kecamatan
    Route::get('get-kelurahan/{kec_id}', function(string $kec_id){
        $kelurahan = App\Models\Kelurahan::where('kecamatan_id',$kec_id)->orderBy('nama_kelurahan')->get();
        return response()->json($kelurahan);
    });

    // Get Anggota By ID Kantor && ID Majlis
    Route::get('get-anggota/{kantor_id}/{majlis_id}', function(string $kantor_id, string $majlis_id){
        $anggota = App\Models\Anggota::where('kantor_id',$kantor_id)->where('majlis_id',$majlis_id)->where('is_ketua_majlis',false)->orderBy('id',"DESC")->get();
        return response()->json($anggota);
    });

    // Get Jenis Usaha
    Route::get('get-jenis-usaha', function(){
        $jenis_usaha = App\Models\JenisUsaha::get();
        return response()->json($jenis_usaha);
    });

    // Get Komoditi Usaha
    Route::get('get-komoditi-usaha/{jenis_usaha_id}', function(string $id){
        $komoditi_usaha = App\Models\KomoditiUsaha::where('jenis_usaha_id',$id)->orderBy('nama')->get();
        return response()->json($komoditi_usaha);
    });
});
