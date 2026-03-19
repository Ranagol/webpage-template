@extends('layout')

@section('content')

    <h1>Welcome</h1>
    <p>Welcome to the app. Here you can manage users, upload files, and explore API-based features in one place.</p>
    <p>If you are just getting started, register or log in, then use the navigation menu to visit:</p>
    <ul>
        <li>Users: view, edit, and remove user records</li>
        <li>Upload: upload images or CSV files and generate a downloadable CSV report</li>
        <li>Guzzle: fetch and display sample data from an external API</li>
    </ul>

    <h2>Technical Overview</h2>
    <p>This project demonstrates the following backend and architecture capabilities:</p>
    <ul>
        <li>Serves web pages (home/about/contact) with Blade templates</li>
        <li>Handles authentication (register, login, logout) with session-based access control</li>
        <li>Provides user CRUD through normal web routes</li>
        <li>Provides user CRUD through REST-style API routes</li>
        <li>Uploads user images and stores them per user</li>
        <li>Processes uploaded CSV expense files and generates a summarized downloadable CSV report</li>
        <li>Calls external API data from dummyapi.io using Guzzle and displays posts</li>
        <li>Exposes a student endpoint that returns JSON or XML depending on board</li>
        <li>Includes Symfony Console commands, including a train-schedule challenge command</li>
        <li>Uses MySQL via Eloquent, dotenv configuration, Docker setup, and custom exception logging</li>
    </ul>
@endsection


