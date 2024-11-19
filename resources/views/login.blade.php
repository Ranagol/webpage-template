@extends('layout')

@section('content')

<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    @if(isset($isAuthenticated) && $isAuthenticated === false)
        <div class="alert alert-danger">Invalid login credentials.</div>
    @endif

    <form action="/login" method="post">

        <div class="form-group">
            <label>Email</label>
            <input 
                type="text" 
                name="email" 
                class="form-control"
                value="{{ isset($email) ? $email : '' }}"
            >
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['emailError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['emailError']) ? $errors['emailError'] : '' }}
            </p>
        </div>    

        <div class="form-group">
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control"
                value="{{ isset($password) ? $password : '' }}"
            >
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['passwordError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['passwordError']) ? $errors['passwordError'] : '' }}
            </p>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

        <br>
        <p>Don't have an account? 
            <a href="/register">Sign up now</a>
        </p>
    </form>
</div>

@endsection