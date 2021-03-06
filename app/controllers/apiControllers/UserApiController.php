<?php

namespace App\controllers\apiControllers;

use App\models\User;
use System\response\ApiResponse;
use System\request\RequestInterface;
use App\controllers\apiControllers\ApiController;

/**
 * This controller is used for API requests, regarding user CRUD operations.
 */
class UserApiController extends ApiController
{
    public function index(): void
    {
        $users = User::all();
        ApiResponse::send($users);
    }

    public function show(string $id): void
    {
        $user = User::find($id);
        ApiResponse::send($user);
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
        $savedUserId = User::orderBy('id', 'desc')->first()->id;
        ApiResponse::send($savedUserId);
    }

    public function update(RequestInterface $request): void
    {
        $id = $request->get('id');
        $user = User::find($id);
        $data = $request->getAllRequestData();
        unset ($data['id']);//because we don't want to update the user id...
        $user->update($data);
        ApiResponse::send('id ' . $id . ' was updated.');
    }

    public function delete(string$id): void
    {
        User::destroy($id);
        ApiResponse::send('id ' . $id . ' was deleted.');
    }
}
