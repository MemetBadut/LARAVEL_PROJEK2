<?php

namespace App\Services\Tax;

class TaxResult
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public float $rate,
        public float $amount,
        public float $subtotal,
        public float $total,
    ) {}
}
