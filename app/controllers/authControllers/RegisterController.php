<?php

namespace App\controllers\authControllers;

use App\models\User;
use System\request\RequestInterface;


class RegisterController
{
    public static function loadRegisterPage()
    {
        return view('register');
    }

    public static function register(RequestInterface $request)
    {
        $errors = Validator::validate($request);
        $request = $request->getAllRequestData();
        $username = $request['username'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $password = $request['password'];

        if ($errors) {
            return view('register', compact(
                'errors', 
                'username',
                'firstname',
                'lastname',
                'email',
                'password'
            ));
        }

        User::create($request);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;
        
        return view('home');
    }

    
}
