<?php

declare(strict_types=1);

namespace App\Report\ReportDomain;

class Line
{
    private Category $category;

    private Price $price;

    private Amount $amount;

    public function __construct(Category $category, Price $price, Amount $amount)
    {
        $this->category = $category;
        $this->price = $price;
        $this->amount = $amount;
        $x = 8;
    }

    public function getLineSum(): float
    {
        $price = $this->getPrice()->getPrice();
        $amount = $this->getAmount()->getAmount();
        $result = $price * $amount;
        $c = 8;

        return $result;
    }

    /**
     * Get the value of category.
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Get the value of price.
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * Get the value of amount.
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }
}
