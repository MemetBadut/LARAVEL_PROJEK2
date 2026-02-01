<?php

namespace App\DTO;

use App\Models\Alamat;
use Illuminate\Support\Collection;

class CheckoutSummaryDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly array $cartItems,
        public readonly Collection $produks,
        public readonly float $subtotal,
        public readonly float $tax,
        public readonly float $total,
        public readonly ?Alamat $alamat,
        public ?string $phone,
    ) {}
}
