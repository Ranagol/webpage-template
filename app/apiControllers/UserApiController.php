<?php

namespace app\apiControllers;

use app\models\User;
use System\JsonRequest;
use app\apiControllers\ApiController;
use System\JsonResponse;

class UserApiController extends ApiController
{
    public function index()
    {
        $users = User::all();
        JsonResponse::send($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        JsonResponse::send($user);
    }

    /**
     * How to receive JSON POST with PHP: 
     * https://www.geeksforgeeks.org/how-to-receive-json-post-with-php/
     *
     * @return void
     */
    public function store(JsonRequest $request)
    {
        $arrayRequestData = $request->getAllRequestData();
        User::create($arrayRequestData);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;
        JsonResponse::send($savedUserId);
    }

    public function update(JsonRequest $request)
    {
        $id = $request->get('id');
        $user = User::find($id);
        $data = $request->getAllRequestData();
        unset ($data['id']);//because we don't want to update the user id...
        $user->update($data);
        JsonResponse::send('id ' . $id . ' was updated.');
    }

    public function delete($id)
    {
        User::destroy($id);
        JsonResponse::send('id ' . $id . ' was deleted.');
    }
}
