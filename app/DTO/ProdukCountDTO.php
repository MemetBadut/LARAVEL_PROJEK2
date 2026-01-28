<?php

namespace App\DTO;

class ProdukCountDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $stokReady,
        public int $stokLow,
    )
    {
    }
}
