<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Loads the Home page.
     *
     * @return void
     */
    public function home(): void
    {
        //Use this line to check if xdebug is installed and the step debugger is enabled.
        // xdebug_info();

        $this->view('home');
    }
}
