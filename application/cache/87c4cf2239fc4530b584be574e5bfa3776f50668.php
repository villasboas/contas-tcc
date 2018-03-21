<?php $__env->startSection('content'); ?>
    <div id="midias" class="row pr-3">
        <div class="col bg-light z-depth-1 rounded pb-3">
            
            <div class="page-header">
                <h2>Midias</h2>
            </div>

            <form mehotd="get" action="<?php echo e(site_url( 'midia' )); ?>" class="row">
                <div class="col p-3">
                    <div class="input-group">
                        <input  type="text" 
                                class="form-control" 
                                placeholder="Encontre suas midias..." 
                                value="<?php echo e($query ? $query : ''); ?>"
                                name="query">
                        <span class="input-group-btn">
                            <button class="btn btn-primary">Pesquisar!</button>
                        </span>
                    </div>
                </div>
            </form><!-- formulário de pesquisa -->

            <?php if( $query ): ?>
            <div class="row pl-3 pr-3">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <b>Buscando por:</b> <?php echo e($query); ?>

                        </li>
                    </ol>
                </nav>
            </div>
            <?php endif; ?><!-- breadcrumb -->

            <div class="row pl-3 pr-3">
                <?php $__currentLoopData = $midias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="title-divider">
                    <span><?php echo e($key); ?></span>
                </div>

                <?php if($loop->first): ?>
                <div class="midia-seletor midia-content text-center col-xs-12 col-md-2 pt-3 m-1">
                    <small>
                        Adicionar nova imagem <br>
                        <i class="fa fa-plus"></i>
                    </small>
                </div>
                <?php endif; ?>

                <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="midia-content p-0 m-1" title="<?php echo e($midia->name); ?>">
                    <a href="<?php echo e($midia->path()); ?>" data-lightbox="midias">
                        <img class="position-absolute" src="<?php echo e($midia->path()); ?>">
                    </a>
                    <button <?php echo clickOpen( 'midia/delete/'.$midia->id ); ?> class="btn btn-danger btn-sm position-absolute" title="Remover imagem">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="row">
                <div class="col pt-5">
                    <?php echo $pagination_links; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>