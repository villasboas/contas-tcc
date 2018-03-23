<?php $__env->startSection( 'content' ); ?>
    <div class="page-header">
        <h1>Simple News Admin</h1>
    </div>

    <div class="row">
        <form method="GET" action="<?php echo e(site_url( 'home' )); ?>" class="input-group mb-3">
            <input  type="text" 
                    class="form-control" 
                    placeholder="Buscar link RSS" 
                    name="query">
            <div class="input-group-prepend">
                <button class="btn btn-warning" type="submit">Buscar</button>
            </div>
        </form>

        <?php $__currentLoopData = $rss->news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 p-0">
            <div class="card">
                <?php if( $new['cover'] ): ?>
                <img class="card-img-top" src="<?php echo e($new['cover']); ?>" alt="Card image cap">
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title"><?php echo e($new['title']); ?></h5>
                    <p class="card-text"><?php echo e($new['description']); ?></p>
                    <?php if( isset( $new['pubDate'] ) ): ?>
                    <p>
                        <small><?php echo e(date( 'H:i:s d-m-Y', strtotime( $new['pubDate']))); ?></small>
                    </p>
                    <?php endif; ?>
                    <a href="<?php echo e($new['link']); ?>" target="blank" class="btn btn-primary">Abrir link</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>