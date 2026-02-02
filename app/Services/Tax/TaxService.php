<?php

namespace App\Services\Tax;

class TaxService
{
    public function calculate(float $subtotal): TaxResultDTO{
        $rate = 0.11;

        $taxAmount = $subtotal * $rate;
        $total = $subtotal + $taxAmount;

        return new TaxResultDTO(
            rate: $rate,
            amount: $taxAmount,
            subtotal: $subtotal,
            total: $total
        );
    }
}
