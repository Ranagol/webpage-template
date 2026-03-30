{{-- <!-- We must start session on every page, where we want to use the $_SESSION superglobal, othewise it won't work. --> --}}
@if(!isset($_SESSION))
    session_start(); 
@endif

@php
	$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
	$isLoggedIn = isset($_SESSION['username']);
	$normalizePath = static function (string $path): string {
		return rtrim($path, '/') ?: '/';
	};
	$isActive = static function (string $routePath) use ($currentPath, $normalizePath): bool {
		return $normalizePath($currentPath) === $normalizePath($routePath);
	};
@endphp

<div class="container nav-wrap">
	<nav class="navbar navbar-expand-lg navbar-light app-navbar">
		<a class="navbar-brand" href="/">Andor's page</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link {{ $isActive('/') ? 'active' : '' }}" href="/">Home</a>
				</li>
				{{-- <li class="nav-item">
					<a class="nav-link {{ $isActive('/about') ? 'active' : '' }}" href="/about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ $isActive('/contact') ? 'active' : '' }}" href="/contact">Contact</a>
				</li> --}}
				{{-- <li class="nav-item">
					<a class="nav-link {{ $isActive('/users') ? 'active' : '' }}" href="/users">Users</a>
				</li> --}}
                <li class="nav-item">
					<a class="nav-link {{ $isActive('/raw-php-mvc') ? 'active' : '' }}" href="/raw-php-mvc">MVC</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ $isActive('/upload') ? 'active' : '' }}" href="/upload">Upload</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ $isActive('/train-task') ? 'active' : '' }}" href="/train-task">Trains</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link {{ $isActive('/heroes-and-monsters') ? 'active' : '' }}" href="/heroes-and-monsters">Heroes</a>
				</li>

				{{-- <li class="nav-item">
					<a class="nav-link {{ $isActive('/guzzle') ? 'active' : '' }}" href="/guzzle">Guzzle</a>
				</li> --}}

				@if(!$isLoggedIn)
					<li class="nav-item">
						<a class="nav-link {{ $isActive('/register') ? 'active' : '' }}" href="/register">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ $isActive('/login') ? 'active' : '' }}" href="/login">Login</a>
					</li>
				@endif

				@if($isLoggedIn)
					<li class="nav-item">
						<a class="nav-link {{ $isActive('/logout') ? 'active' : '' }}" href="/logout">Logout</a>
					</li>
				@endif

			</ul>

			{{-- Here we display the username in the navbar, if the user is logged in. --}}
			<div class="navbar-text user-state">

				@if(isset($_SESSION['username']))
					Hi, {{ $_SESSION['username'] }}
				@else
					You are not logged in.
				@endif
                
			</div>
		</div>
	</nav>
</div>
