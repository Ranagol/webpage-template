<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Loads the Home page.
     */
    public function loadPage(): void
    {
        $this->view('home');
    }
}