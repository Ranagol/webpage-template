<?php

namespace api\controllers;

use models\User;
use api\controllers\ApiController;

class UserApiController extends ApiController
{
    public static function index()
    {
        $users = User::all();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($users);

        return $response;
    }
}
