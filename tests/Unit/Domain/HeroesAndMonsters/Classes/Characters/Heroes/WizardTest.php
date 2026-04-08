<?php

declare(strict_types=1);

namespace Tests\Domain\HeroesAndMonsters\Classes\Characters\Heroes;

use Domain\HeroesAndMonsters\Classes\Characters\Heroes\Wizard;
use Domain\HeroesAndMonsters\Classes\GameObjects\Magic;
use PHPUnit\Framework\TestCase;

class WizardTest extends TestCase
{
    public function testWizardHealth(): void
    {
        $wizard = new Wizard();
        $this->assertEquals(50, $wizard->getHealth());
    }

    public function testGetAttackTypeWithoutMagic(): void
    {
        $wizard = new Wizard();
        $attack = $wizard->getAttackType();
        $this->assertEquals([
            'attackType' => 'Bare hands',
            'damage' => 1,
        ], $attack);
    }

    public function testLearnMagicAndAttackType(): void
    {
        $wizard = new Wizard();
        $magic = new Magic();
        $wizard->learnMagic($magic);
        $attack = $wizard->getAttackType();
        $this->assertEquals('Magic', $attack['attackType']);
        $this->assertEquals(30, $attack['damage']);
    }
}
