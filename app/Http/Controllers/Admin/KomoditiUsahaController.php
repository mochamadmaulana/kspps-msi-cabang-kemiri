<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisUsaha;
use App\Models\KomoditiUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomoditiUsahaController extends Controller
{
    public function index()
    {
        $komoditi_usaha = KomoditiUsaha::with('jenis_usaha')->orderBy('id','DESC')->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.komoditi-usaha.index',compact('komoditi_usaha'));
    }

    public function create()
    {
        $jenis_usaha = JenisUsaha::get();
        return view('admin.komoditi-usaha.tambah',[
            'jenis_usaha' => $jenis_usaha,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "jenis_usaha" => ["required"],
            "komoditi" => ["required","max:50"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menambahkan komoditi usaha!')->withErrors($validator)->withInput();
        }
        KomoditiUsaha::create([
            "jenis_usaha_id" => $request->jenis_usaha,
            "nama" => $request->komoditi,
        ]);
        return back()->with('success','Berhasil menambahkan komoditi usaha');
    }

    public function edit(string $id)
    {
        $jenis_usaha = JenisUsaha::get();
        $komoditi = KomoditiUsaha::with('jenis_usaha')->findOrFail($id);
        return view('admin.komoditi-usaha.edit',[
            'jenis_usaha' => $jenis_usaha,
            'komoditi' => $komoditi,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "jenis_usaha" => ["required"],
            "komoditi" => ["required","max:50"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate komoditi usaha!')->withErrors($validator)->withInput();
        }
        KomoditiUsaha::findOrFail($id)->update([
            'nama' => $request->komoditi,
            'jenis_usaha_id' => $request->jenis_usaha,
        ]);
        return redirect()->route('admin.komoditi-usaha.index')->with('success','Berhasil mengupdate komoditi usaha');
    }

    public function destroy(string $id)
    {
        $komoditi = KomoditiUsaha::findOrFail($id);
        $komoditi->delete();
        return back()->with('success','Berhasil menghapus komoditi usaha');
    }
}
