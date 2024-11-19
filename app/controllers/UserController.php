<?php

namespace App\controllers;

use App\models\User;
use System\request\RequestInterface;
use App\controllers\Controller;

/**
 * Handles all User related requests coming from the web page. API User requests are handled by the
 * UserApiController.
 */
class UserController extends Controller
{
    public function index(): void
    {
        $users = User::orderBy('id', 'desc')->get();

        $this->view('userIndex', ['users' => $users]);
    }
    
    public function show(string $id): void
    {
        $user = User::find($id);
        $desiredView = 'show';

        $this->view('user', ['user' => $user, 'desiredView' => $desiredView]);
    }

    /**
     * Only returns the form for creating, it does not actually creates a user. 
     *
     * @return void
     */
    public function create(): void
    {
        $desiredView = 'create';
        $this->view('user', ['desiredView' => $desiredView]);

    }   

    public function store(RequestInterface $request): void
    {
        $requestDataArray = $request->getAllRequestData();
        User::create($requestDataArray);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;

        redirect('users');
    }   

    public function update($id, RequestInterface $request): void
    {
        $user = User::find($id);
        $data = $request->getAllRequestData();
        $user->update($data);

        redirect('users');
    }   

    /**
     * 
    * Most browser do not support DELETE as method parameter for <form ...>
    * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
    * So instead of DELETE method, we use POST method
     * 
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void
    {
        User::destroy($id);

        redirect('users');//this is a route, not a file
    }
}
