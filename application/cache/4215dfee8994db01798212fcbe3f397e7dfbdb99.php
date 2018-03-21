<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <link rel="stylesheet" href="<?php echo e(base_url( 'public/dist/css/app.css')); ?>"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"></link>
    <?php echo $__env->yieldContent( 'styles' ); ?>
</head>
<body>

    <?php if( editMode() ): ?>
        <?php echo $__env->make( 'components.edit-mode.edit-mode' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make( 'components.helpbar.helpbar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container">
        <?php echo $__env->make( 'components.header.header' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <div class="col-md-9 p-1">
                <?php echo $__env->yieldContent( 'content' ); ?>
            </div>
            <div class="col-md-3 p-1">
                <?php echo $__env->make( 'components.sidebar.sidebar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
            </div>
        </div>
        <?php echo $__env->make( 'components.footer.footer' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>        
    </div>
    
    <script src="<?php echo e(base_url( 'public/dist/js/app.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    
    <?php echo $__env->yieldContent( 'scripts' ); ?>

    <?php if( flash( 'swaSuccessBody' ) ): ?>
    <script>
        swal(
            'Sucesso!',
            '<?php echo e(flash( 'swaSuccessBody' )); ?>',
            'success'
        );
    </script>
    <?php endif; ?>
    <?php if( flash( 'swaErrorBody' ) ): ?>
    <script>
        swal(
            'Erro!',
            '<?php echo e(flash( 'swaErrorBody' )); ?>',
            'error'
        );
    </script>
    <?php endif; ?>
</body>
</html>