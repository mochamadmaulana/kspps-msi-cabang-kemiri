<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KantorController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\KomoditiUsahaController;
use App\Http\Controllers\Admin\MajlisController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('anggota',[AnggotaController::class,'index'])->name('anggota.index');
    Route::post('anggota/create-pendaftaran',[AnggotaController::class,'create_pendaftaran'])->name('anggota.create-pendaftaran');
    Route::get('anggota/pendaftaran/{tanggal}',[AnggotaController::class,'index_pendaftaran'])->name('anggota.index-pendaftaran');
    Route::get('anggota/pendaftaran/{tanggal}/input/tahap-1',[AnggotaController::class,'input_pendaftaran_tahap_satu'])->name('anggota.input-pendaftaran-tahap-satu');
    Route::post('anggota/pendaftaran/{tanggal}/store/tahap-1',[AnggotaController::class,'store_pendaftaran_tahap_satu'])->name('anggota.store-pendaftaran-tahap-satu');
    Route::get('anggota/pendaftaran/{tanggal}/edit/tahap-1',[AnggotaController::class,'edit_pendaftaran_tahap_satu'])->name('anggota.edit-pendaftaran-tahap-satu');
    Route::put('anggota/pendaftaran/{tanggal}/update/tahap-1/{id_pendaftaran}',[AnggotaController::class,'update_pendaftaran_tahap_satu'])->name('anggota.update-pendaftaran-tahap-satu');

    Route::get('anggota/pendaftaran/{tanggal}/input/tahap-2',[AnggotaController::class,'input_pendaftaran_tahap_dua'])->name('anggota.input-pendaftaran-tahap-dua');
    Route::post('anggota/pendaftaran/{tanggal}/store/tahap-2',[AnggotaController::class,'store_pendaftaran_tahap_dua'])->name('anggota.store-pendaftaran-tahap-dua');
    Route::get('anggota/pendaftaran/{tanggal}/edit/tahap-2',[AnggotaController::class,'edit_pendaftaran_tahap_dua'])->name('anggota.edit-pendaftaran-tahap-dua');
    Route::put('anggota/pendaftaran/{tanggal}/update/tahap-2/{id_alamat}',[AnggotaController::class,'update_pendaftaran_tahap_dua'])->name('anggota.update-pendaftaran-tahap-dua');
    Route::put('anggota/pendaftaran/alamat-identias/{id_alamat}/update/tahap-2',[AnggotaController::class,'update_pendaftaran_alamat_identitas'])->name('anggota.update-pendaftaran-alamat-identitas');

    Route::get('anggota/pendaftaran/{tanggal}/input/tahap-3',[AnggotaController::class,'input_pendaftaran_tahap_tigas'])->name('anggota.input-pendaftaran-tahap-tigas');
    Route::post('anggota/pendaftaran/{tanggal}/store/tahap-3',[AnggotaController::class,'store_pendaftaran_tahap_tigas'])->name('anggota.store-pendaftaran-tahap-tigas');
    Route::get('anggota/pendaftaran/{tanggal}/edit/tahap-3',[AnggotaController::class,'edit_pendaftaran_tahap_tigas'])->name('anggota.edit-pendaftaran-tahap-tigas');
    Route::put('anggota/pendaftaran/{tanggal}/update/tahap-3/{id_pendaftaran}',[AnggotaController::class,'update_pendaftaran_tahap_tigas'])->name('anggota.update-pendaftaran-tahap-tigas');



    Route::resource('karyawan',KaryawanController::class)->except('show');
    Route::put('karyawan/{id}/edit-password',[KaryawanController::class,'edit_password'])->name('karyawan.edit-password');

    Route::get('kantor',[KantorController::class,'index'])->name('kantor.index');
    Route::get('kantor/{id}/edit',[KantorController::class,'edit'])->name('kantor.edit');
    Route::put('kantor/{id}',[KantorController::class,'update'])->name('kantor.update');
    Route::post('kantor/{id}/upload-foto',[KantorController::class,'upload_foto'])->name('kantor.upload-foto');
    Route::post('kantor/{id}/edit-foto',[KantorController::class,'edit_foto'])->name('kantor.edit-foto');
    Route::delete('kantor/{id}/delete-foto',[KantorController::class,'delete_foto'])->name('kantor.delete-foto');

    Route::resource('majlis',MajlisController::class)->except('show');
    Route::post('majlis/add-ketua',[MajlisController::class,'add_ketua'])->name('majlis.add-ketua');

    Route::resource('komoditi-usaha',KomoditiUsahaController::class)->except('show');

});
