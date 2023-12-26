<?php

namespace App\Http\Controllers\StaffLapangan;

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
        $majlis = Majlis::with('ketua','petugas','kecamatan','kelurahan')->wherePetugasId(Auth::user()->id)->whereKantorId(Auth::user()->kantor_id)->orderBy('id','DESC')->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('staff-lapangan.majlis.index',compact('majlis'));
    }

    public function pilih_ketua(Request $request)
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
