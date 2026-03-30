<?php

declare(strict_types=1);

namespace App\Controllers;

class RawPhpMvcController extends Controller
{
    /**
     * Displays the Raw PHP MVC page.
     */
    public function rawPhpMvc(): void
    {

        $this->view('rawPhpMvc');
    }
}