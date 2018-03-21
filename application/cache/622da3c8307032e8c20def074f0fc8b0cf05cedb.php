<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-header">Banco de dados</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-database"></i>
                    </div>
                    <h4 class="card-title text-center">
                        <?php echo e(number_format( $dbSize, 2 )); ?> mb
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-header">Arquivos</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-files-o"></i>
                    </div>
                    <h4 class="card-title text-center">
                        <?php echo e(number_format( $userSize / 1024, 2 )); ?> mb
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-header">Usuários</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-users"></i>
                    </div>
                    <h4 class="card-title text-center">
                        <?php echo e($userSize); ?>

                    </h4>
                </div>
            </div>
        </div>
    </div><!-- dados do sistema -->

    <?php if( admin() ): ?>
    <div class="row mt-3 p-3">
        <div class="col bg-light pt-3 pl-5 pr-5 z-depth-1">
            <div class="page-header">
                <h3>Últimos logs</h3>
            </div>
            <br>
            <ul class="timeline">
                <?php $__currentLoopData = $logs->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="timeline-inverted">
                    <div class="timeline-badge <?php echo e($log->color); ?>"></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">
                                    <?php echo e($log->action); ?>

                                </h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 
                                        <?php echo e(date( 'H:i:s d-m-Y', strtotime( $log->created_at ) )); ?>

                                    </small>
                                    <?php if( $log->user_id ): ?>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fa fa-user-o"></i> 
                                        <?php echo e($log->belongsTo( 'user' )->email); ?>

                                    </small>
                                    <?php endif; ?>
                                </p>
                        </div>
                        <div class="timeline-body">
                            <p><?php echo $log->text; ?></p>
                            <?php if( $log->json ): ?>
                            <br>
                            <b>Registro</b>
                            <pre><?php echo json_encode( json_decode( $log->json ), JSON_PRETTY_PRINT ); ?></pre>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div><!-- logs -->

    <div class="row mt-5">
        <div class="col text-center">
            <a href="<?php echo e(site_url( 'log/list' )); ?>">Ver todos os logs</a>
        </div>
    </div><!-- link para os logs -->
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>