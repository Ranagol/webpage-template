<?php

namespace App\controllers\webControllers;

use App\controllers\webControllers\WebController;

/**
 * PageController is used with pages like Home, About us, Contact pages, where we actually don't
 * get any data from the db, and don't use Models.
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
        returnView('home');// this is equal to: require 'views/contact.view.php';
    }

    /**
     * The compact() function creates an array from variables and their values.
     * It takes a string as an argument.
     *
     * @return void
     */
    public static function about(): void
    {
        $data = 'Some random data about the about page :) ';

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
