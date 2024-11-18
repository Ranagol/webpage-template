<?php

namespace App\controllers\webControllers;

use Jenssegers\Blade\Blade;
use App\controllers\webControllers\WebController;

/**
 * PageController is used with simple, basic, descriptive, non-dynamic pages like Home, About us, 
 * Contact pages, where we actually don't get any data from the db, and don't use Models.
 */
class PageController extends WebController
{
    /**
     * Loads the Home page.
     *
     * @return void
     */
    public static function home(): void
    {
        // xdebug_info();//Use this line to check if xdebug is installed and the step debugger is enabled.
        returnView('home');// this is equal to: require 'views/home.view.php';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function about(): void
    {
        $data = 'Some random data about the about page :) , sent by PageController. ';

        require __DIR__ . '/../../../bootstrap/bootBlade.php';
        

        echo $blade->render('about', 
            [
                'title' => 'About Us',
                'data' => $data
            ]
        );
    }

    /**
     * Loads the contact page.
     *
     * @return void
     */
    public static function contact(): void
    {
        returnView('contact');// this is equal to: require 'views/contact.view.php';
    }
}


