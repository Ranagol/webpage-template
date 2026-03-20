@extends('layout')

@section('content')

    <section class="hero-panel">
        <p class="hero-kicker"></p>
        <h1>Vanilla PHP MVC app with web, API, file processing, and CLI features</h1>
        <p class="hero-lead">
            The goal of this project was to build a Vanilla PHP MVC app without framework 
            (like Laravel or Symfony). Composer package usage was allowed.
        </p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="/users">Explore Users</a>
            <a class="btn btn-warning" href="/upload">Try Upload + CSV Report</a>
            <a class="btn btn-success" href="/guzzle">Run External API Demo</a>
        </div>
    </section>

    <section class="quick-start">
        <h2>Quick Start</h2>
        <p>If you are testing the app, these pages provide the best feature walkthrough:</p>
        <ul>
            <li>Users: view, edit, and remove user records through web routes</li>
            <li>Upload: upload images or CSV files and generate a downloadable summary report</li>
            <li>Guzzle: fetch and display sample data from an external API</li>
        </ul>
    </section>

    <section class="feature-grid" aria-label="Technical capabilities">
        <article class="feature-card">
            <h3>Web + Auth</h3>
            <ul>
                <li>Serves web pages (home/about/contact) with Blade templates</li>
                <li>Handles authentication (register, login, logout) with session-based access control</li>
                <li>Provides user CRUD through normal web routes</li>
            </ul>
        </article>

        <article class="feature-card">
            <h3>API + Integration</h3>
            <ul>
                <li>Provides user CRUD through REST-style API routes</li>
                <li>Calls external API data from dummyapi.io using Guzzle and displays posts</li>
                <li>Exposes a student endpoint that returns JSON or XML depending on board</li>
            </ul>
        </article>

        <article class="feature-card">
            <h3>Files + Reporting</h3>
            <ul>
                <li>Uploads user images and stores them per user</li>
                <li>Processes uploaded CSV expense files and generates a downloadable CSV report</li>
                <li>Keeps upload workflows integrated with validation and user feedback</li>
            </ul>
        </article>

        <article class="feature-card">
            <h3>Tooling + Architecture</h3>
            <ul>
                <li>Uses MySQL via Eloquent with dotenv-based configuration</li>
                <li>Runs in Docker and includes custom exception logging</li>
                <li>Includes Symfony Console commands, including a train-schedule challenge command</li>
            </ul>
        </article>
    </section>
@endsection


