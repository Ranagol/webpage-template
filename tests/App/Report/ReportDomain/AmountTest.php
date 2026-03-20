<?php

declare(strict_types=1);

namespace Tests\App\Report\ReportDomain;

use App\Report\ReportDomain\Amount;
use PHPUnit\Framework\TestCase;

final class AmountTest extends TestCase
{
    public function testAmountGetterAndSetter(): void
    {
        $amount = new Amount(2.0);

        $this->assertSame(2.0, $amount->getAmount());

        $amount->setAmount(4.0);

        $this->assertSame(4.0, $amount->getAmount());
    }
}
