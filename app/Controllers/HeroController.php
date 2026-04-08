<?php

declare(strict_types=1);

namespace App\Controllers;

use Domain\HeroesAndMonsters\Interfaces\HeroServiceInterface;

class HeroController extends Controller
{
    public function __construct(
        public HeroServiceInterface $heroService,
    ) {
        parent::__construct();
    }

    /**
     * Displays the Heroes and Monsters page. Without the fight event demonstration. This is the
     * default.
     */
    public function loadPage(): void
    {
        // Always pass $events (empty array) to avoid undefined variable in view
        $this->view(
            'heroesAndMonsters',
            [
                'events' => [],
            ]
        );
    }

    /**
     * Displays the Heroes and Monsters page, with the fight event demonstration.
     */
    public function demonstrate(): void
    {
        $events = $this->heroService->startHeroesAndMonsters();
        $this->view(
            'heroesAndMonsters',
            [
                'events' => $events,
            ]
        );
    }
}
