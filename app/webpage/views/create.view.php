<?php require 'app/webpage/views/partials/header.php';?>

<h1>Create page</h1>
<!--HERE WE SUBMIT DATA TO THE DB-->
<h3>Create user</h3>
<br>

<form method="POST" action="/users"><!-- action="/users" here means, that when we push the submit, the uri will change to.../users. /users here is just a uri, that will activate 'UsersController@index' through the routes.php.  -->
    <input class="form-control" type="text" name="name"></input>
    <button type="submit" class='btn btn-success'>Submit</button>
</form>

<?php require 'app/webpage/views/partials/footer.php';?>
