<?php $__env->startSection('content'); ?>
<div class="bg-light p-2 z-depth-1 rounded pt-3 pb-3">
    <?php echo $__env->yieldContent( 'beforeGrid' ); ?>

    <?php if( method_exists( $modelGrid, 'form' ) ): ?>
    <?php echo $__env->make( 'components.model-form.model-form' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div class="col pb-3 text-right">
        <?php if( isset( $modelGrid->enableImport ) && $modelGrid->enableImport ): ?>
        <button class="btn btn-info">Importar CSV</button>
        <?php endif; ?>

        <?php if( isset( $modelGrid->enableExport ) && $modelGrid->enableExport ): ?>
        <button class="btn btn-info">Exportar CSV</button>
        <?php endif; ?>

        <?php if( method_exists( $modelGrid, 'form' ) ): ?>
        <a href="<?php echo e(site_url( $modelGrid->table().'/list?addModal=true' )); ?>" class="btn btn-success text-light">
            Adicionar
        </a>
        <?php endif; ?>
    </div>

    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <?php $__currentLoopData = $modelGrid->visibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo $field; ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if( method_exists( $modelGrid, 'bulkActions' ) ): ?>
                <th class="text-center" style="width: 20px;">
                    ---
                </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <?php $__currentLoopData = $modelGrid->visibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($field); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if( method_exists( $modelGrid, 'bulkActions' ) ): ?>
                <th class="text-center">
                    <label class="custom-control custom-checkbox">
                        <input id="bulkCheckbox" type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </th>
                <?php endif; ?>
            </tr>
            <?php if( method_exists( $modelGrid, 'bulkActions' ) ): ?>
            <tr>
                <th class="text-right" colspan="<?php echo e(count( $modelGrid->visibles ) + 1); ?>">
                    <button id="executeBulkActions" class="btn btn-primary">
                        Executar
                    </button>
                    <select class="selectpicker dropup"
                            id="bulkActionSelect"
                            data-size="5"
                            name="groups[]"
                            title="Ações em massa">
                        <?php $__currentLoopData = $modelGrid->bulkActions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($method); ?>"><?php echo e($action); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </th>
            </tr>
            <?php endif; ?>
        </tfoot>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'scripts' ); ?>
<script>
$(document).ready(function() {

    // Seta o datatables
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo e(site_url( $url )); ?>",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
    });

    // Bulk checkbox select
    $( '#bulkCheckbox' ).change( function() {
        if ( $( '#bulkCheckbox' ).is( ':checked' ) ) {
            $( '.bulkCheckbox' ).prop( 'checked', true );
        } else {
            $( '.bulkCheckbox' ).prop( 'checked', false );            
        }
    });

    // Executa ação bulk
    $( '#executeBulkActions' ).click( function() {

        // Pega o valor selecionado
        var val = $( '#bulkActionSelect' ).val();
        if( !val ) {
            swal(   'Selecione uma ação!', 
                    'Você deve selecionar uma ação para ser executada', 
                    'error' );
            return;
        }

        // Cria um formulário
        var form = $( '<form method="POST" class="hidden"></form>' ).attr( 'action', val );
        $( document.body ).append( form );
        form.append( $( '.bulkCheckbox' ) );
        form.submit();
    });
});
</script>
<?php echo $__env->yieldContent( 'scripts-grid' ); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent( 'afterGrid' ); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>