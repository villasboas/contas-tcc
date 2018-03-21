<!-- Modal -->
<div class="modal fade <?php echo e(getAttr( 'addModal' ) ? 'show' : ''); ?>" id="addModal" tabindex="-1">
  <div class="modal-dialog" role="document">
      <?php echo form_open( $modelGrid->form( 'url' ), [ 'class' => 'modal-content'] ); ?>

    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        <?php $__currentLoopData = $modelGrid->form( 'fields' ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if( $item['type'] == 'text' ): ?>
          <?php echo inputText( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

          <?php endif; ?>
          <?php if( $item['type'] == 'number' ): ?>
          <?php echo inputNumber( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    
    </div>
  <?php echo form_close(); ?>  
</div>