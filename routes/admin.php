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
    Route::post('anggota',[AnggotaController::class,'store'])->name('anggota.store');
    Route::get('anggota/{tanggal}/create-step-1',[AnggotaController::class,'create_step_1'])->name('anggota.create-step-1');
    Route::post('anggota/{tanggal}/store-step-1',[AnggotaController::class,'store_step_1'])->name('anggota.store-step-1');
    Route::get('anggota/{tanggal}/create-step-2',[AnggotaController::class,'create_step_2'])->name('anggota.create-step-2');
    Route::post('anggota/{tanggal}/store-step-2',[AnggotaController::class,'store_step_2'])->name('anggota.store-step-2');
    Route::get('anggota/{tanggal}/create-step-3',[AnggotaController::class,'create_step_3'])->name('anggota.create-step-3');
    Route::post('anggota/{tanggal}/store-step-3',[AnggotaController::class,'store_step_3'])->name('anggota.store-step-3');

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
