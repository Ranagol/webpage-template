<?php

declare(strict_types=1);

namespace App\HeroesAndMonsters\Classes\Characters\Heroes;

namespace Domain\HeroesAndMonsters\Classes\Characters\Heroes;

use Domain\HeroesAndMonsters\Classes\GameObjects\Magic;
use Domain\HeroesAndMonsters\Classes\GameObjects\Weapon;
use Domain\HeroesAndMonsters\Exceptions\WizardCanNotUseWeaponException;
use Domain\HeroesAndMonsters\Logs\Logger;

class Wizard extends Hero
{
    protected int $health = 50;

    /**
     * When a Wizard learns a magic, it is stored here.
     */
    private ?Magic $magic = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function learnMagic(Magic $magic): void
    {
        $this->magic = $magic;
        Logger::getInstance()->log('Wizard learned new magic.');
    }

    /**
     * Every character, when attacks, must return an array with attackType and damage.
     *
     * @return array{
     *   attackType: string,
     *   damage: int
     *  }
     */
    public function getAttackType(): array
    {
        if (null === $this->magic) {
            return [
                'attackType' => 'Bare hands',
                'damage' => 1,
            ];
        }
        $attackType = $this->magic->getClassName();
        $damage = $this->magic->getDamage();

        return [
            'attackType' => $attackType,
            'damage' => $damage,
        ];

    }

    /**
     * This is here only because of the task. It was stated, that and exception must be thrown, when
     * the Wizard tries to pick up a weapon.
     */
    public function pickUpWeapon(Weapon $weapon): void
    {
        try {
            throw new WizardCanNotUseWeaponException();
        } catch (WizardCanNotUseWeaponException $e) {
            Logger::getInstance()->log('Wizard tried to pick up a weapon, which is forbidden.');
        }
    }
}
