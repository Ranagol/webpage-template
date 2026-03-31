<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\GameObjects\GameObject;
use PHPUnit\Framework\TestCase;

class DummyGameObject extends GameObject
{
}

class GameObjectTest extends TestCase
{
    public function testGetClassName(): void
    {
        $obj = new DummyGameObject();
        $this->assertEquals('DummyGameObject', $obj->getClassName());
    }

    public function testIsGameObject(): void
    {
        $obj = new DummyGameObject();
        $this->assertInstanceOf(GameObject::class, $obj);
    }
}
