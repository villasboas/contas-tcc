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
    
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="<?php echo e(base_url( 'public/dist/singular.min.js' )); ?>"></script>    
</body>
</html>