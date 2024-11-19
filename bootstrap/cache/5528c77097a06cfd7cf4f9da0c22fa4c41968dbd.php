

<?php $__env->startSection('content'); ?>

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
                value="<?php echo e(isset($firstname) ? $firstname : ''); ?>"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['firstnameError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['firstnameError']) ? $errors['firstnameError'] : ''); ?>

            </p>

        </div>
        <div class="form-group">

            <!-- LAST NAME -->
            <label>Lastname</label>
            <input 
                type="text" 
                name="lastname" 
                class="form-control"
                value="<?php echo e(isset($lastname) ? $lastname : ''); ?>"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['lastNameError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['lastnameError']) ? $errors['lastnameError'] : ''); ?>

            </p>

        </div>
        <div class="form-group">

            <!-- USERNAME -->
            <label>Username</label>
            <input 
                type="text" 
                name="username" 
                class="form-control"
                value="<?php echo e(isset($username) ? $username : ''); ?>"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['usernameError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['usernameError']) ? $errors['usernameError'] : ''); ?>

            </p>
        </div>
        <div class="form-group">

            <!-- EMAIL -->
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control"
                value="<?php echo e(isset($email) ? $email : ''); ?>"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['emailError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['emailError']) ? $errors['emailError'] : ''); ?>

            </p>
        </div>    
        <div class="form-group">

            <!-- PASSWORD -->
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control"
                value="<?php echo e(isset($password) ? $password : ''); ?>"
            >

            <!-- ERROR DISPLAY -->
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['passwordError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['passwordError']) ? $errors['passwordError'] : ''); ?>

            </p>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <br>
        <p>Already have an account? 
            <a href="/login">Login here</a>
        </p>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/resources/views/register.blade.php ENDPATH**/ ?>