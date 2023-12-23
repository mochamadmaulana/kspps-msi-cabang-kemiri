<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembiayaanController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('majlis','pendaftaran_anggota')->whereKantorId(Auth::user()->kantor_id)->orderBy('id','DESC')->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.pembiayaan.index',[
            'anggota' => $anggota
        ]);
    }
}
