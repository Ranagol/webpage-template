<!DOCTYPE html>
<html>
<head>
    <title>*webpage*</title>
	<!-- This below is a solution for the 'favicon.ico not found -->
	<link rel="shortcut icon" href="#">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    
    {{-- NAVBAR --}}
    @include('navbar')

    {{-- CONTENT --}}
    <div class='container'>
        @yield('content')
    </div>

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





