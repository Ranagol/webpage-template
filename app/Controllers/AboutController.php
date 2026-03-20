<?php

declare(strict_types=1);

namespace App\Controllers;

class AboutController extends Controller
{
    /**
     * Displays the About page.
     */
    public function about(): void
    {
        $data = 'Some random data for the about page , sent by AboutController.';

        $this->view(
            'about',
            [
                'title' => 'About Us',
                'data' => $data,
            ]
        );
    }
}
