<?php

namespace App\Services\Tax;

class TaxService
{
    public function calculate(float $subtotal): TaxResult{
        $rate = 0.11;

        $taxAmount = $subtotal * $rate;
        $total = $subtotal + $taxAmount;

        return new TaxResult(
            rate: $rate,
            amount: $taxAmount,
            subtotal: $subtotal,
            total: $total
        );
    }
}
