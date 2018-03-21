<?php if( isset( $user ) && isset( $groups ) ): ?>
    <?php $__env->startSection( 'beforeGrid'); ?>
    <div class="modal fade show" id="groupModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <?php echo form_open( 'user/save_group/'.$user->id, [ 'class' => 'modal-content'] ); ?>

        
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Grupos de acesso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="list-group">
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="list-group-item custom-control custom-checkbox">
                    <div class="d-block float-left">
                        <input  type="checkbox" 
                                name="groups[]" 
                                value="<?php echo e($group->id); ?>" 
                                <?php echo e(in_array( $group->id, $userGroups ) ? 'checked="checked"': ''); ?>

                                class="custom-control-input">
                        <div class="mt-3 ml-2 custom-control-indicator"></div>
                    </div>
                    <div class="d-block float-right">                    
                    <?php echo e($group->name); ?> <small>( <?php echo e($group->slug); ?> )</small>
                    </div>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        
        </div>
        <?php echo form_close(); ?>  
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection( 'scripts-grid' ); ?>
    <script>
        $( document ).ready( function(){
            $('#groupModal.show').modal('show');
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make( 'pages.grid.grid' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>