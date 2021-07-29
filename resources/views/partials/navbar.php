<!-- We must start session on every page, where we want to use the $_SESSION superglobal, othewise it won't work. -->
<?php

if(!isset($_SESSION)){ 
    session_start(); 
}

?>

<div class='container'>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="/">Andor's page</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-item nav-link" href="/">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/contact">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/users">Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/users/create">Create user</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/upload">Upload</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/register">Register</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/login">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/logout">Logout</a>
				</li>
				<li class="nav-item">
					<div class="nav-item nav-link" >
						<!-- <?php var_dump($_SESSION); ?> -->
						<?= isset($_SESSION['username']) ? 'Hi, ' . $_SESSION['username'] : 'You are not logged in.' ?>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</div>

<!-- <div class='container'>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="/">Home</a>
				<a class="nav-item nav-link" href="/about">About</a>
				<a class="nav-item nav-link" href="/contact">Contact</a>
				<a class="nav-item nav-link" href="/users">Users</a>
				<a class="nav-item nav-link" href="/users/create">Create user</a>
				<a class="nav-item nav-link" href="/register">Register</a>
				<a class="nav-item nav-link" href="/login">Login</a>
				<a class="nav-item nav-link" href="/logout">Logout</a>
			</div>
		</div>
	</nav>
</div> -->