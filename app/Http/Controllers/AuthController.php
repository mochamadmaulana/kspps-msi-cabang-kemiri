<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik_username' => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Harap periksa kembali Nik/Username dan Password anda!')->withErrors($validator)->withInput();
        }
        $karyawan = User::with('tempat_lahir','kantor')->where('no_induk',$request->nik_username)->orWhere('username',$request->nik_username)->first();
        if (!empty($karyawan) && $request->nik_username === $karyawan->no_induk || $request->nik_username === $karyawan->username) {
            if (!empty($karyawan) && Hash::check($request->password, $karyawan->password)) {
                if($karyawan->is_aktif == true){
                    // cek role 'Admin', 'Kasi Pembiayaan', 'Kasi Keuangan', 'Staff Lapangan', 'Branch Manager'
                    if ($karyawan->role === 'Admin') {
                        Auth::login($karyawan);
                        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil, Selamat bekerja '.$karyawan->nama_lengkap);
                    }elseif($karyawan->role === 'Kasi Pembiayaan') {
                        Auth::login($karyawan);
                        return redirect()->route('kasi-pembiayaan.dashboard')->with('success', 'Login berhasil, Selamat bekerja '.$karyawan->nama_lengkap);
                    }else{
                        return back()->with('error', 'Login hanya dapat dilakukan oleh Admin dan Kasie Pembiayaan!');
                    }
                }else{
                    return back()->with('error', 'Akun tidak aktif, harap hubungi admin!')->withErrors($validator)->withInput();
                }
            }else {
                return back()->with('error', 'Harap periksa kembali NIK/Username dan Password anda!')->withErrors($validator)->withInput();
            }
        } else {
            return back()->with('error', 'Harap periksa kembali NIK/Username dan Password anda!')->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with("success", "Logout berhasil, sampai jumpa kembali..");
    }
}
