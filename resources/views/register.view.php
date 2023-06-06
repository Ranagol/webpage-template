<?php require 'partials/header.php'; ?>
<?php

if(!isset($_SESSION)){ 
    session_start(); 
}

?>

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="/register" method="post">
            <div class="form-group">

                <!-- FIRST NAME -->
                <label>First name</label>

                <input 
                    type="text" 
                    name="firstname" 
                    class="form-control"
                    value="<?= isset($firstname) ? $firstname : '' ?>"
                >

                <!-- ERROR DISPLAY -->
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['firstnameError']) ? '' : 'd-none' ?>"
                >
                    <?= isset($errors['firstnameError']) ? $errors['firstnameError'] : '' ?>
                </p>

            </div>
            <div class="form-group">

                <!-- LAST NAME -->
                <label>Lastname</label>
                <input 
                    type="text" 
                    name="lastname" 
                    class="form-control"
                    value="<?= isset($lastname) ? $lastname : '' ?>"
                >

                <!-- ERROR DISPLAY -->
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['lastNameError']) ? '' : 'd-none' ?>"
                >
                <?= isset($errors['lastnameError']) ? $errors['lastnameError'] : '' ?>
                </p>

            </div>
            <div class="form-group">

                <!-- USERNAME -->
                <label>Username</label>
                <input 
                    type="text" 
                    name="username" 
                    class="form-control"
                    value="<?= isset($username) ? $username : '' ?>"
                >

                <!-- ERROR DISPLAY -->
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['usernameError']) ? '' : 'd-none' ?>"
                >
                <?= isset($errors['usernameError']) ? $errors['usernameError'] : '' ?>
                </p>
            </div>
            <div class="form-group">

                <!-- EMAIL -->
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="<?= isset($email) ? $email : '' ?>"
                >

                <!-- ERROR DISPLAY -->
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['emailError']) ? '' : 'd-none' ?>"
                >
                <?= isset($errors['emailError']) ? $errors['emailError'] : '' ?>
                </p>
            </div>    
            <div class="form-group">

                <!-- PASSWORD -->
                <label>Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control"
                    value="<?= isset($password) ? $password : '' ?>"
                >

                <!-- ERROR DISPLAY -->
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['passwordError']) ? '' : 'd-none' ?>"
                >
                <?= isset($errors['passwordError']) ? $errors['passwordError'] : '' ?>
                </p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="/login">Login here</a>.</p>
        </form>
    </div>    

<?php require 'partials/footer.php'; ?>
