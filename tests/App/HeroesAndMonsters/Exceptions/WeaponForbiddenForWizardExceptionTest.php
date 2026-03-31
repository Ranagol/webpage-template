<?php

declare(strict_types=1);

use App\HeroesAndMonsters\Exceptions\WeaponForbiddenForWizardException;
use PHPUnit\Framework\TestCase;

class WeaponForbiddenForWizardExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $e = new WeaponForbiddenForWizardException();
        $this->assertStringContainsString('forbidden for wizard', $e->getMessage());
    }
}
