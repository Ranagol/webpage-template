<?php 
  if (isset($user) && !empty($user)) {
    $title = 'User';
    $userSet = true;
  } else {
    $title = 'Bla';
  }

?>

<?php require 'app/webpage/views/partials/header.php';?>

<h1>Individual user page</h1>
<!--HERE WE SUBMIT DATA TO THE DB-->
<br>

<form method='POST' action='/users'>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input 
          type="text" name='firstname' class="form-control" id="firstname" 
          value='<?= $userSet ? $user->firstname : ''; ?>'
        >
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input 
          type="text" name='lastname' class="form-control" id="lastname"
          value='<?= $userSet ? $user->lastname : ''; ?>'
        >
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input 
          type="email" name='email' class="form-control" id="email"
          value='<?= $userSet ? $user->email : ''; ?>'
        >
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input 
          type="password" name='password' class="form-control" id="exampleInputPassword1"
          value='<?= $userSet ? $user->password : ''; ?>'
        >
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php require 'app/webpage/views/partials/footer.php';?>