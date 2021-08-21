<?php 

if ($desiredView === 'create') {
  $pageTitle = 'Create user - this is only for testing purposes';
} else {
  $pageTitle = 'User page';
}

?>

<?php require 'partials/header.php';?>

<h1><?= $pageTitle ?></h1>

<?php
  $action = $desiredView === 'create' ? '/users' : '/users/' . $user->id;
?>
<!-- There is no put method in bramus router, so we fake put with post method.
Otherwise said we use post for creating user and for updating user too. -->
<form method='POST' action='<?= $action ?>'>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input 
          type="text" name='firstname' class="form-control" id="firstname" 
          value='<?= $desiredView !== 'create' ? $user->firstname : ''; ?>'
        >
<!-- 
  We need here a small logic explanation. We want to use this file for show, create, update
  operations. These methods will send a $desiredView variable from the controller to this view. 
  It's value will be:
  show() - show
  create() - create
  update() - update
  Now, in case of create, there will be no user sent to this view, there is no need for displaying
  user data. But, in the $desiredView is not = create (so it is show or update), then we need to 
  display user data. And this is the logic in the ternary operator:
             $desiredView !== 'create' ? $user->firstname : ''

 -->
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input 
          type="text" name='lastname' class="form-control" id="lastname"
          value='<?= $desiredView !== 'create' ? $user->lastname : ''; ?>'
        >
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input 
          type="email" name='email' class="form-control" id="email"
          value='<?= $desiredView !== 'create' ? $user->email : ''; ?>'
        >
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input 
          type="password" name='password' class="form-control" id="exampleInputPassword1"
          value='<?= $desiredView !== 'create' ? $user->password : ''; ?>'
        >
    </div>

    <?php

      //on create view we want to have 'Create user' text, on every other case we want to have 'Update user'.
      $buttonText = $desiredView === 'create' ? 'Create user' : 'Update user';
    ?>

    <button type="submit" class="btn btn-primary"><?= $buttonText ?></button>
</form>

<?php require 'partials/footer.php';?>