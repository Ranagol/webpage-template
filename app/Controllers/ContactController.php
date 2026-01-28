<?php

namespace App\Controllers;

class ContactController extends Controller
{
    /**
     * Loads the contact page.
     *
     * @return void
     */
    public function contact(): void
    {
        $this->view('contact');
    }
}
