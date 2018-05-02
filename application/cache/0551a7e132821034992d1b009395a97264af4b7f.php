<!-- Modal -->
<div class="modal fade <?php echo e(getAttr( 'addModal' ) ? 'show' : ''); ?>" id="addModal" tabindex="-1">
<div class="modal-dialog  modal-lg" role="document">
    <?php echo form_open_multipart( $modelGrid->form( 'url' ), [ 'class' => 'modal-content'] ); ?>

  
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <?php

        // Obtem os campos
        $formFields = array_chunk( $modelGrid->form( 'fields' ), 5 );
 
      ?>

      <div class="row">
      <?php $__currentLoopData = $formFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col">
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if( $item['type'] == 'midia' ): ?>

          <?php $__env->startSection( 'headScripts' ); ?>
            <?php
              $midia = $modelGrid->belongsTo( 'midia' );
            ?>
            <?php if( $midia ): ?>
              <script>
              var selectedMidias = [
                <?php echo json_encode( $midia->metadata() ); ?>

              ];
              </script>
            <?php endif; ?>
          <?php $__env->stopSection(); ?>

          <div  class="midiaInput"         
                <?php echo isset( $item['size'] ) ? 'data-size="'.$item['size'].'"' : 'data-size=""'; ?>

                <?php echo isset( $item['ratio'] ) ? 'data-ratio="'.$item['ratio'].'"' : ''; ?>>

              <label class="d-block pt-2"><?php echo e($item['label']); ?></label>

              <div v-if="picked.length > 0" class="row pr-2 pl-2">
                <div  v-for="(midia, key) in picked" 
                      class="midia-content p-0 m-2" 
                      v-bind:title="midia.name">
                    <input type="hidden" name="midia[]" v-model="midia.id">
                    <a v-bind:href="midia.path" data-lightbox="midias">
                        <img class="position-absolute" v-bind:src="midia.path">
                    </a>
                    <button type="button" v-on:click="removeFromList( key )" class="btn btn-danger btn-sm position-absolute" title="Usar imagem">
                      <i class="fa fa-trash-o"></i>
                    </button>
                </div>
              </div><!-- midias -->

              <button v-if="attrs.size != picked.length" type="button" class="btn btn-success" v-on:click="open()">
                {{ title }}
              </button><!-- botao de adicionar foto -->

          </div><!-- input de midia -->

          <?php endif; ?>
          
          <?php if( $item['type'] == 'text' ): ?>
          <?php echo inputText( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

          <?php endif; ?>
          <?php if( $item['type'] == 'number' ): ?>
          <?php echo inputNumber( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

          <?php endif; ?>
          <?php if( $item['type'] == 'file' ): ?>
          <?php echo inputFile( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

          <?php endif; ?>
          <?php if( $item['type'] == 'select' ): ?>
            <?php if( isset( $item['attModel'] ) ): ?>
              <?php echo select( $item['model'], $item['label'], $item['name'], $modelGrid->{$item['name']}, $item['attModel'] ); ?>

            <?php elseif( isset( $item['model'] ) ): ?>
              <?php echo select( $item['model'], $item['label'], $item['name'], $modelGrid->{$item['name']} ); ?>

            <?php elseif( $item['opcoes'] ): ?>
              <?php echo selectOpc( $item['opcoes'], $item['label'], $item['name'],$modelGrid->{$item['name']} ); ?>

            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
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