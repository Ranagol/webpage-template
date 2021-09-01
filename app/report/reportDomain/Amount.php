<?php

namespace App\Report\ReportDomain;

class Amount
{
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
