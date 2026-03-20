<?php

namespace Tests\App\Trains\Input;

require_once dirname(__DIR__) . '/TrainsClassLoader.php';

use App\Trains\Input\StringToLinesConverter;
use PHPUnit\Framework\TestCase;

final class StringToLinesConverterTest extends TestCase
{
    public function testTransformsInputStringIntoTrimmedLines(): void
    {
        $converter = new StringToLinesConverter();

        $data = "2\n5\n3 2\n09:00 12:00\n";
        $lines = $converter->transformStringToLines($data);

        $this->assertSame(['2', '5', '3 2', '09:00 12:00'], $lines);
    }
}
