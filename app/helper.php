<?php

if(!function_exists('rupiah')){
    function rupiah($angka){
        if($angka === null) return '-';
        return 'Rp' . number_format($angka, 0, ',', '.');
    }
}
