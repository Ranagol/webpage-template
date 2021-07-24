<?php

namespace App\WebControllers;

use app\WebControllers\WebController;

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

        return view('about', compact('data'));//TODO minek ide compact(), mikor a view rogton csinal extract(). Ez nem presipanje iz supljeg u prazno? Meg, hogy kerul a data a controllerbol a weboldalra?
    }

    public static function contact()
    {
        return view('contact');// this is equal to: require 'views/contact.view.php';
    }

    
}
