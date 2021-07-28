<?php

namespace App\controllers\webControllers;

use App\controllers\webControllers\WebController;

class PageController extends WebController
{
    public static function home()
    {
        return view('home');// this is equal to: require 'views/contact.view.php';
    }

    /**
     * The compact() function creates an array from variables and their values.
     * It takes a string as an argument.
     *
     * @return void
     */
    public static function about()
    {
        $data = 'Some random data about the about page :) ';

        return view('about', compact('data'));
    }

    public static function contact()
    {
        return view('contact');// this is equal to: require 'views/contact.view.php';
    }
}
