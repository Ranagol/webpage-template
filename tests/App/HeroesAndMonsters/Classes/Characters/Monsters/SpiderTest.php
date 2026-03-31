<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\Characters\Monsters\Spider;
use PHPUnit\Framework\TestCase;

class SpiderTest extends TestCase
{
    public function testSpiderHealth(): void
    {
        $spider = new Spider();
        $this->assertEquals(50, $spider->getHealth());
    }

    public function testSpiderAttackType(): void
    {
        $spider = new Spider();
        $attack = $spider->getAttackType();
        $this->assertArrayHasKey('attackType', $attack);
        $this->assertArrayHasKey('damage', $attack);
    }
}
