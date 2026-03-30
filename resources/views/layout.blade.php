@php
    /**
     * In order to make Blade and Debugbar work together, here is a solution in 3 steps:
     * 1. You must create a new DebugBar instance on the master layout page. Like I did here in this
     * section.
     * 2. Put echo $debugbarRenderer->renderHead(); in the head section of the layout page.
     * 3. Put echo $debugbarRenderer->render(); at the end of the body section of the layout page.
     */
    use DebugBar\StandardDebugBar;

    // Create a new DebugBar instance
    $debugbar = new StandardDebugBar();
    $debugbarRenderer = $debugbar->getJavascriptRenderer();

    /**
     * Here we actually state, that the Debugbar stuff needed to the browser so the Debugbar page could
     * be shown, is in the /public/debugbar folder. 
     */
    $debugbarRenderer->setBaseUrl('/debugbar');
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenges</title>

    <!-- This below is a solution for the 'favicon.ico not found -->
    <link rel="shortcut icon" href="#">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    {{-- 2. step of Debugbar setup with Blade: insert this below into the head --}}
    @php
        echo $debugbarRenderer->renderHead();
    @endphp
</head>
<body class="app-body">

    <div class="app-content">
        {{-- NAVBAR --}}
        @include('navbar')

        {{-- CONTENT --}}
        <main class="page-shell container">
            @yield('content')
        </main>
    </div>

    {{-- FOOTER --}}
    <footer class="site-footer container">
        <small class="rights">
            <span>&#174;</span>
            <a href="https://www.linkedin.com/in/andor-horvat/">
                Andor H. All Rights Reserved.
            </a>
        </small>
    </footer>

    {{-- 3. step of Debugbar setup with Blade: insert this below into the end of the body --}}
    @php
        echo $debugbarRenderer->render();
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>