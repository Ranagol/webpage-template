<?php require 'app/webpage/views/partials/header.php';?>

<h1>Show page</h1>

<p>User id:
    <?= $user->id; ?> 
</p>

<p>User name:
    <?= $user->firstname; ?> 
    <?= $user->lastname; ?>
</p>    

<p>User email:
    <?= $user->email; ?> 
</p>    

<?php require 'app/webpage/views/partials/footer.php';?>
