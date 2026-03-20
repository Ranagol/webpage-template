<?php

declare(strict_types=1);

namespace App\Report\ReportDomain;

class Price
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of price.
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price.
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
