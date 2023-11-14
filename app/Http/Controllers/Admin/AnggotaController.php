<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\JenisUsaha;
use App\Models\Kota;
use App\Models\Majlis;
use App\Models\PendaftaranAnggota;
use App\Models\Provinsi;
use App\Models\User;
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
        // $tanggal = HelpAnggota::create_no_pendaftaran(Auth::user()->kantor_id);
        $majlis = Majlis::orderBy('nama')->get();
        return view('admin.anggota.index', [
            'anggota' => $anggota,
            'majlis' => $majlis,
        ]);
    }

    public function create_step_1(string $tanggal)
    {
        // $jenis_usaha = JenisUsaha::all();
        // $majlis = Majlis::orderBy('kode')->get();
        // $tempat_lahir = Kota::orderBy('nama_kota')->get();
        $kantor_id = Auth::user()->kantor_id;
        $penginput_id = Auth::user()->id;
        $rc_pendaftaran = PendaftaranAnggota::whereTanggalDaftar($tanggal)->wherePenginputId($penginput_id)->whereIsSubmit(false)->first() ?? null;
        if($rc_pendaftaran != null){
            return view('admin.anggota.tambah-1',[
                // 'majlis' => $majlis,
                // 'jenis_usaha' => $jenis_usaha,
                // 'tempat_lahir' => $tempat_lahir,
            ]);
        }else{
            $no_daftar = HelpAnggota::create_no_pendaftaran($kantor_id);
            $tanggal_daftar = substr($no_daftar,0,2).'-'.substr($no_daftar,2,2).'-'.substr($no_daftar,4,2).' '.date('H:i:s');
            $rc_pendaftaran = PendaftaranAnggota::create([
                'nomor_daftar' => $no_daftar,
                'kantor_id' => $kantor_id,
                'penginput_id' => $penginput_id,
                'tanggal_daftar' => $tanggal_daftar
            ]);
            return view('admin.anggota.tambah-1',[
                // 'majlis' => $majlis,
                // 'jenis_usaha' => $jenis_usaha,
                // 'tempat_lahir' => $tempat_lahir,
            ]);
        }
    }

    public function store_step_1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "jenis_keanggotaan" => ["required"],
            "nama_lengkap" => ["required"],
            "jenis_identitas" => ["required"],
            "no_identitas" => ["required","numeric","unique:anggota,no_identitas"],
            "no_telepone" => ["required","max:15"],
            "tempat_lahir" => ["required"],
            "tanggal_lahir" => ["required"],
            "jenis_kelamin" => ["required"],
            "pendidikan_terakhir" => ["required"],
            "agama" => ["required"],
            "status_pernikahan" => ["required"],
            "majlis" => ["required"],
            "nama_ibu_kandung" => ["required"],
            "jenis_usaha" => ["required"],
            "metode_bayar_pendaftaran" => ["required"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal melanjutkan tambah anggota!')->withErrors($validator)->withInput();
        }
        $no_pendaftaran = HelpAnggota::create_no_pendaftaran(Auth::user()->kantor_id);
        $tanggal_daftar = substr($no_pendaftaran,0,2).'-'.substr($no_pendaftaran,2,2).'-'.substr($no_pendaftaran,4,2).' '.date('H:i:s');
        try {
            DB::beginTransaction();
            $anggota = Anggota::create([
                'kantor_id' => Auth::user()->kantor_id,
                'jenis_keanggotaan' => $request->jenis_keanggotaan,
                "nama_lengkap" => $request->nama_lengkap,
                "jenis_identitas" => $request->jenis_identitas,
                "no_identitas" => $request->no_identitas,
                "no_telepone" => $request->no_telepone,
                "tempat_lahir_id" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin,
                "pendidikan_terakhir" => $request->pendidikan_terakhir,
                "agama" => $request->agama,
                "status_pernikahan" => $request->status_pernikahan,
                "majlis_id" => $request->majlis,
                "nama_ibu_kandung" => $request->nama_ibu_kandung,
                "jenis_usaha_id" => $request->jenis_usaha,
                "komoditi_usaha_id" => $request->jenis_usaha,
            ]);
            $pendaftaran = PendaftaranAnggota::create([
                "no_pendaftaran" => $no_pendaftaran,
                "anggota_id" => $anggota->id,
                "kantor_id" => $anggota->kantor_id,
                // "tanggal_daftar" => $tanggal_daftar,
                "penginput_id" => Auth::user()->id,
                "metode_bayar_pendaftaran" => $request->metode_bayar_pendaftaran,
            ]);
            DB::commit();
            return redirect()->route('admin.anggota.create-2',$pendaftaran->no_pendaftaran)->with('success','Berhasil menyimpan, silahkan lanjutkan tahap ke-2');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error','Gagal melanjutkan tambah anggota!')->withErrors($validator)->withInput();
        }
    }

    public function create_2(string $no_pendaftaran)
    {
        $provinsi = Provinsi::orderBy('nama_provinsi')->get();
        return view('admin.anggota.tambah-2',compact('no_pendaftaran','provinsi'));
    }

    public function store_2(Request $request ,string $no_pendaftaran)
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
            return back()->with('error','Gagal menyimpan tahap 2!')->withErrors($validator)->withInput();
        }
        $rc_pendaftaran = PendaftaranAnggota::where('no_pendaftaran',$no_pendaftaran)->first();
        $anggota = Anggota::findOrFail($rc_pendaftaran->anggota_id);
        $anggota->update([
            'provinsi_id' => $request->provinsi,
            'kota_kab_id' => $request->kota_kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kelurahan_id' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('admin.anggota.create-3',$no_pendaftaran)->with('success','Berhasil menyimpan data tahap 2, silahkan lanjutkan tahap 3');
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
