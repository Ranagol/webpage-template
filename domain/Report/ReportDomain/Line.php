<?php

declare(strict_types=1);

namespace Domain\Report\ReportDomain;

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
    }

    public function getLineSum(): float
    {
        $price = $this->getPrice()->getPrice();
        $amount = $this->getAmount()->getAmount();
        $result = $price * $amount;

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
