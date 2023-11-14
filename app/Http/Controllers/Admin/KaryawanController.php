<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use HelpKaryawan;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.karyawan.index',[
            'karyawan' => User::with('tempat_lahir')->where('kantor_id',Auth::user()->kantor_id)->latest('id')->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota_kab = Kota::orderBy('nama_kota','ASC')->get();
        $filter = ['Kasi Pembiayaan','Kasi Keuangan','Branch Manager'];
        $role = HelpKaryawan::filter_role($filter, Auth::user()->kantor_id, ['Staff Lapangan']);
        return view('admin.karyawan.tambah',[
            'kota_kab' => $kota_kab,
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "no_induk" => ["required","max:7","unique:users,no_induk"],
            "username" => ["required","max:25","unique:users,username"],
            "nama_lengkap" => ["required"],
            "email" => ["required","unique:users,email"],
            "no_telepone" => ["required","max:15","unique:users,no_telepone"],
            "tempat_lahir" => ["required"],
            "tanggal_lahir" => ["required"],
            "role" => ["required"],
            "password" => ["required","min:6"],
            "konfirmasi_password" => ["required_with:password","same:password"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menambahkan karyawan!')->withErrors($validator)->withInput();
        }
        if(strtoupper($request->no_induk) === $request->no_induk){
            User::create([
                "no_induk" => strtoupper($request->no_induk),
                "username" => strtolower($request->username),
                "nama_lengkap" => $request->nama_lengkap,
                "no_telepone" => $request->no_telepone,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "tempat_lahir_id" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "role" => $request->role,
                "is_aktif" => true,
                "kantor_id" => Auth::user()->kantor_id,
            ]);
            return back()->with('success','Berhasil menambahkan karyawan');
        }else{
            return back()->with('error','No. Induk harus huruf besar dan angka!')->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = User::findOrFail($id);
        $kota_kab = Kota::orderBy('nama_kota','ASC')->get();
        $filter = ['Kasi Pembiayaan','Kasi Keuangan','Branch Manager'];
        $role = HelpKaryawan::filter_role($filter, Auth::user()->kantor_id, ['Staff Lapangan']);
        return view('admin.karyawan.edit',compact('karyawan','kota_kab','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "no_induk" => ["required","max:7","unique:users,no_induk,".$id.",id"],
            "username" => ["required","max:30","unique:users,username,".$id.",id"],
            "nama_lengkap" => ["required"],
            "email" => ["nullable","max:200","unique:users,email,".$id.",id"],
            "no_telepone" => ["required","max:200","unique:users,no_telepone,".$id.",id"],
            "tempat_lahir" => ["required"],
            "tanggal_lahir" => ["required"],
            "role" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate karyawan!')->withErrors($validator)->withInput();
        }
        $karyawan = User::findOrFail($id);
        if(strtoupper($request->no_induk) === $request->no_induk){
            $karyawan->update([
                "no_induk" => strtoupper($request->no_induk),
                "username" => strtolower($request->username),
                "nama_lengkap" => $request->nama_lengkap,
                "no_telepone" => $request->no_telepone,
                "email" => $request->email,
                "tempat_lahir_id" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "role" => $request->role,
                "is_aktif" => $request->status,
            ]);
            return redirect()->route('admin.karyawan.index')->with('success','Berhasil mengupdate karyawan');
        }else{
            return back()->with('error','No. Induk harus huruf besar dan angka!')->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();
        return back()->with('success','Berhasil menghapus karyawan');
    }

    public function edit_password(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "password" => ["required","min:6"],
            "konfirmasi_password" => ["required_with:password","same:password"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate password!')->withErrors($validator)->withInput();
        }
        $karyawan = User::findOrFail($id);
        $karyawan->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with('success','Berhasil mengupdate password');
    }
}
