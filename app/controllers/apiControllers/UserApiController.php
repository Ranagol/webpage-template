<?php

namespace App\controllers\apiControllers;

use App\models\User;
use System\request\RequestInterface;
use App\controllers\apiControllers\ApiController;
use System\response\apiResponse\userResponse\UserApiResponse;

/**
 * This controller is used for API requests, regarding user CRUD operations. Basically this 
 * controller is used, when we send a API user related request from the Postman to our app.
 */
class UserApiController extends ApiController
{
    public function index(): void
    {
        $users = User::all();
        UserApiResponse::send($users);
    }

    public function show(string $id): void
    {
        $user = User::find($id);
        UserApiResponse::send($user);
    }

    /**
     * How to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     *
     * @return void
     */
    public function store(RequestInterface $request): void
    {
        $arrayRequestData = $request->getAllRequestData();
        User::create($arrayRequestData);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;//get the id of the newly create user
        UserApiResponse::send($savedUserId);//send back the id of the newly created user
    }

    public function update(RequestInterface $request): void
    {
        $id = $request->get('id');
        $user = User::find($id);
        $data = $request->getAllRequestData();
        unset ($data['id']);//because we don't want to update the user id...
        $user->update($data);
        UserApiResponse::send('id ' . $id . ' was updated.');
    }

    public function delete(string $id): void
    {
        User::destroy($id);
        UserApiResponse::send('id ' . $id . ' was deleted.');
    }
}
