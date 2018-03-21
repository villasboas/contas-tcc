<?php $__env->startSection('content'); ?>
    <div id="home">
        <div class="page-header">
            <?php if( !auth() ): ?>
                <h1>Faça login</h1>
            <?php else: ?>
                <h1><small>Bem vindo, </small><?php echo e(auth()->name); ?></h1>
                <?php if( can( 'update', 'user' ) ): ?>
                    Pode acessar
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>