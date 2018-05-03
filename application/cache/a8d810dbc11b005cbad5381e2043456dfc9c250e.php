<?php $__env->startSection( 'content' ); ?>
    <div class="page-header">
        <h1>Pagbem - Admin</h1>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>