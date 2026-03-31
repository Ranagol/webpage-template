<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\GameObjects\Magic;
use PHPUnit\Framework\TestCase;

class MagicTest extends TestCase
{
    public function testMagicDamage(): void
    {
        $magic = new Magic();
        $this->assertEquals(30, $magic->getDamage());
    }

    public function testMagicClassName(): void
    {
        $magic = new Magic();
        $this->assertEquals('Magic', $magic->getClassName());
    }

    public function testMagicIsGameObject(): void
    {
        $magic = new Magic();
        $this->assertInstanceOf(App\HeroesAndMonsters\Classes\GameObjects\GameObject::class, $magic);
    }
}
