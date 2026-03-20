<?php

declare(strict_types=1);

namespace App\Controllers;

class TrainTaskController extends Controller
{
    /**
     * Loads the Train task page.
     */
    public function trainTask(): void
    {
        $this->view('trainTask');
    }
}