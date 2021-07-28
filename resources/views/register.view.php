<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 500px; padding: 20px; }
    </style>
</head>



<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="/register" method="post">
            <div class="form-group">
                <label>First name</label>

                <input 
                    type="text" 
                    name="firstname" 
                    class="form-control"
                    value="<?= isset($firstname) ? $firstname : '' ?>"
                >

                <p 
                    
                    class="form-control alert alert-danger 
                    <?= isset($errors['firstnameError']) ? '' : 'd-none' ?>"
                >
                    <?= $errors['firstnameError'] ?>
                </p>

            </div>
            <div class="form-group">
                <label>Lastname</label>
                <input 
                    type="text" 
                    name="lastname" 
                    class="form-control"
                    value="<?= isset($lastname) ? $lastname : '' ?>"
                >
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['lastNameError']) ? '' : 'd-none' ?>"
                >
                    <?= $errors['lastNameError'] ?>
                </p>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input 
                    type="text" 
                    name="username" 
                    class="form-control"
                    value="<?= isset($username) ? $username : '' ?>"
                >
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['usernameError']) ? '' : 'd-none' ?>"
                >
                    <?= $errors['usernameError'] ?>
                </p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="<?= isset($email) ? $email : '' ?>"
                >
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['emailError']) ? '' : 'd-none' ?>"
                >
                    <?= $errors['emailError'] ?>
                </p>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input 
                type="password" 
                name="password" 
                class="form-control"
                value="<?= isset($password) ? $password : '' ?>"
                >
                <p 
                    class="form-control alert alert-danger 
                    <?= isset($errors['passwordError']) ? '' : 'd-none' ?>"
                >
                    <?= $errors['passwordError'] ?>
                </p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="/login">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>