@extends('layout')

@section('content')

    <section class="hero-panel">
        <p class="hero-kicker"></p>
        <h1>Vanilla PHP MVC app with web, API, file processing, and CLI features</h1>
        <p class="hero-lead">
            The goal of this project was to build a Vanilla PHP MVC app without framework 
            (like Laravel or Symfony). So, raw PHP only. Composer package usage was allowed. For more details, see 
            the readme.md in the root directory.
        </p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="/users">Explore Users</a>
            <a class="btn btn-warning" href="/upload">Try Upload + CSV Report</a>
            <a class="btn btn-success" href="/guzzle">Run External API Demo</a>
        </div>
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

        
@endsection


