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
<html>
<head>
    <title>*webpage*</title>
	<!-- This below is a solution for the 'favicon.ico not found -->
	<link rel="shortcut icon" href="#">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/style.css">

    {{-- 2. step of Debugbar setup with Blade: insert this below into the head --}}
    @php
        echo $debugbarRenderer->renderHead();
    @endphp
</head>
<body>
    
    {{-- NAVBAR --}}
    @include('navbar')

    {{-- CONTENT --}}
    <div class='container'>
        @yield('content')
    </div>

    {{-- 3. step of Debugbar setup with Blade: insert this below into the end of the body --}}
    @php
        echo $debugbarRenderer->render();
    @endphp
</body>

<br>
<br>

{{-- FOOTER --}}
<footer class='container mt-6'>
    <small class="rights mt-6">

        <span>&#174;</span> 

        <a href="https://www.linkedin.com/in/andor-horvat/">
            Andor H. All Rights Reserved.
        </a>
        
    </small>
</footer>

</body>
</html>