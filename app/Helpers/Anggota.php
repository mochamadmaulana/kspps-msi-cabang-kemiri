<?php
namespace App\Helpers;

use App\Models\PendaftaranAnggota;

class Anggota {
    public static function create_no_pendaftaran($id_kantor)
    {
        $last_record = PendaftaranAnggota::where('kantor_id',$id_kantor)->orderBy('id','DESC')->first();
        if(!empty($last_record)){
            $rc_no_urut = (int) substr($last_record->no_pendaftaran,7) + 1;
            return date('ymd',time()).$id_kantor.str_pad($rc_no_urut, 4, "0", STR_PAD_LEFT);
        }else{
            return date('ymd',time()).$id_kantor.str_pad(1, 4, "0", STR_PAD_LEFT);
        }
    }

    public static function cek_usia_sama_dengan_lebih($tanggal_lahir, $batas_usia)
    {
        $array_tanggal_lahir = explode('-',$tanggal_lahir);
        $tahunlahir = $array_tanggal_lahir[0];
        $bulanlahir = $array_tanggal_lahir[1];
        $tanggallahir = $array_tanggal_lahir[2];

        $usia_saat_ini = date('Y',time()) - $tahunlahir;
        $bulan = date('m',time()) - $bulanlahir;
        if($bulan <= 0 && date('d',time()) < $tanggallahir){
            $usia_saat_ini = $usia_saat_ini - 1;
        }
        if($usia_saat_ini < $batas_usia){
            return false;
        }else{
            return true;
        }
    }
}
