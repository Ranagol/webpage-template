<?php require 'partials/header.php';?>

	<h1>About page</h1>

	<p>
		So, this page is an example for a case, when a controller sends a data to a view page,
		in vanilla PHP. The controller sends a $data variable to this view, and the view accepts it.
		<br>
		Below we just echo some random $data from the controller:
	</p>

	<?php echo $data; ?>

<?php require 'partials/footer.php';?>