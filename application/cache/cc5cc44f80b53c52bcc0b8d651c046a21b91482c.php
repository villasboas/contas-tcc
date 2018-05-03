<div id="sidebar" class="pl-2 pr-2 pb-5 z-depth-1">

    <?php $__currentLoopData = components( 'sidebar-group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordem => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="group-divider">
        <span>
            <?php echo e($item->text); ?>


            <?php if( editMode() ): ?>
                &nbsp;&nbsp;
                <a href="<?php echo e(deleteLink( $item->id )); ?>">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a href="<?php echo e(editLink( 'edit', 'sidebar-group', $ordem + 1, $item->id )); ?>">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="<?php echo e(editLink( 'add', 'sidebar-group', $ordem + 1)); ?>">
                    <i class="fa fa-plus"></i>
                </a>
            <?php endif; ?>
        </span>
    </div>

        <?php $__currentLoopData = components( 'sidebar-item', $item->id ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sidebar-item <?php echo e(sidebar( $link->text, true )); ?>" <?php echo clickOpen( $link->link ); ?>>
            <fa class="fa fa-<?php echo e($link->icon); ?>"></fa>
            <?php echo e($link->text); ?>


            <?php if( editMode() ): ?>
                &nbsp;&nbsp;
                <a href="<?php echo e(deleteLink( $link->id )); ?>">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a href="<?php echo e(editLink( 'edit', 'sidebar-item', $index + 1, $link->id, $item->id )); ?>">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a href="<?php echo e(editLink( 'add', 'sidebar-item', $index + 1, false, $item->id )); ?>">
                    <i class="fa fa-plus"></i>
                </a>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if( editMode() ): ?>
        <a  class="sidebar-item" 
            href="<?php echo e(editLink( 'add', 'sidebar-item', $ordem + 1, false, $item->id )); ?>"
            style="display:block; border: 1px dashed #999" data-toggle="tooltip" data-placement="left" title="Descrição do link">
            <fa class="fa fa-plus"></fa>
            Novo item
        </a>
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    

    <?php if( editMode() ): ?>
    
    <div class="group-divider" style="border: 1px dashed #999">
        <a href="<?php echo e(editLink( 'add', 'sidebar-group', count( components( 'sidebar-group') ) + 1 )); ?>">
            &nbsp; <fa class="fa fa-plus"></fa> Novo grupo
        </a>
    </div>
    <?php endif; ?>
</div>