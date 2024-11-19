

<?php $__env->startSection('content'); ?>



<?php if($desiredView === 'create'): ?>
    <?php
    $pageTitle = 'Create user - this is only for testing purposes';
    ?>
<?php else: ?>
    <?php
    $pageTitle = 'User page';
    ?>
<?php endif; ?>

<h1><?php echo e($pageTitle); ?></h1>

<?php
    $action = $desiredView === 'create' ? '/users' : '/users/' . $user->id;
?>

<!-- There is no put method in bramus router, so we fake put with post method.
Otherwise said we use post for creating user and for updating user too. -->
<form method='POST' action='<?php echo e($action); ?>'>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input 
          type="text" name='firstname' class="form-control" id="firstname" 
          value='<?php echo e($desiredView !== 'create' ? $user->firstname : ''); ?>'
        >
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input 
          type="text" name='lastname' class="form-control" id="lastname"
          value='<?php echo e($desiredView !== 'create' ? $user->lastname : ''); ?>'
        >
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input 
          type="email" name='email' class="form-control" id="email"
          value='<?php echo e($desiredView !== 'create' ? $user->email : ''); ?>'
        >
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input 
          type="password" name='password' class="form-control" id="exampleInputPassword1"
          value='<?php echo e($desiredView !== 'create' ? $user->password : ''); ?>'
        >
    </div>

    <?php
        // On create view we want to have 'Create user' text, on every other case we want to have 'Update user'.
        $buttonText = $desiredView === 'create' ? 'Create user' : 'Update user';
    ?>

    <button type="submit" class="btn btn-primary"><?php echo e($buttonText); ?></button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/resources/views/user.blade.php ENDPATH**/ ?>