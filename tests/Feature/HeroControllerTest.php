<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use App\Controllers\HeroController;
use Domain\HeroesAndMonsters\Services\HeroService;
use PHPUnit\Framework\TestCase;

final class HeroControllerTest extends TestCase
{
    public function testLoadPage(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $heroController = new HeroController(new HeroService());

        // Capture output
        ob_start();
        $heroController->loadPage();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the heroes and monsters view
        $this->assertStringContainsString('Challenge 4: Heroes and Monsters', $output);
    }

    public function testFullHeroesAndMonstersLogicWithFighting(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $heroController = new HeroController(new HeroService());

        $events = $heroController->heroService->startHeroesAndMonsters();
        $this->assertNotEmpty($events);
        // Assert that the events contain expected log entries
        $this->assertContains('Game started!', $events);
        $this->assertContains('The fight has ended.', $events);
        $this->assertContains('Game ended.', $events);
    }

    public function testDemonstrateLoadsViewWithEvents(): void
    {
        // Bootstrap the app (no session, no output)
        Application::bootstrap();

        $heroController = new HeroController(new HeroService());

        // Capture output
        ob_start();
        $heroController->demonstrate();
        $output = ob_get_clean();

        // Assert that the output contains expected text from the heroes and monsters view
        $this->assertStringContainsString('Challenge 4: Heroes and Monsters', $output);
        // Assert that the output contains some of the events from the demonstration
        $this->assertStringContainsString('Game started!', $output);
        $this->assertStringContainsString('The fight has ended.', $output);
        $this->assertStringContainsString('Game ended.', $output);
    }
}
