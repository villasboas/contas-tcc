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
  <?php if( $item['type'] == 'date' ): ?>
  <?php echo inputDate( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ); ?>

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