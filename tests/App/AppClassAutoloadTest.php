<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AppClassAutoloadTest extends TestCase
{
    /**
     * @return array<string, array{0: string, 1: string, 2: string}>
     */
    public static function appFileProvider(): array
    {
        $appDir = dirname(__DIR__, 2) . '/app';
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($appDir));

        $tests = [];

        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $path = $file->getPathname();
            $content = (string) file_get_contents($path);

            [$type, $fqcn] = self::extractSymbol($content);

            $relativePath = str_replace(dirname(__DIR__, 2) . '/', '', $path);
            $tests[$relativePath] = [$path, $type, $fqcn];
        }

        return $tests;
    }

    #[DataProvider('appFileProvider')]
    public function testEveryAppPhpFileDeclaresAutoloadableSymbol(string $path, string $type, string $fqcn): void
    {
        $this->assertNotSame('', $type, "No class/interface/trait found in {$path}");
        $this->assertNotSame('', $fqcn, "Could not resolve FQCN in {$path}");

        $exists = $this->symbolExists($type, $fqcn);

        if (!$exists) {
            require_once $path;
            $exists = $this->symbolExists($type, $fqcn);
        }

        $this->assertTrue($exists, "{$type} {$fqcn} from {$path} is not loadable");
    }

    private function symbolExists(string $type, string $fqcn): bool
    {
        return match ($type) {
            'class' => class_exists($fqcn),
            'interface' => interface_exists($fqcn),
            'trait' => trait_exists($fqcn),
            default => false,
        };
    }

    /**
     * @return array{0: string, 1: string}
     */
    private static function extractSymbol(string $content): array
    {
        $namespace = '';
        if (preg_match('/^\s*namespace\s+([^;]+);/m', $content, $namespaceMatch) === 1) {
            $namespace = trim($namespaceMatch[1]);
        }

        if (
            preg_match(
                '/^\s*(?:abstract\s+|final\s+)?(class|interface|trait)\s+([A-Za-z_][A-Za-z0-9_]*)\b/m',
                $content,
                $symbolMatch
            ) !== 1
        ) {
            return ['', ''];
        }

        $type = trim($symbolMatch[1]);
        $name = trim($symbolMatch[2]);
        $fqcn = $namespace !== '' ? $namespace . '\\' . $name : $name;

        return [$type, $fqcn];
    }
}
