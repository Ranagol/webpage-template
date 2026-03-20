<?php

declare(strict_types=1);

namespace App\Report\ReportDomain;

class Category
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    /**
     * Get the value of category.
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set the value of category.
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
