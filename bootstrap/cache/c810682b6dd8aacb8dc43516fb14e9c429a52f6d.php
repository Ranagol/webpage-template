

<?php $__env->startSection('content'); ?>

<h1>Users</h1>

<!--HERE WE JUST DISPLAYING THE INFO FROM THE DB-->
<h3>List of all users</h3>

<table class='table'>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Delete user</th>
    </tr>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!--This is the fancy version of the foreach loop. The ':' is needed-->
        <tr>
            <td><?php echo e($user->id); ?></td>
            <td>
                <a href='/users/<?php echo e($user->id); ?>'>
                    <?php echo e($user->username); ?> 
                </a>
            </td>
            <td><?php echo e($user->firstname); ?></td>
            <td><?php echo e($user->lastname); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td>
                <!-- 
 * Most browser do not support DELETE as method parameter for <form ...>
 * Source: https://stackoverflow.com/questions/33785415/deleting-a-file-on-server-by-delete-form-method
 * So instead of DELETE method, we use POST method
                 -->
                <form method='POST' action='/user/delete/<?php echo e($user->id); ?>'>
                    <button type='submit' class='btn btn-outline-danger btn-small'>Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/resources/views/userIndex.blade.php ENDPATH**/ ?>