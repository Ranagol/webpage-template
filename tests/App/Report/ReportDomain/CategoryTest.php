<?php

declare(strict_types=1);

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\Category;
use PHPUnit\Framework\TestCase;

final class CategoryTest extends TestCase
{
    public function testCategoryGetterAndSetter(): void
    {
        $category = new Category('food');

        $this->assertSame('food', $category->getCategory());

        $category->setCategory('travel');

        $this->assertSame('travel', $category->getCategory());
    }
}
