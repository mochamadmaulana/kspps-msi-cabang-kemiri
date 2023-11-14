<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kantor;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class KantorController extends Controller
{
    public function index()
    {
        $kantor = Kantor::with('user','provinsi','kota_kab','kecamatan','kelurahan')->where('id',Auth::user()->kantor_id)->where('is_pusat',false)->first();
        $branch_manager = User::where('kantor_id',Auth::user()->kantor_id)->where('role','Branch Manager')->first();
        return view('admin.kantor.index',[
            'kantor' => $kantor,
            'branch_manager' => $branch_manager,
            'jumlah_karyawan' => count($kantor->user)
        ]);
    }

    public function edit(string $id)
    {
        $kantor = Kantor::with('provinsi','kota_kab','kecamatan','kelurahan')->where('id',$id)->first();
        $kecamatan = Kecamatan::orderBy('nama_kecamatan')->where('kota_id',$kantor->kota_kab_id)->get();
        return view('admin.kantor.edit',[
            'kantor' => $kantor,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required","email","unique:kantor,email,".$id.",id"],
            "no_telepone" => ["required","numeric","unique:kantor,no_telepone,".$id.",id"],
            "alamat" => ["nullable","max:300"],
            "kecamatan" => ["required"],
            "kelurahan" => ["required"],
            "rt_rw" => ["required","max:7"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate kantor!')->withErrors($validator)->withInput();
        }
        $kantor = Kantor::findOrFail($id);
        $kantor->email = $request->email;
        $kantor->no_telepone = $request->no_telepone;
        $kantor->alamat = $request->alamat ?? null;
        $kantor->kecamatan_id = $request->kecamatan;
        $kantor->kelurahan_id = $request->kelurahan;
        $kantor->rt_rw = $request->rt_rw;
        $kantor->update();
        return redirect()->route('admin.kantor.index')->with('success','Berhasil mengupdate kantor');
    }

    public function upload_foto(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'file_foto_upload' => ['required','mimes:png,jpg,jpeg'],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupload foto!')->withErrors($validator)->withInput();
        }
        $kantor = Kantor::findOrFail($id);
        $uuid_kantor = $kantor->uuid;
        $foto_upload = $request->file('file_foto_upload');
        if (!empty($foto_upload)) {
            $hash_name = $foto_upload->hashName();
            $foto_upload->storeAs('public/image/kantor/', $uuid_kantor . '/' . $hash_name);
            $kantor->update([
                'foto' => $hash_name
            ]);
            return back()->with('success','Berhasil mengupload foto');
        }
    }

    public function edit_foto(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'file_foto_edit' => ['required','mimes:png,jpg,jpeg'],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengedit foto!')->withErrors($validator)->withInput();
        }
        $foto_edit = $request->file('file_foto_edit');
        $kantor = Kantor::findOrFail($id);
        $uuid_kantor = $kantor->uuid;
        $path_foto = $uuid_kantor . '/' . $kantor->foto;
        if (File::exists(storage_path('app/public/image/kantor/'. $path_foto))){
            unlink(storage_path('app/public/image/kantor/'.$path_foto));
            if (!empty($foto_edit)) {
                $hash_name = $foto_edit->hashName();
                $path_new_foto = $kantor->uuid . '/' . $hash_name;
                $foto_edit->storeAs('public/image/kantor/',$path_new_foto);
                $kantor->update([
                    'foto' => $hash_name
                ]);
                return back()->with('success','Berhasil mengedit foto');
            }else{
                return back()->with('error','Terjadi kesalahan, silahkan coba kembali!');
            }
        }else{
            return back()->with('error','Terjadi kesalahan, silahkan coba kembali!');
        }
    }

    public function delete_foto(string $id)
    {
        $kantor = Kantor::findOrFail($id);
        $path_foto = $kantor->uuid . '/' . $kantor->foto;
        if (File::exists(storage_path('app/public/image/kantor/'.$path_foto))){
            unlink(storage_path('app/public/image/kantor/'.$path_foto));
            $kantor->update([
                'foto' => null
            ]);
            return back()->with('success','Berhasil menghapus foto');
        }else{
            return back()->with('error','Terjadi kesalahan, silahkan coba kembali!');
        }
    }
}
