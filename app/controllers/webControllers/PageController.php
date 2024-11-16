<?php

namespace App\controllers\webControllers;

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
    public static function about(): void
    {
        
        $data = 'Some random data for the about page - sent by PageController. ';

        /**
         * The compact() function creates an assoc array from variables and their values.
         * Example: compact('data') will create an array like this: 
         * ['data' => 'Some random data for the about page - sent by PageController.'].
         * Now this array above is sent to the view page.
         */
        returnView('about', compact('data'));
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
