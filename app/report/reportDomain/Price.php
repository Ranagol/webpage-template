<?php

namespace App\Report\ReportDomain;

class Price
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
