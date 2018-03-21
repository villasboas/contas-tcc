<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <link rel="stylesheet" href="<?php echo e(base_url( 'public/dist/css/app.css')); ?>"></link>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></link>
    <?php echo $__env->yieldContent( 'styles' ); ?>
</head>
<body>
    <?php echo $__env->yieldContent( 'content' ); ?>

    <script src="<?php echo e(base_url( 'public/dist/js/app.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <?php echo $__env->yieldContent( 'scripts' ); ?>
    
    <!-- Sweet alert body -->
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