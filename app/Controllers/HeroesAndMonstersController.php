<?php

declare(strict_types=1);

namespace App\Controllers;

class HeroesAndMonstersController extends Controller
{
    /**
     * Displays the Heroes and Monsters page.
     */
    public function heroesAndMonsters(): void
    {
        // Always pass $events (empty array) to avoid undefined variable in view
        $this->view('heroesAndMonsters', 
            [
                'events' => [],
            ]
        );
    }

    public function demonstrate(): void
    {
        $events = $this->startHeroesAndMonsters();
        $this->view(
            'heroesAndMonsters',
            [
                'events' => $events,
            ]
        
        );
    }

    private function startHeroesAndMonsters(): array
    {
        $events = [];
        $events[] = 'The battle begins!';
        $events[] = 'Superman throws a punch at Godzilla.';
        $events[] = 'Godzilla roars and retaliates with a tail swipe.';
        $events[] = 'Superman flies up to avoid the attack.';
        $events[] = 'Godzilla shoots a beam of atomic breath at Superman.';
        $events[] = 'Superman uses his heat vision to counter the attack.';
        $events[] = 'The battle continues with intense action!';
        return $events;
    }
}