<?php

namespace App\WebControllers;

use App\WebControllers\WebController;

class UserWebController extends WebController
{
    public static function index()
    {
        return view('index');
    } 
    
    public static function show()
    {
        return view('show');
    }

    public static function store()
    {
        return view('create');
    }   

    public static function update()
    {
        return view('update');
    }   

    public static function delete()
    {
        return view('index');
    }   
}
