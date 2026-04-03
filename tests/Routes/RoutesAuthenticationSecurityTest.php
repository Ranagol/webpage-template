<?php

declare(strict_types=1);

namespace Tests\Routes;

use PHPUnit\Framework\TestCase;

final class RoutesAuthenticationSecurityTest extends TestCase
{
    public function testLogoutRouteIsPostOnly(): void
    {
        $routesFile = __DIR__ . '/../../routes/routesAuthentication.php';
        $contents = file_get_contents($routesFile);

        $this->assertIsString($contents);
        $this->assertStringContainsString('$router->post(\'/logout\'', $contents);
        $this->assertStringNotContainsString('$router->get(\'/logout\'', $contents);
    }
}
