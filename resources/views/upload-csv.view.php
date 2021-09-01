<?php require 'partials/header.php'; ?>

<?php

use App\models\User;

if(!isset($_SESSION)){ 
    session_start(); 
}
//here we check if the user is logged in
    $user = User::getCurrentUser();
?>

<!-- success message OR warning message if something is wrong with the upload -->
<div 
    class="alert 
        <?= isset($alertType) && ($alertType === 'alert-success') ? 'alert-success' : 'alert-warning' ?>
        <?= isset($message) && (!empty($message)) ? '' : 'd-none' ?>
    "
>
    <?= $message ?>
</div>

<!-- This form will be displayed only if the user is logged in -->
<form 
    action="upload-csv" 
    method="post" 
    enctype="multipart/form-data" 
    class="form-group <?= $user ? '' : 'd-none' ?>"
>
    <h2 class='mt-'3'>Upload .csv file</h2>
    <div class='mt-3'>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="file" id="fileSelect" class='form-control-file'>
    </div>
    <div class='mt-3'>
        <input type="submit" name="submit" value="Upload" class='btn btn-warning'>
    </div>
    <p>
        <strong>Note:</strong> Only .csv formats allowed to a max size of 5 MB.
    </p>
</form>

<!-- warning message if the user is not logged in -->
<div 
    class="alert alert-warning <?= $user ? 'd-none' : '' ?> "
>
    Please log in, if you want to upload a file.
</div>

<?php require 'partials/footer.php'; ?>
