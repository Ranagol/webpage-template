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
			<button class='btn btn-success'>Reset</button>
		</form>
		
	</div>

	<div class='mt-5'>
		<h3 class='mt-5'>Received responses</h3>
		<p>	Note: the received data is on purpose displayed with just a var_dump, since the
			goal here was only to get some data from a webpage with the help of the Guzzle, and not
			to do a frontend exercise.
		</p>

		<?php isset($posts) ? var_dump($posts) : '' ?>
	</div>










<?php require 'partials/footer.php';?>