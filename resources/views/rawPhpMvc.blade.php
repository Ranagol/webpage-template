@extends('layout')

@section('content')
	<h1>Challenge 1: Raw PHP MVC webpage</h1>

    <p>
        For this challenge, I set these rules for myself:
        <ul>
            <li>No frameworks allowed (like Laravel, Symfony, etc.)</li>
            <li>Composer packages were allowed, but everything else had to be implemented manually</li>
            <li>Implement a session-based authentication system for user authorization, with middleware,
                again, from scratch, without using any pre-built authentication packages or libraries
            </li>
            <li>Implement core concepts such as routing, middleware, templating, controllers, and 
                the MVC architecture from scratch
            </li>
            <li>Use OOP principles and design patterns to create a maintainable and scalable codebase</li>
            <li>Do CSV upload, processing, and report generation</li>
            <li>Use environment based configuration (.env file)</li>
            <li>Create a custom logging system that writes logs to a file</li>
        </ul>
    </p>
@endsection