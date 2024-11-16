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
        $t = 8;
        returnView('home');// this is equal to: require 'views/home.view.php';
    }

    /**
     * 
     *
     * @return void
     */
    public static function about()
    {
        $data = 'Some random data about the about page :) , sent by PageController. ';

        require __DIR__ . '/../../../bootstrap/bootBlade.php';

        // die(var_dump($blade));//this is ok, $blade is here

        

        // Debugging statement
        echo "Reached before rendering the view";

        //todo LOSI HELP

        try {
            return $blade->render('about', 
                [
                    'title' => 'About Us',
                    'data' => $data
                ]
            );
        } catch (\Throwable $th) {
            var_dump($th);
        }
        

        // Debugging statement
        echo "Reached after rendering the view";
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
