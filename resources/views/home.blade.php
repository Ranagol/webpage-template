@extends('layout')

@section('content')


    <section class="hero-panel" style="text-align:justify">
        <h1>PHP MVC Web App (Vanilla PHP, No Framework)</h1>
        <p class="hero-lead">
            This project is a fully custom-built MVC web application developed using <strong>vanilla PHP</strong>, without relying on frameworks like Laravel or Symfony. I started working on this project 5 years ago. The goal was to deeply understand how modern PHP frameworks work internally by recreating core features such as routing, middleware, templating, controllers, MVC architectures from scratch. Composer packages were allowed, but everything else had to be hand made. And this was actually my Challenge 1. In time, I added more challenges. These challenges were often inspired by official company challenges, that were used by programming companies for candidate selection. 
        </p>
    </section>

    <section class="feature-grid" aria-label="Project Challenges">
        <article class="feature-card" style="text-align:justify">
            <h3><i class="bi bi-code-slash"></i> Challenge 1: raw php app.</h3>
            <p>
                A fully custom-built MVC web application developed using <strong>vanilla PHP</strong>, without relying on frameworks like Laravel or Symfony. I started working on this project 5 years ago. The goal was to deeply understand how modern PHP frameworks work internally by recreating core features such as routing, middleware, templating, controllers, MVC architectures from scratch. Composer packages were allowed, but everything else had to be hand made. Authorization system was built with session.
            </p>
        </article>
        <article class="feature-card" style="text-align:justify">
            <h3><i class="bi bi-upload"></i> Challenge 2: upload</h3>
            <p>
                Custom upload/download logic in raw php. The app can receive a certain file types via upload, and can store it, under the users name. If the upload is a .csv file of certain format with costs and categories, then the app can process this, and create final downloadable result. See details here. PHP I/O file handling is demonstrated here.
            </p>
        </article>
        <article class="feature-card" style="text-align:justify">
            <h3><i class="bi bi-train-front"></i> Challenge 3: trains</h3>
            <p>
                An interesting task, with calculating train schedules. See details here. I use here PHP OOP, and Symfony console package. The task is triggered in console, and the result is returned in console.
            </p>
        </article>
        <article class="feature-card" style="text-align:justify">
            <h3><i class="bi bi-emoji-smile"></i> Challenge 4: heroes and monsters</h3>
            <p>
                Have you heard of Advanced Dragons & Dungeons? Then you might like this challenge. The task was to simulate a fantasy world with PHP OOP, with heroes and monsters, simulate their actions and their fight. See details.
            </p>
        </article>
    </section>

@endsection


