<?php

declare(strict_types=1);

namespace Tests\Domain\Report;

use Domain\Report\ReportDomain\Category;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CategoryTest extends TestCase
{
    public function testConstructorStoresCategory(): void
    {
        // Arrange & Act
        $category = new Category('Electronics');

        // Assert
        $this->assertSame('Electronics', $category->getCategory());
    }

    public function testSetCategoryUpdatesStoredValue(): void
    {
        // Arrange
        $category = new Category('Books');

        // Act
        $category->setCategory('Music');

        // Assert
        $this->assertSame('Music', $category->getCategory());
    }

    public function testSetCategoryReturnsFluentSelf(): void
    {
        // Arrange
        $category = new Category('A');

        // Act
        $result = $category->setCategory('B');

        // Assert
        $this->assertSame($category, $result);
    }

    public function testEmptyStringCategoryIsAccepted(): void
    {
        // Arrange & Act
        $category = new Category('');

        // Assert
        $this->assertSame('', $category->getCategory());
    }

    public function testCategoryWithSpecialCharacters(): void
    {
        // Arrange & Act
        $category = new Category('Food & Drink / Beverages');

        // Assert
        $this->assertSame('Food & Drink / Beverages', $category->getCategory());
    }

    /** @return array<string, array{string}> */
    public static function categoryProvider(): array
    {
        return [
            'empty string' => [''],
            'single word' => ['Electronics'],
            'with spaces' => ['Home Appliances'],
            'special characters' => ['Books & More!'],
            'unicode' => ['Electronique'],
        ];
    }

    #[DataProvider('categoryProvider')]
    public function testSetCategoryRoundTrip(string $value): void
    {
        // Arrange
        $category = new Category('initial');

        // Act
        $category->setCategory($value);

        // Assert
        $this->assertSame($value, $category->getCategory());
    }
}
