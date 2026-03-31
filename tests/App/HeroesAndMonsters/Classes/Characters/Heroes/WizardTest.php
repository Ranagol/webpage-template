<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Classes\Characters\Heroes\Wizard;
use App\HeroesAndMonsters\Classes\GameObjects\Magic;
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

    public function testPickUpWeaponLogsException(): void
    {
        $wizard = new Wizard();
        $weapon = $this->createMock(App\HeroesAndMonsters\Classes\GameObjects\Weapon::class);
        // No weapons property or bag, just ensure no exception is thrown
        $wizard->pickUpWeapon($weapon);
        $this->addToAssertionCount(1); // Mark as checked for exception
    }

    public function testIsHero(): void
    {
        $wizard = new Wizard();
        $this->assertInstanceOf(App\HeroesAndMonsters\Classes\Characters\Heroes\Hero::class, $wizard);
    }
}
