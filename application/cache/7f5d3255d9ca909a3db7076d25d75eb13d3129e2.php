<!-- Modal -->
<div class="modal fade <?php echo e(getAttr( 'edit_mode' ) ? 'show' : ''); ?>" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <?php echo form_open( 'edit_mode/salvar', [ 'class' => 'modal-content'] ); ?>

    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Item da página</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        <span class="badge badge-success"><?php echo e(getAttr( 'slug' )); ?></span>
        
        <?php if( attrValue( 'id' ) ): ?>
        <?php echo inputHidden( 'id', attrValue( 'id' ) ); ?>

        <?php endif; ?>
        <?php if( getAttr( 'parent' ) ): ?>
        <?php echo inputHidden( 'component_id', getAttr( 'parent' ) ); ?>

        <?php endif; ?>

        <?php echo inputHidden( 'redirect', uri_string() ); ?>        
        <?php echo inputHidden( 'slug', getAttr( 'slug' ) ); ?>        
        <?php echo inputHidden( 'position', getAttr( 'ordem' ) ); ?>        
        <?php echo inputText( 'Texto',    'text',    [ 'attr' => [ 'value' => attrValue( 'text' ) ] ] ); ?>

        <?php echo inputText( 'Link',     'link',    [ 'attr' => [ 'value' => attrValue( 'link' ) ] ]  ); ?>

        <?php echo inputText( 'Icone',    'icon',    [ 'attr' => [ 'value' => attrValue( 'icon' ) ] ]  ); ?>

        <?php echo inputText( 'Contexto', 'context', [ 'attr' => [ 'value' => attrValue( 'context' ) ] ]  ); ?>

        <br>
        <div class="row">
          <div class="col">
            <select class="form-control selectpicker dropup" 
                    data-live-search="true"
                    data-size="5"
                    name="groups[]"
                    title="Escolha os grupos de acesso ..."
                    multiple>
              <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($group->id); ?>"
                      <?php echo e($group->canUseComponent( attrValue( 'id' ) ) ? 'selected="selected"' : ''); ?>>              
                      <?php echo e($group->name); ?>

              </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    
    </div>
  <?php echo form_close(); ?>  
</div>