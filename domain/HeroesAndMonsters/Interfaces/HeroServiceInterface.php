<?php

declare(strict_types=1);

namespace Domain\HeroesAndMonsters\Interfaces;

interface HeroServiceInterface
{
    /**
     * @return string[]
     */
    public function startHeroesAndMonsters(): array;
}
