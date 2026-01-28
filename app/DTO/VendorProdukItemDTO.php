<?php

namespace App\DTO;

class VendorProdukItemDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $nama,
        public int $stok,
        public string $status
    ) {}
}
