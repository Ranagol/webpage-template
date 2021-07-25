<?php

namespace App\WebControllers;

use app\models\User;
use app\WebControllers\WebController;
use app\System\Request;

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
        $desiredView = 'show';

        return view('user', compact('user', 'desiredView'));
    }

    /**
     * Only returns the form for creating, it does not actually creates a user. 
     *
     * @return void
     */
    public static function create()
    {
        $desiredView = 'create';

        return view('user', 'desiredView');
    }   

    public static function store(Request $request)
    {
        $requestDataArray = $request->getAllRequestData();
        User::create($requestDataArray);
        $savedUserId = User::orderBy('id', 'desc')->first()->id;
        redirect('users');
    }   

    public static function update()//**************ITT HAGYTAM ABBA */
    {
        $id = $request->get('id');
        $user = User::find($id);
        $data = $request->getAllRequestData();
        unset ($data['id']);//because we don't want to update the user id...
        $user->update($data);
        redirect('users');
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
