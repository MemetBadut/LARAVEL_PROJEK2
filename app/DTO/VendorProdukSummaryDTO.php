<?php

namespace App\DTO;

class VendorProdukSummaryDTO
{
    public function __construct(
        public int $totalProduk,
        public int $totalStok,
        public int $hampirHabis,
        public $produks,
    ) {}
}
