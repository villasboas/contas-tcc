<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo e(base_url( 'public/dist/singular.min.css' )); ?>" media="screen">
</head>
<body style="background: #6A6BDC">

    <div class="animated fadeIn" id="login">
        <div class="container-fluid">
            <div class="row login-wallpaper">
                <div class="col-md-4 offset-md-4 text-center mt-5">
                    <img width="100" src="<?php echo e(base_url( 'public/images/logo.png' )); ?>">
                </div>
            </div>
            <div class="row login-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script src="<?php echo e(base_url( 'public/dist/singular.min.js' )); ?>"></script>    
</body>
</html>