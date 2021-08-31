<?php require 'partials/header.php';?>

	<h1>Guzzle testing page</h1>

	<p>We are sending here requests with Guzzle to the 
		<a href="https://dummyapi.io/">DummyApi</a> page.
	</p>

	<div class='container d-flex flex-row'>
		<form action="getPosts" method='GET'>
			<button class='btn btn-success'>GET 10 posts from DummyApi</button>
		</form>

		<form action="guzzle" method='GET'>
			<button class='btn btn-success'>Return to previous page</button>
		</form>
		
	</div>

	<div class='mt-5'>
		<h3 class='mt-5'>Received responses</h3>
		<?php isset($posts) ? var_dump($posts) : '' ?>
	</div>










<?php require 'partials/footer.php';?>