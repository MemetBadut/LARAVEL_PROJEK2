<?php

namespace App\Service;

class StockStatusService
{
    public static function getStatus(int $stok): string
    {
        if($stok === 0){
            return 'habis';
        }
        if($stok <= 10){
            return 'hampir_habis';
        }

        return 'tersedia';
    }
}
