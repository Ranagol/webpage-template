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
<!-- UPLOAD CSV FILE -->
<form 
    action="upload" 
    method="post" 
    enctype="multipart/form-data" 
    class="form-group <?= $user ? '' : 'd-none' ?>"
>
    <h2 class='mt-'3'>Upload file</h2>
    <div class='mt-3'>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="file" id="fileSelect" class='form-control-file'>
    </div>
    <div class='mt-3'>
        <input type="submit" name="submit" value="Upload" class='btn btn-warning'>
    </div>
    <p>
        <strong>Note:</strong> Max allowed file size is 5 MB.
    </p>
</form>

<!-- REPORT CREATED FROM THE UPLOADED CSV FILE -->
<div class='<?= isset($report) ? '' : 'd-none' ?>'>
    <h2 class='mt-3'>Report</h2>

    <table class='table'>
        <tr>
            <th>Category</th>
            <th>Cost</th>
        </tr>

        <!--This is the fancy version of the foreach loop. The ':' is needed-->
        <?php foreach ($report as $category => $cost): ?>

        <tr>
            <td><?= $category ?></td>
            <td><?= $cost ?></td>
        </tr>

        <!-- This is how the fancy foreach loop ends -->
        <?php endforeach;?>
    </table>

    <!-- DOWNLOADING THE REPORT AS A .CSV FILE -->
    <?php
        if(isset($report)){
            // We put the $report that we want to download into the session, so this data will be 
            //accessible to our controller later
            $_SESSION['downloadRequest'] = $report;
        }
    ?>

    <form action="download-report" method="GET">
        <button class='btn btn-success'>Download report</button>
    </form>
</div>








<!-- warning message if the user is not logged in -->
<div 
    class="alert alert-warning <?= $user ? 'd-none' : '' ?> "
>
    Please log in, if you want to upload a file.
</div>

<?php require 'partials/footer.php'; ?>

