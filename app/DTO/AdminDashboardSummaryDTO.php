<?php

namespace App\DTO;

class AdminDashboardSummaryDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $totalStok,
        public int $totalProduk,
        public int $habis,
        public int $hampirHabis,
        public int $penjualan,
        public int $customer,
        public int $pending
    ) {}
}
