<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Loads the Home page.
     */
    public function home(): void
    {
        $this->view('home');
    }
}
