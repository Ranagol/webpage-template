@extends('layout')

@section('content')

<h1>Users</h1>

<!--HERE WE JUST DISPLAYING THE INFO FROM THE DB-->
<h3>List of all users</h3>

<table class='table'>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Delete user</th>
    </tr>
    @foreach ($users as $user)
        <!--This is the fancy version of the foreach loop. The ':' is needed-->
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                <a href='/users/{{ $user->id }}'>
                    {{ $user->username }} 
                </a>
            </td>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <!-- 
 * Most browser do not support DELETE as method parameter for <form ...>
 * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
 * So instead of DELETE method, we use POST method
                 -->
                <form method='POST' action='/user/delete/{{ $user->id }}'>
                    <button type='submit' class='btn btn-outline-danger btn-small'>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection