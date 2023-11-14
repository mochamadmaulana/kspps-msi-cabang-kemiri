<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Majlis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MajlisController extends Controller
{
    public function index()
    {
        $majlis = Majlis::with('ketua','petugas','kecamatan','kelurahan')->where('kantor_id',Auth::user()->kantor_id)->orderBy('id','DESC')->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.majlis.index',compact('majlis'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::where('kota_id',Auth::user()->kantor->kota_kab_id)->orderBy('nama_kecamatan')->get();
        $petugas = User::where('kantor_id',Auth::user()->kantor_id)->get();
        return view('admin.majlis.tambah',[
            'kecamatan' => $kecamatan,
            'petugas' => $petugas,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kode" => ["required","numeric","unique:majlis,kode"],
            "nama" => ["required","max:150","unique:majlis,nama"],
            "kecamatan" => ["required"],
            "kelurahan" => ["required"],
            "petugas" => ["required"],
            "kategori" => ["required"],
            "tanggal_berdiri" => ["required"],
            "rt_rw" => ["required","max:7"],
            "alamat" => ["required","max:200"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menambahkan majlis!')->withErrors($validator)->withInput();
        }
        Majlis::create([
            'kantor_id' => Auth::user()->kantor_id,
            "kode" => $request->kode,
            "kategori" => $request->kategori,
            "nama" => $request->nama,
            "kecamatan_id" => $request->kecamatan,
            "kelurahan_id" => $request->kelurahan,
            "rt_rw" => $request->rt_rw,
            "alamat" => $request->alamat,
            "tanggal_berdiri" => $request->tanggal_berdiri,
            "petugas_id" => $request->petugas,
        ]);
        return back()->with('success','Berhasil menambahkan majlis');
    }

    public function edit(string $id)
    {
        $majlis = Majlis::with('petugas','kantor','kecamatan','kelurahan')->findOrFail($id);
        $kecamatan = Kecamatan::where('kota_id',Auth::user()->kantor->kota_kab_id)->orderBy('nama_kecamatan')->get();
        $petugas = User::where('kantor_id',Auth::user()->kantor_id)->get();
        return view('admin.majlis.edit',[
            'majlis' => $majlis,
            'kecamatan' => $kecamatan,
            'petugas' => $petugas,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "kode" => ["required","numeric","unique:majlis,kode,".$id.",id"],
            "nama" => ["required","max:150","unique:majlis,nama,".$id.",id"],
            "kecamatan" => ["required"],
            "petugas" => ["required"],
            "kategori" => ["required"],
            "tanggal_berdiri" => ["required"],
            "rt_rw" => ["required","max:7"],
            "alamat" => ["required","max:200"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate majlis!')->withErrors($validator)->withInput();
        }
        $majlis = Majlis::findOrFail($id);
        $majlis->kode = $request->kode;
        $majlis->kategori = $request->kategori;
        $majlis->nama = $request->nama;
        $majlis->kecamatan_id = $request->kecamatan;
        if(!empty($request->kelurahan)){
            $majlis->kelurahan_id = $request->kelurahan;
        }
        $majlis->rt_rw = $request->rt_rw;
        $majlis->alamat = $request->alamat;
        $majlis->tanggal_berdiri = $request->tanggal_berdiri;
        $majlis->petugas_id = $request->petugas;
        $majlis->update();
        return redirect()->route('admin.majlis.index')->with('success','Berhasil mengupdate majlis');
    }

    public function destroy(string $id)
    {
        $majlis = Majlis::findOrFail($id);
        $majlis->delete();
        return back()->with('success','Berhasil menghapus majlis');
    }

    public function add_ketua(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "ketua" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal memilih ketua majlis!')->withErrors($validator)->withInput();
        }
        $majlis = Majlis::findOrFail($request->id_majlis);
        if(!empty($majlis->ketua_id)){
            $ketua_lama = Anggota::findOrFail($majlis->ketua_id);
            $ketua_lama->is_ketua_majlis = false;
            $ketua_lama->update();
            $ketua_baru = Anggota::findOrFail($request->ketua);
            $ketua_baru->is_ketua_majlis = true;
            $ketua_baru->update();
            $majlis->ketua_id = $request->ketua;
            $majlis->update();
        }else{
            $ketua = Anggota::findOrFail($request->ketua);
            $ketua->is_ketua_majlis = true;
            $ketua->update();
            $majlis->ketua_id = $request->ketua;
            $majlis->update();
        }
        return back()->with('success','Berhasil memilih ketua majlis : '.$majlis->nama_majlis);
    }
}
