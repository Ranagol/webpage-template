<?php

namespace App\Controllers;

class ContactController extends Controller
{
    /**
     * Loads the contact page.
     */
    public function contact(): void
    {
        $this->view('contact');
    }
}
