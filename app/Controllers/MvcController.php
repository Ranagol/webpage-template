<?php

declare(strict_types=1);

namespace App\Controllers;

class MvcController extends Controller
{
    /**
     * Displays the Raw PHP MVC page.
     */
    public function loadPage(): void
    {

        $this->view('rawPhpMvc');
    }
}
