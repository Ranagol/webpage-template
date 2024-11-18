

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
					<a class="nav-item nav-link" href="/upload">Upload</a>
				</li>
				<li class="nav-item">
					<a class="nav-item nav-link" href="/guzzle">Guzzle</a>
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
                        <?php if(isset($_SESSION['username'])): ?>
                            Hi, <?php echo e($_SESSION['username']); ?>

                        <?php else: ?>
                            You are not logged in.
                        <?php endif; ?>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</div>
<?php /**PATH /srv/www/resources/views/navbar.blade.php ENDPATH**/ ?>