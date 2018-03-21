<div id="navbar" class="row">
    <div class="access-content">
        
        <?php $__currentLoopData = components( 'navbar'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordem => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="access-link <?php echo e(navbar( $item->text, true )); ?>" <?php echo clickOpen( $item->link ); ?>>
                <?php echo e($item->text); ?>

 
                <?php if( editMode() ): ?>
                    <a href="<?php echo e(deleteLink( $item->id )); ?>">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    <a href="<?php echo e(editLink( 'edit', 'navbar', $ordem + 1, $item->id )); ?>">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="<?php echo e(editLink( 'add', 'navbar', $ordem + 1)); ?>">
                        <i class="fa fa-plus"></i>
                    </a>
                <?php endif; ?>
            </div>        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if( editMode() ): ?>
        <div    class="access-link rounded" 
                style="border: 1px dashed #999; color: #999"
                data-toggle="modal" 
                data-target="#exampleModal"
                onclick="location.href = '<?php echo e(editLink( 'add', 'navbar', count( components( 'navbar') ) + 1 )); ?>'"
                title="Adicionar item ao navbar" >
            <i class="fa fa-plus"></i>
        </div><!-- item de edição -->
        <?php endif; ?>
        
    </div>
    <div class="clearfix"></div>
</div>