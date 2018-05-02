<div id="footer" class="row mt-5 pt-5">
    <div class="col">
        <div class="row">
                        
            <?php $__currentLoopData = components( 'footer'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordem => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 footer-item">
                <div class="footer-item-title">
                    <span>
                        <?php echo e($item->text); ?>

                        <?php if( editMode() ): ?>
                            <a href="<?php echo e(deleteLink( $item->id )); ?>">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            <a href="<?php echo e(editLink( 'edit', 'footer', $ordem + 1, $item->id )); ?>">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a href="<?php echo e(editLink( 'add', 'footer', $ordem + 1)); ?>">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?php endif; ?>
                    </span>
                </div>
                
                <?php $__currentLoopData = components( 'footer-item', $item->id ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($link->link); ?>" class="footer-item-link" style="display: inline-block">

                    <?php if( $link->icon ): ?>
                    <i class="fa fa-<?php echo e($link->icon); ?>"></i>
                    <?php endif; ?>

                    &nbsp;&nbsp;<?php echo e($link->text); ?>


                    <?php if( editMode() ): ?>
                        <a href="<?php echo e(deleteLink( $link->id )); ?>">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        <a href="<?php echo e(editLink( 'edit', 'footer-item', $index + 1, $link->id, $item->id )); ?>">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a href="<?php echo e(editLink( 'add', 'footer-item', $index + 1, false, $item->id )); ?>">
                            <i class="fa fa-plus"></i>
                        </a>
                    <?php endif; ?>
                </a>
                <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if( editMode() ): ?>
                <a  href="<?php echo e(editLink( 'add', 'footer-item', $ordem + 1, false, $item->id )); ?>" class="footer-item-link" 
                    style="display: inline-block; border: 1px dashed #999; color: #999">
                    Novo item                    
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if( editMode() ): ?>
            <div class="col-md-2 footer-item" >
                <div class="footer-item-title">
                    <a href="<?php echo e(editLink( 'add', 'footer', count( components( 'footer') ) + 1 )); ?>" class="p-2 clicable" style="border: 1px dashed #999; color: #999">
                        Novo grupo
                        <i class="fa fa-plus"></i>     
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row footer-rights mt-4 pt-4 pb-5">
            <div class="col text-center">
                <b><?php echo e(sitename()); ?> 2017 - Todos os direitos reservados.</b>                
            </div>
        </div>
    </div>
</div>