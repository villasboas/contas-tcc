<?php $__env->startSection('beforeGrid'); ?>
<div class="modal fade <?php echo e(isset( $viewLog ) ? 'show' : ''); ?>" id="logModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class='modal-content'>
    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <h4>
                    <?php echo e($viewLog->action); ?>

                </h4>
                <p>
                    <small class="text-muted">
                        <i class="fa fa-clock-o"></i> 
                        <?php echo e(date( 'H:i:s d-m-Y', strtotime( $viewLog->created_at ) )); ?>

                    </small>
                    <?php if( $viewLog->user_id ): ?>
                    <br>
                    <small class="text-muted">
                        <i class="fa fa-user-o"></i> 
                        <?php echo e($viewLog->belongsTo( 'user' )->email); ?>

                    </small>
                    <?php endif; ?>
                </p>
                <p><?php echo $viewLog->text; ?></p>
                <?php if( $viewLog->json ): ?>
                <b>Registro</b>
                <pre><?php echo json_encode( json_decode( $viewLog->json ), JSON_PRETTY_PRINT ); ?></pre>
                <?php endif; ?>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
    
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('pages.grid.grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>