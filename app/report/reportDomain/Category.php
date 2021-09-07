<?php

namespace App\Report\ReportDomain;

class Category
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
