<?php
namespace App\Helpers;

use App\Models\User;

class Karyawan {
    public static function filter_role(array $filter, string $id_kantor, array $except = null)
    {
        $result = [];
        $array_filter = $filter;
        $array_role = User::where('kantor_id',$id_kantor)->pluck('role')->toArray();
        for ($i=0; $i < count($array_filter); $i++) {
            if(!in_array($array_filter[$i],$array_role)){
                array_push($result,$array_filter[$i]);
            }
        }
        if($except){
            foreach ($except as $value) {
                array_push($result,$value);
            }
        }
        return array_values($result);
    }

    public static function str_ucfirst(string $string)
    {
        $array_text = explode(' ',$string);
        $maping = array_map('ucfirst', array_map('strtolower', $array_text));
        return implode(' ',$maping);
    }
}
