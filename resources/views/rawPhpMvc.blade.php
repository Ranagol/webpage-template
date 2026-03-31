@extends('layout')

@section('content')

<article class="feature-card mb-3">
    <h1>Challenge 1: Raw PHP MVC webpage</h1>
</article>

<article class="feature-card mb-3">
    <h2>Challenge description</h2>
    
    <ul>
        <li>No frameworks allowed (like Laravel, Symfony, etc.), only raw, vanilla PHP. No JavaScript, only Blade templates.</li>
        <li>Composer packages were allowed, but everything else must be implemented manually</li>
        <li>Implement a session-based authentication system for user authorization, with middleware,
            from scratch, without using any pre-built authentication packages or libraries
        </li>
        <li>Implement core concepts such as routing, middleware, templating, controllers, and 
            the MVC architecture from scratch
        </li>
        <li>Use environment based configuration (.env file)</li>
        <li>Create a custom logging system that writes logs to a file</li>
        <li>Trigger migrations from the command line with Composer scripts</li>
        <li>Use MySQL as the database, and implement an Laravel/Eloquent style with a Composer package</li>
    </ul>
</article>
@endsection