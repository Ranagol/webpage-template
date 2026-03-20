<?php

namespace App\Controllers;

use App\Models\User;
use System\request\RequestInterface;

/**
 * Handles all User related requests coming from the web page. API User requests are handled by the
 * UserApiController.
 */
class UserController extends Controller
{
    /**
     * Shows all users.
     */
    public function index(): void
    {
        $users = User::orderBy('id', 'desc')->get();

        $this->view('userIndex', ['users' => $users]);
    }

    /**
     * Shows the user with the given id.
     */
    public function show(string $id): void
    {
        $user = User::find($id);
        $desiredView = 'show';

        $this->view('user', ['user' => $user, 'desiredView' => $desiredView]);
    }

    /**
     * Only returns the form for creating, it does not actually creates a user.
     * Currently, the user can be created only from the register page. So the create() and store()
     * methods are commented out.
     */
    public function create(): void
    {
        $desiredView = 'create';
        $this->view('user', ['desiredView' => $desiredView]);

    }

    /**
     * Saves the user to the database.
     * Currently, the user can be created only from the register page. So the create() and store()
     * methods are commented out.
     */
    public function store(RequestInterface $request): void
    {
        $requestDataArray = $request->getAllRequestData();
        User::create($requestDataArray);

        redirect('users');
    }

    /**
     * Updates the user in the database.
     */
    public function update(string $id, RequestInterface $request): void
    {
        $user = User::find($id);
        $data = $request->getAllRequestData();
        $user->update($data);

        redirect('users');
    }

    /**
     * Most browser do not support DELETE as method parameter for <form ...>
     * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
     * So instead of DELETE method, we use POST method.
     */
    public function delete(string $id): void
    {
        User::destroy($id);

        redirect('users'); // this is a route, not a file
    }
}
