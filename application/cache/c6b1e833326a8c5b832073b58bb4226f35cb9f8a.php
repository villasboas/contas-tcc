<?php $__env->startSection('content'); ?>
    <div id="htmlModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="htmlInput">
                    <div id="summernote"></div>
                </div>
                <div class="modal-footer">
                    <button id="use-template" type="button" class="btn btn-primary" data-dismiss="modal">Usar template</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div><!-- modal para edição do HTML -->

    <div class="col">
        <div class="page-header">
            <h1><?php echo e($settingsTitle); ?> <small class="text-muted">configurações</small></h1>
        </div>
    </div>

    <?php echo form_open( 'settings/save' ); ?>

    <?php echo inputHidden( 'slug', $slug ); ?>

    <div id="settings">
        <table class="table table-bordered table-striped">
            <tbody>
                <col width="200">
                <?php $__currentLoopData = $settingsItens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-right">
                        <input  type="text"
                                class="pl-2"
                                name="keys[]"
                                value="<?php echo e($item['key']); ?>"
                                id="<?php echo e($item['key']); ?>Key"                                
                                style="width: 100%">
                    </td>
                    <td>
                        <input  type="text"
                                class="pl-2"
                                name="vals[]"
                                id="<?php echo e($item['key']); ?>Value"
                                value="<?php echo e($item['val']); ?>"
                                style="width: 100%">
                    </td>
                    <td class="text-right">
                        <button type="button" 
                                data-toggle="modal" 
                                data-target="#htmlModal" 
                                data-item="<?php echo e($item['key']); ?>"
                                class="btn html-modal btn-sm btn-info">
                            <i class="fa fa-code"></i>
                        </button><!-- botao para abrir o editor -->
                        <a href="<?php echo e(site_url( 'settings/delete/'.$item['key'].'/'.$slug )); ?>" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </a><!-- botao para removes o item -->
                    </td>
                </tr><!-- atributos existentes -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td class="text-right">
                        <input  type="text"
                                class="pl-2"
                                name="newKey"
                                placeholder="Chave"
                                autocomplete="false"                                
                                style="width: 100%">
                    </td>
                    <td colspan="2">
                        <input  type="text"
                                class="pl-2"
                                name="newVal"
                                autocomplete="false"
                                placeholder="Valor"
                                style="width: 100%">
                    </td>
                </tr><!-- novo atributo -->
            </tbody>
        </table>
    </div>

    <div class="col text-right">
        <button class="btn btn-success">
            Salvar
        </button>
    </div>

    <?php echo form_close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>