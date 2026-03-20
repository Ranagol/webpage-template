<?php

declare(strict_types=1);

namespace App\Report\ReportDomain;

class Amount
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the value of amount.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount.
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
