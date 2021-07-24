<?php

namespace App\WebControllers;

use app\models\User;
use app\WebControllers\WebController;

class UserWebController extends WebController
{
    public static function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('index', compact('users'));
    } 
    
    public static function show($id)
    {
        $user = User::find($id);

        return view('show', compact('user'));
    }

    public static function create()
    {
        return view('create');
    }   

    public static function store(Request $request)
    {
    }   

    public static function update()
    {
        return view('update');
    }   

    /**
     * 
    * Most browser do not support DELETE as method parameter for <form ...>
    * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
    * So instead of DELETE method, we use POST method
     * 
     * @param [type] $id
     * @return void
     */
    public static function delete($id)
    {
        User::destroy($id);

        return redirect('users');//this is a route, not a file
    }
}
