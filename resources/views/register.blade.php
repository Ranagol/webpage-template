@extends('layout')

@section('content')

@php
    if(!isset($_SESSION)){ 
        session_start(); 
    }
@endphp

<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="/register" method="post">
        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
        <div class="form-group">

            <!-- FIRST NAME -->
            <label>First name</label>

            <input 
                type="text" 
                name="firstname" 
                required
                minlength="3"
                maxlength="50"
                class="form-control"
                value="{{ isset($firstname) ? $firstname : '' }}"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['firstnameError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['firstnameError']) ? $errors['firstnameError'] : '' }}
            </p>

        </div>
        <div class="form-group">

            <!-- LAST NAME -->
            <label>Lastname</label>
            <input 
                type="text" 
                name="lastname" 
                required
                minlength="3"
                maxlength="50"
                class="form-control"
                value="{{ isset($lastname) ? $lastname : '' }}"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['lastNameError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['lastnameError']) ? $errors['lastnameError'] : '' }}
            </p>

        </div>
        <div class="form-group">

            <!-- USERNAME -->
            <label>Username</label>
            <input 
                type="text" 
                name="username" 
                required
                minlength="3"
                maxlength="50"
                class="form-control"
                value="{{ isset($username) ? $username : '' }}"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['usernameError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['usernameError']) ? $errors['usernameError'] : '' }}
            </p>
        </div>
        <div class="form-group">

            <!-- EMAIL -->
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

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['emailError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['emailError']) ? $errors['emailError'] : '' }}
            </p>
        </div>    
        <div class="form-group">

            <!-- PASSWORD -->
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                required
                minlength="8"
                maxlength="50"
                class="form-control"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                {{ isset($errors['passwordError']) ? '' : 'd-none' }}"
            >
                {{ isset($errors['passwordError']) ? $errors['passwordError'] : '' }}
            </p>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <br>
        <p>Already have an account? 
            <a href="/login">Login here</a>
        </p>
    </form>
</div>

@endsection