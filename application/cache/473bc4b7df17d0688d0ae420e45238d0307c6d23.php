<!-- Modal -->
<?php echo form_open_multipart( $modelGrid->form( 'url' ).'?addModal=true', [ 'class' => 'modal-content'] ); ?>

  
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
    </div>

    <div class="modal-body">

      <?php if(isset( $modelGrid->hasFieldsets ) && $modelGrid->hasFieldsets ): ?>
        <?php $__currentLoopData = $modelGrid->form('fields'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldset => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <fieldset>
          <legend><?php echo e($fieldset); ?></legend>
          <?php
          $even    = !( count( $group ) % 2 == 0 );
          $printLn = true;
          ?>
          <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( $loop->last && $even ): ?>
              <div class="row">
                <div class="col">
                  <?php echo $__env->make('components.model-fields.model-fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
              </div>
            <?php else: ?>
              <?php if( ( $loop->index % 2 == 0 ) && $loop->index != 1  ): ?>
              <div class="row">
              <?php endif; ?>

              <div class="col">
                  <?php echo $__env->make('components.model-fields.model-fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              </div>

              <?php if( ( $loop->index % 2 != 0 ) || $loop->index == 1  ): ?>
              </div>
              <?php endif; ?>

            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </fieldset>
        <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      <?php else: ?>
        <?php
        $formFields = array_chunk( $modelGrid->form( 'fields' ), 5 );
        ?>

        <div class="row">
        <?php $__currentLoopData = $formFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col">
              <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo $__env->make('components.model-fields.model-fields', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </div>
    
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="window.history.back()">Fechar</button>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

<?php echo form_close(); ?>  
