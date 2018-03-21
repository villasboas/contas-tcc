<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo e(base_url( 'public/dist/singular.min.css' )); ?>" media="screen">
</head>
<body>

    <?php echo $__env->make('components.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container wrapper">
        <div class="row">
            <div class="col-4">
                <?php echo $__env->make('components.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col padding-bottom-50">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script src="<?php echo e(base_url( 'public/dist/singular.min.js' )); ?>"></script>    
</body>
</html>