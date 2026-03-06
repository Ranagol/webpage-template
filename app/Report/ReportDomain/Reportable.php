<?php

namespace App\Report\ReportDomain;

interface Reportable
{
    /** @return array<string, float> */
    public function getReport(): array;
}
