<?php

declare(strict_types=1);

namespace App\Controllers;

class TrainController extends Controller
{
    /**
     * Loads the Train task page.
     */
    public function loadPage(): void
    {
        $this->view('trainTask');
    }
}
