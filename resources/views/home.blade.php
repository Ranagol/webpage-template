@extends('layout')

@section('content')

<section class="hero-panel" style="text-align:justify">
    <h1>PHP MVC Web Application (Vanilla PHP, No Framework)</h1>
    <p class="hero-lead">
        This project is a fully custom-built MVC web application created using <strong>vanilla PHP</strong>, 
        without frameworks like Laravel or Symfony. I started building it about five years ago with 
        the goal of understanding how modern PHP frameworks work under the hood.
        This was originally my first challenge project. Over time, I added more challenges, 
        some of which were inspired by real-world technical assessments used in software engineering 
        interviews.
    </p>
</section>

<section class="feature-grid" aria-label="Project Challenges">
    
    <article class="feature-card" style="text-align:justify">
        <h3><i class="bi bi-code-slash"></i> Challenge 1: Raw PHP MVC Application</h3>
        <p>
            A custom MVC web application built with vanilla PHP, without using any frameworks. 
        </p>
    </article>

    <article class="feature-card" style="text-align:justify">
        <h3><i class="bi bi-upload"></i> Challenge 2: File Upload & Processing</h3>
        <p>
            A custom file upload and download system built in raw PHP. The application supports uploading specific file types and stores them under user accounts.

            If a CSV file follows a defined format (including costs and categories), the system processes the data and generates a downloadable result file. This challenge demonstrates practical PHP file handling and data processing.
        </p>
    </article>

    <article class="feature-card" style="text-align:justify">
        <h3><i class="bi bi-train-front"></i> Challenge 3: Train Schedule Calculator</h3>
        <p>
            A scheduling problem that calculates train timetables based on given inputs. This challenge demonstrates object-oriented programming in PHP and uses the Symfony Console component.

            The task is executed via the command line, and results are displayed directly in the console output.
        </p>
    </article>

    <article class="feature-card" style="text-align:justify">
        <h3><i class="bi bi-shield-shaded"></i>Challenge 4: Heroes and Monsters Simulation</h3>
        <p>
            A fantasy simulation inspired by role-playing games like Advanced Dungeons & Dragons. The system models a world of heroes and monsters using object-oriented PHP.

            Characters can perform actions and engage in simulated battles, demonstrating game logic design and OOP principles.
        </p>
    </article>

</section>

@endsection