<?php

namespace App\Report\ReportDomain;

class Price
{
    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): int
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
