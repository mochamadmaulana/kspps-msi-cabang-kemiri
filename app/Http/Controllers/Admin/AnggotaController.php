<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlamatAnggota;
use App\Models\Anggota;
use App\Models\Kota;
use App\Models\Majlis;
use App\Models\PendaftaranAnggota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use HelpAnggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('majlis','pendaftaran_anggota','pendaftaran_anggota.penginput')->where('kantor_id',Auth::user()->kantor_id)->orderBy('id','DESC')->paginate(10)->onEachSide(0)->withQueryString();
        $majlis = Majlis::orderBy('nama')->get();
        $pendaftaran = PendaftaranAnggota::whereIsSubmit(false)->whereKantorId(Auth::user()->kantor_id)->first();
        return view('admin.anggota.index', [
            'anggota' => $anggota,
            'majlis' => $majlis,
            'pendaftaran' => $pendaftaran
        ]);
    }

    public function create_pendaftaran()
    {
        $nomor_daftar = HelpAnggota::create_no_pendaftaran(Auth::user()->kantor_id);
        $pendaftaran = PendaftaranAnggota::create([
            'nomor_daftar' => $nomor_daftar,
            'penginput_id' => Auth::user()->id,
            'kantor_id' => Auth::user()->kantor_id,
        ]);
        return redirect()->route('admin.anggota.index-pendaftaran',$pendaftaran->nomor_daftar)->with('success','Berhasil membuat nomor pendaftaran');
    }

    public function index_pendaftaran(String $nomor_daftar)
    {
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first() ?? null;
        $anggota = Anggota::with('pendaftaran_anggota')->wherePendaftaranAnggotaId($pendaftaran->id)->whereKantorId(Auth::user()->kantor_id)->first() ?? null;
        $alamat_identitas = !empty($anggota) ? AlamatAnggota::whereAnggotaId($anggota->id)->first() : null;
        return view('admin.anggota.pendaftaran.index',[
            'pendaftaran' => $pendaftaran,
            'anggota' => $anggota,
            'alamat_identitas' => $alamat_identitas
        ]);
    }

    public function input_pendaftaran_tahap_satu(String $nomor_daftar)
    {
        $majlis = Majlis::orderBy('kode')->get();
        $tempat_lahir = Kota::get();
        return view('admin.anggota.pendaftaran.tahap-1.input',[
            'nomor_daftar' => $nomor_daftar,
            'majlis' => $majlis,
            'tempat_lahir' => $tempat_lahir
        ]);
    }

    public function store_pendaftaran_tahap_satu(Request $request, String $nomor_daftar)
    {
        $validator = Validator::make($request->all(), [
            "jenis_keanggotaan" => ["required"],
            "majlis" => ["required"],
            "nomor_kartu_keluarga" => ["required","max:20"],
            "jenis_identitas" => ["required"],
            "nomor_identitas" => ["required","numeric","unique:anggota,nomor_identitas"],
            "nama_lengkap" => ["required","max:100"],
            "tempat_lahir" => ["required"],
            "tanggal_lahir" => ["required"],
            "jenis_kelamin" => ["required"],
            "email" => ["nullable","email"],
            "nomor_telepone" => ["required","max:15"],
            "agama" => ["required"],
            "status_pernikahan" => ["required"],
            "pendidikan_terakhir" => ["required"],
            "nama_ibu_kandung" => ["required"],
            "nominal_bayar_daftar" => ["required","numeric"],
            "metode_bayar_daftar" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first();
        Anggota::create([
            'kantor_id' => Auth::user()->kantor_id,
            'pendaftaran_anggota_id' => $pendaftaran->id,
            "majlis_id" => $request->majlis,
            'jenis_keanggotaan' => $request->jenis_keanggotaan,
            "jenis_identitas" => $request->jenis_identitas,
            "nomor_identitas" => $request->nomor_identitas,
            "nama_lengkap" => $request->nama_lengkap,
            "email" => $request->email ?? null,
            "nomor_telepone" => $request->nomor_telepone,
            "tempat_lahir_id" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "agama" => $request->agama,
            "status_pernikahan" => $request->status_pernikahan,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "nama_ibu_kandung" => $request->nama_ibu_kandung,
            "nomor_kartu_keluarga" => $request->nomor_kartu_keluarga,
        ]);
        $pendaftaran->update([
            'tahap_satu' => true,
            'nominal_bayar_daftar' => $request->nominal_bayar_daftar,
            'metode_bayar_daftar' => $request->metode_bayar_daftar,
        ]);
        return redirect()->route('admin.anggota.index-pendaftaran',$nomor_daftar)->with('success','Berhasil menyimpan tahap 1');
    }

    public function edit_pendaftaran_tahap_satu(String $nomor_daftar)
    {
        $majlis = Majlis::orderBy('kode')->get();
        $tempat_lahir = Kota::get();
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first();
        $anggota = Anggota::with('pendaftaran_anggota')->wherePendaftaranAnggotaId($pendaftaran->id)->whereKantorId(Auth::user()->kantor_id)->first();
        return view('admin.anggota.pendaftaran.tahap-1.edit',[
            'pendaftaran' => $pendaftaran,
            'majlis' => $majlis,
            'tempat_lahir' => $tempat_lahir,
            'anggota' => $anggota,
        ]);
    }

    public function update_pendaftaran_tahap_satu(Request $request, String $nomor_daftar, String $id_pendaftaran)
    {
        $validator = Validator::make($request->all(), [
            "jenis_keanggotaan" => ["required"],
            "majlis" => ["required"],
            "nomor_kartu_keluarga" => ["required","max:20"],
            "jenis_identitas" => ["required"],
            "nomor_identitas" => ["required","numeric","unique:anggota,nomor_identitas,".$id_pendaftaran.",pendaftaran_anggota_id"],
            "nama_lengkap" => ["required","max:100"],
            "tempat_lahir" => ["required"],
            "tanggal_lahir" => ["required"],
            "jenis_kelamin" => ["required"],
            "email" => ["nullable","email"],
            "nomor_telepone" => ["required","max:15"],
            "agama" => ["required"],
            "status_pernikahan" => ["required"],
            "pendidikan_terakhir" => ["required"],
            "nama_ibu_kandung" => ["required"],
            "nominal_bayar_daftar" => ["required","numeric"],
            "metode_bayar_daftar" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first();
        Anggota::wherePendaftaranAnggotaId($id_pendaftaran)->update([
            "majlis_id" => $request->majlis,
            'jenis_keanggotaan' => $request->jenis_keanggotaan,
            "jenis_identitas" => $request->jenis_identitas,
            "nomor_identitas" => $request->nomor_identitas,
            "nama_lengkap" => $request->nama_lengkap,
            "email" => $request->email ?? null,
            "nomor_telepone" => $request->nomor_telepone,
            "tempat_lahir_id" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "agama" => $request->agama,
            "status_pernikahan" => $request->status_pernikahan,
            "pendidikan_terakhir" => $request->pendidikan_terakhir,
            "nama_ibu_kandung" => $request->nama_ibu_kandung,
            "nomor_kartu_keluarga" => $request->nomor_kartu_keluarga,
        ]);
        $pendaftaran->update([
            'nominal_bayar_daftar' => $request->nominal_bayar_daftar,
            'metode_bayar_daftar' => $request->metode_bayar_daftar,
        ]);
        return redirect()->route('admin.anggota.index-pendaftaran',$nomor_daftar)->with('success','Berhasil mengupdate tahap 1');
    }

    public function input_pendaftaran_tahap_dua(String $nomor_daftar)
    {
        $provinsi = Provinsi::orderBy('nama_provinsi')->get();
        return view('admin.anggota.pendaftaran.tahap-2.input',[
            'nomor_daftar' => $nomor_daftar,
            'provinsi' => $provinsi,
        ]);
    }

    public function store_pendaftaran_tahap_dua(Request $request ,string $nomor_daftar)
    {
        $validator = Validator::make($request->all(), [
            "provinsi" => ["required"],
            "kota_kabupaten" => ["required"],
            "kecamatan" => ["required"],
            "kelurahan" => ["required"],
            "kode_pos" => ["required"],
            "rt_rw" => ["required","max:7"],
            "alamat" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first();
        $anggota = Anggota::wherePendaftaranAnggotaId($pendaftaran->id)->whereKantorId(Auth::user()->kantor_id)->first();
        AlamatAnggota::create([
            'anggota_id' => $anggota->id,
            'provinsi_id' => $request->provinsi,
            'kota_kab_id' => $request->kota_kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kelurahan_id' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
        ]);
        $pendaftaran->update(['tahap_dua'=>true]);
        return redirect()->route('admin.anggota.index-pendaftaran',$nomor_daftar)->with('success','Berhasil menyimpan tahap 2');
    }

    public function edit_pendaftaran_tahap_dua(String $nomor_daftar)
    {
        $provinsi = Provinsi::orderBy('nama_provinsi')->get();
        $pendaftaran = PendaftaranAnggota::whereNomorDaftar($nomor_daftar)->wherePenginputId(Auth::user()->id)->whereIsSubmit(false)->first();
        $anggota = Anggota::wherePendaftaranAnggotaId($pendaftaran->id)->whereKantorId(Auth::user()->kantor_id)->first();
        $alamat_identitas = AlamatAnggota::with('provinsi','kota','kecamatan','kelurahan')->whereAnggotaId($anggota->id)->first();
        return view('admin.anggota.pendaftaran.tahap-2.edit',[
            'provinsi' => $provinsi,
            'nomor_daftar' => $nomor_daftar,
            'alamat_identitas' => $alamat_identitas,
        ]);
    }

    public function update_pendaftaran_tahap_dua(Request $request, string $nomor_daftar, String $id_alamat)
    {
        $validator = Validator::make($request->all(), [
            "kode_pos" => ["required"],
            "rt_rw" => ["required","max:7"],
            "alamat" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        AlamatAnggota::findOrFail($id_alamat)->update([
            'kode_pos' => $request->kode_pos,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('admin.anggota.index-pendaftaran',$nomor_daftar)->with('success','Berhasil mengupdate tahap 2');
    }

    public function update_pendaftaran_alamat_identitas(Request $request, String $id_alamat)
    {
        $validator = Validator::make($request->all(), [
            "provinsi" => ["required"],
            "kota_kabupaten" => ["required"],
            "kecamatan" => ["required"],
            "kelurahan" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupdate, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        AlamatAnggota::findOrFail($id_alamat)->update([
            'provinsi_id' => $request->provinsi,
            'kota_kab_id' => $request->kota_kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kelurahan_id' => $request->kelurahan,
        ]);
        return back()->with('success','Berhasil mengupdate alamat identitas');
    }

    public function upload_file_identitas(Request $request, String $id_anggota)
    {
        $validator = Validator::make($request->all(), [
            "file_identitas" => ["required","file","mimes:png,jpg,jpeg,pdf","max:10240"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupload, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        if($request->hasFile('file_identitas')){
            $anggota = Anggota::findOrFail($id_anggota);
            if(!empty($anggota)){
                $file_upload = $request->file('file_identitas');
                $hash_name = $file_upload->hashName();
                $file_upload->storeAs('public/galery-file/anggota/',$hash_name);
                $anggota->update(['file_identitas' => $hash_name]);
                return back()->with('success','Berhasil mengupload file identitas');
            }else{
                return back()->with('error','Error 500, Gagal mengupload file identitas!');
            }
        }else{
            return back()->with('error','Error 500, Gagal mengupload file identitas!');
        }
    }

    public function destroy_file_identitas(String $id_anggota)
    {
        $anggota = Anggota::findOrFail($id_anggota);
        if(!empty($anggota) && !empty(File::exists(public_path('storage/galery-file/anggota/'.$anggota->file_identitas)))){
            unlink(public_path('storage/galery-file/anggota/'.$anggota->file_identitas));
            $anggota->update(['file_identitas' => null]);
            return back()->with('success','Berhasil menghapus file identitas');
        }else{
            return back()->with('error','Terdapat kesalahan saat menghapus, silahkan coba kembali!');
        }
    }

    public function upload_file_selfie_identitas(Request $request, String $id_anggota)
    {
        $validator = Validator::make($request->all(), [
            "file_selfie_identitas" => ["required","file","mimes:png,jpg,jpeg,pdf","max:10240"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupload, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        if($request->hasFile('file_selfie_identitas')){
            $anggota = Anggota::findOrFail($id_anggota);
            if(!empty($anggota)){
                $file_upload = $request->file('file_selfie_identitas');
                $hash_name = $file_upload->hashName();
                $file_upload->storeAs('public/galery-file/anggota/',$hash_name);
                $anggota->update(['file_selfie_identitas' => $hash_name]);
                return back()->with('success','Berhasil mengupload file identitas');
            }else{
                return back()->with('error','Error 500, Gagal mengupload file selfie identitas!');
            }
        }else{
            return back()->with('error','Error 500, Gagal mengupload file selfie identitas!');
        }
    }

    public function destroy_file_selfie_identitas(String $id_anggota)
    {
        $anggota = Anggota::findOrFail($id_anggota);
        if(!empty($anggota) && !empty(File::exists(public_path('storage/galery-file/anggota/'.$anggota->file_selfie_identitas)))){
            unlink(public_path('storage/galery-file/anggota/'.$anggota->file_selfie_identitas));
            $anggota->update(['file_selfie_identitas' => null]);
            return back()->with('success','Berhasil menghapus file selfie identitas');
        }else{
            return back()->with('error','Terdapat kesalahan saat menghapus, silahkan coba kembali!');
        }
    }

    public function upload_file_kartu_keluarga(Request $request, String $id_anggota)
    {
        $validator = Validator::make($request->all(), [
            "file_kartu_keluarga" => ["required","file","mimes:png,jpg,jpeg,pdf","max:10240"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengupload, periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        if($request->hasFile('file_kartu_keluarga')){
            $anggota = Anggota::findOrFail($id_anggota);
            if(!empty($anggota)){
                $file_upload = $request->file('file_kartu_keluarga');
                $hash_name = $file_upload->hashName();
                $file_upload->storeAs('public/galery-file/anggota/',$hash_name);
                $anggota->update(['file_kartu_keluarga' => $hash_name]);
                return back()->with('success','Berhasil mengupload file kartu keluarga');
            }else{
                return back()->with('error','Error 500, Gagal mengupload file selfie kartu keluarga!');
            }
        }else{
            return back()->with('error','Error 500, Gagal mengupload file selfie kartu keluarga!');
        }
    }

    public function destroy_file_kartu_keluarga(String $id_anggota)
    {
        $anggota = Anggota::findOrFail($id_anggota);
        if(!empty($anggota) && !empty(File::exists(public_path('storage/galery-file/anggota/'.$anggota->file_kartu_keluarga)))){
            unlink(public_path('storage/galery-file/anggota/'.$anggota->file_kartu_keluarga));
            $anggota->update(['file_kartu_keluarga' => null]);
            return back()->with('success','Berhasil menghapus file kartu keluarga');
        }else{
            return back()->with('error','Terdapat kesalahan saat menghapus, silahkan coba kembali!');
        }
    }





    public function create_3(string $no_pendaftaran)
    {
        return view('admin.anggota.tambah-3',compact('no_pendaftaran'));
    }

    public function store_3(Request $request ,string $no_pendaftaran)
    {
        $validator = Validator::make($request->all(), [
            "file" => ["required","file","mimes:png,jpg,jpeg,pdf","max:10240"],
            "upload" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan tahap 3!')->withErrors($validator)->withInput();
        }

        $file_upload = $request->file('file');

        if(!empty($file_upload) && !empty($request->upload)){
            $has_name = $file_upload->hashName();
            $file_upload->storeAs('public/image/anggota/',$has_name);

            $rc_pendaftaran = PendaftaranAnggota::where('no_pendaftaran',$no_pendaftaran)->first();
            $anggota = Anggota::findOrFail($rc_pendaftaran->anggota_id);
            if($request->upload == 'identitas'){
                if (File::exists(public_path('storage/image/anggota/'.$has_name))) {
                    unlink(public_path('storage/arsip/surat-masuk/'.$value->hash_file));
                    FileSuratMasuk::where('id',$value->id)->delete();
                }else{
                    return back()->with('error','Terdapat kesalahan saat menghapus data, silahkan coba kembali!');exit;
                }
                $anggota->update(['foto_identitas' => $has_name]);
            }
            if($request->upload == 'selfie_identitas'){
                $anggota->update(['foto_selfie_identitas' => $has_name]);
            }
            return redirect()->route('admin.anggota.create-4',$no_pendaftaran)->with('success','Berhasil menyimpan data tahap 3, silahkan lanjutkan tahap 4');
        }else{
            return back()->with('error','Gagal menyimpan tahap 3!');
        }
    }

    public function create_tahap_4(string $no_pendaftaran)
    {
        return view('admin.anggota.tambah-tahap-4',compact('no_pendaftaran'));
    }

    public function store_tahap_4(Request $request ,string $no_pendaftaran)
    {
        $validator = Validator::make($request->all(), [
            "tanda_tangan_digital" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan tahap 4!')->withErrors($validator)->withInput();
        }
        $image_parts = explode(";base64", $request->tanda_tangan_digital);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $name_file = uniqid().'.'.$image_type;
        $file = public_path('storage/image/').$no_pendaftaran.'/'.$name_file;
        file_put_contents($file, $image_base64);
        $rc_pendaftaran_anggota = PendaftaranAnggota::where('no_pendaftaran',$no_pendaftaran)->first();
        $anggota = Anggota::where('pendaftaran_anggota_id',$rc_pendaftaran_anggota->id)->first();
        $anggota->update(['tanda_tangan_digital'=>$name_file]);
        $rc_pendaftaran_anggota->update(['tahap_4'=>true]);
        return redirect()->route('admin.anggota.index')->with('success','Berhasil menambahkan anggota baru');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
