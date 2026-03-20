<?php

declare(strict_types=1);

namespace App\Report\ReportDomain;

interface Reportable
{
    /** @return array<string, float> */
    public function getReport(): array;
}
