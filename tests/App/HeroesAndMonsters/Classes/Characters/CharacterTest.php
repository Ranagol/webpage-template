<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\Characters\Character;
use PHPUnit\Framework\TestCase;

class DummyCharacter extends Character
{
    public function __construct()
    {
        $this->health = 100;
    }
}

class CharacterTest extends TestCase
{
    public function testHealth(): void
    {
        $char = new DummyCharacter();
        $this->assertEquals(100, $char->getHealth());
        $char->decreaseHealth(10);
        $this->assertEquals(90, $char->getHealth());
        $char->setHealth(50);
        $this->assertEquals(50, $char->getHealth());
        $this->assertTrue($char->isAlive());
        $char->setHealth(0);
        $this->assertFalse($char->isAlive());
    }

    public function testIsCharacter(): void
    {
        $char = new DummyCharacter();
        $this->assertInstanceOf(Character::class, $char);
    }
}
