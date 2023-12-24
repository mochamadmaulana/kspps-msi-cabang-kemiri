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

    Route::prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/',[AnggotaController::class,'index'])->name('index');
        Route::post('create-pendaftaran',[AnggotaController::class,'create_pendaftaran'])->name('create-pendaftaran');
        Route::get('pendaftaran/{tanggal}',[AnggotaController::class,'index_pendaftaran'])->name('index-pendaftaran');
        Route::get('pendaftaran/{tanggal}/input/tahap-1',[AnggotaController::class,'input_pendaftaran_tahap_satu'])->name('input-pendaftaran-tahap-satu');
        Route::post('pendaftaran/{tanggal}/store/tahap-1',[AnggotaController::class,'store_pendaftaran_tahap_satu'])->name('store-pendaftaran-tahap-satu');
        Route::get('pendaftaran/{tanggal}/edit/tahap-1',[AnggotaController::class,'edit_pendaftaran_tahap_satu'])->name('edit-pendaftaran-tahap-satu');
        Route::put('pendaftaran/{tanggal}/update/tahap-1/{id_pendaftaran}',[AnggotaController::class,'update_pendaftaran_tahap_satu'])->name('update-pendaftaran-tahap-satu');

        Route::get('pendaftaran/{tanggal}/input/tahap-2',[AnggotaController::class,'input_pendaftaran_tahap_dua'])->name('input-pendaftaran-tahap-dua');
        Route::post('anggota/pendaftaran/{tanggal}/store/tahap-2',[AnggotaController::class,'store_pendaftaran_tahap_dua'])->name('store-pendaftaran-tahap-dua');
        Route::get('pendaftaran/{tanggal}/edit/tahap-2',[AnggotaController::class,'edit_pendaftaran_tahap_dua'])->name('edit-pendaftaran-tahap-dua');
        Route::put('pendaftaran/{tanggal}/update/tahap-2/{id_alamat}',[AnggotaController::class,'update_pendaftaran_tahap_dua'])->name('update-pendaftaran-tahap-dua');
        Route::put('pendaftaran/alamat-identias/{id_alamat}/update/tahap-2',[AnggotaController::class,'update_pendaftaran_alamat_identitas'])->name('update-pendaftaran-alamat-identitas');

        Route::get('pendaftaran/{tanggal}/input/tahap-3',[AnggotaController::class,'input_pendaftaran_tahap_tigas'])->name('input-pendaftaran-tahap-tigas');
        Route::post('pendaftaran/{tanggal}/store/tahap-3',[AnggotaController::class,'store_pendaftaran_tahap_tigas'])->name('store-pendaftaran-tahap-tigas');
        Route::get('pendaftaran/{tanggal}/edit/tahap-3',[AnggotaController::class,'edit_pendaftaran_tahap_tigas'])->name('edit-pendaftaran-tahap-tigas');
        Route::put('pendaftaran/{tanggal}/update/tahap-3/{id_pendaftaran}',[AnggotaController::class,'update_pendaftaran_tahap_tigas'])->name('update-pendaftaran-tahap-tigas');

        Route::post('pendaftaran/{id_anggota}/upload/file-identitas',[AnggotaController::class,'upload_file_identitas'])->name('pendaftaran-upload-file-identitas');
        Route::delete('pendaftaran/{id_anggota}/destroy/file-identitas',[AnggotaController::class,'destroy_file_identitas'])->name('pendaftaran-destroy-file-identitas');

        Route::post('pendaftaran/{id_anggota}/upload/file-selfie-identitas',[AnggotaController::class,'upload_file_selfie_identitas'])->name('pendaftaran-upload-file-selfie-identitas');
        Route::delete('pendaftaran/{id_anggota}/destroy/file-selfie-identitas',[AnggotaController::class,'destroy_file_selfie_identitas'])->name('pendaftaran-destroy-file-selfie-identitas');

        Route::post('pendaftaran/{id_anggota}/upload/file-kartu-keluarga',[AnggotaController::class,'upload_file_kartu_keluarga'])->name('pendaftaran-upload-file-kartu-keluarga');
        Route::delete('pendaftaran/{id_anggota}/destroy/file-kartu-keluarga',[AnggotaController::class,'destroy_file_kartu_keluarga'])->name('pendaftaran-destroy-file-kartu-keluarga');
    });



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
