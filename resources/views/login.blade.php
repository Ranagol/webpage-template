@extends('layout')

@section('content')

<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    @if(isset($isAuthenticated) && $isAuthenticated === false)
        <div class="alert alert-danger">Invalid login credentials.</div>
    @endif

    <form action="/login" method="post">

        {{-- A hidden input for csrf. If no csrf token is present, one will be generated --}}
        <input type="hidden" name="csrf_token" value="{{ createCsrfToken() }}">

        <div class="form-group">
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                required
                minlength="6"
                maxlength="50"
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
                required 
                minlength="6"
                maxlength="50"
                autocomplete="current-password"
                class="form-control"
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