<?php

namespace App\controllers\apiControllers;

use App\models\User;//This is an Eloquent modell
use System\request\RequestInterface;
use App\controllers\apiControllers\ApiController;
use System\response\apiResponse\userResponse\UserApiResponse;

/**
 * This controller is used for API requests, regarding user CRUD operations. Basically this 
 * controller is used, when we send a API user related request from the Postman to our app.
 */
class UserApiController extends ApiController
{
    public static function index(): void
    {
        $users = User::all();
        UserApiResponse::send($users);
    }

    public static function show(string $id): void
    {
        $user = User::find($id);
        UserApiResponse::send($user);
    }

    /**
     * How to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     * 
     * Here we want to create a new user. For that, a POST request must be sent. A POST request
     * has some private data (about the user that we want to create.) We must get this private data
     * (simple GET request don't have this issue.) This is happening in the routesApi.php. Here,
     * for every POST request, this will happen:
     * 
     * UserApiController::store(new ApiRequest());
     * 
     * A new ApiRequest object will be created. This object will have all POST data, and it will
     * be passed as argument to this store method here. This here and now is the $apiRequest object.
     *
     * @return void
     */
    public static function store(RequestInterface $apiRequest): void//this here is not an injection, just a type hinting!
    {
        $arrayRequestData = $apiRequest->getAllRequestData();
        User::create($arrayRequestData);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;//get the id of the newly create user
        UserApiResponse::send($savedUserId);//send back the id of the newly created user
    }

    public static function update(RequestInterface $request): void
    {
        $id = $request->get('id');
        $user = User::find($id);
        $data = $request->getAllRequestData();
        unset ($data['id']);//because we don't want to update the user id...
        $user->update($data);
        UserApiResponse::send('id ' . $id . ' was updated.');
    }

    public static function delete(string $id): void
    {
        User::destroy($id);
        UserApiResponse::send('id ' . $id . ' was deleted.');
    }
}
