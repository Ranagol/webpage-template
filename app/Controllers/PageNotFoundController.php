<?php

namespace App\Controllers;

class PageNotFoundController extends Controller
{
    /**
     * Loads the 404 page.
     */
    public function loadPage(): void
    {
        $this->view('404');
    }
}
