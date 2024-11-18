<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class AboutController extends Controller
{
    /**
     * Displays the About page.
     * 
     * @return void
     */
    public function about(): void
    {
        $data = 'Some random data for the about page , sent by AboutController.';

        $this->view(
            'about', 
            [
                'title' => 'About Us',
                'data' => $data
            ]
        );
    }
}
