<?php

namespace App\Report\ReportDomain;

use App\Report\ReportDomain\Price;
use App\Report\ReportDomain\Amount;
use App\Report\ReportDomain\Category;

class Line
{
    private $category;

    private $price;

    private $amount;

    public function __construct(Category $category, Price $price, Amount $amount)
    {
        $this->category = $category;
        $this->price = $price;
        $this->amount = $amount;
    }

    public function getLineSum(): int
    {
        return $this->getPrice() * $this->getAmount();
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }
}
