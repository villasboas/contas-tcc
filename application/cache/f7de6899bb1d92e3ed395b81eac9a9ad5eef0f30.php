<div id="header" class="pt-5 mb-2 pb-4 row">
    <div class="col-md-3">
        <img src="<?php echo e(base_url( 'public/images/logo.png' )); ?>" width="150">            
    </div>
    <div class="col text-right">
        <?php echo $__env->make( 'components.navbar.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>