<?php

namespace api\controllers;

use models\User;
use api\controllers\ApiController;

class UserApiController extends ApiController
{
    /**
     * When we want to create a json response in our vanilla api, we
     * must do two things.
     * 1. the needed data has to be transformed into json, with json_encode
     * 2. we must tell php the handle our response as a json. We do this by setting the header like
     * header("Content-Type: application/json");
     *
     * @return void
     */
    public static function index()
    {
        $users = User::all();
        self::createResponse($users);
    }

    public static function show($id)
    {
        $user = User::find($id);
        self::createResponse($user);
    }

    /**
     * How to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     *
     * @return void
     */
    public static function store()
    {
        $rawJsonData = file_get_contents('php://input');
        $rawJsonData = str_replace([PHP_EOL, ",}"], ["", "}"], $rawJsonData);
        $request = json_decode($rawJsonData, false);
        User::insert([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;
        self::createResponse($savedUserId);
    }

    

    private static function createResponse($data)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($data);

        header("Content-Type: application/json");
        if ($response['body']) {
            echo $response['body'];//TODO hogy kell helyesen response-ot csinalni itt?
        }
    }
}
