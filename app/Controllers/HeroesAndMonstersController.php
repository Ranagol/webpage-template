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

        $this->view('heroesAndMonsters');
    }
}