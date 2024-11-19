

<?php $__env->startSection('content'); ?>

<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    <?php if(isset($isAuthenticated) && $isAuthenticated === false): ?>
        <div class="alert alert-danger">Invalid login credentials.</div>
    <?php endif; ?>

    <form action="/login" method="post">

        <div class="form-group">
            <label>Email</label>
            <input 
                type="text" 
                name="email" 
                class="form-control"
                value="<?php echo e(isset($email) ? $email : ''); ?>"
            >
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['emailError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['emailError']) ? $errors['emailError'] : ''); ?>

            </p>
        </div>    

        <div class="form-group">
            <label>Password</label>
            <input 
                type="password" 
                name="password" 
                class="form-control"
                value="<?php echo e(isset($password) ? $password : ''); ?>"
            >
            <p 
                class="form-control alert alert-danger 
                <?php echo e(isset($errors['passwordError']) ? '' : 'd-none'); ?>"
            >
                <?php echo e(isset($errors['passwordError']) ? $errors['passwordError'] : ''); ?>

            </p>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

        <br>
        <p>Don't have an account? 
            <a href="/register">Sign up now</a>
        </p>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/resources/views/login.blade.php ENDPATH**/ ?>