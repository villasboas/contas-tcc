<!-- Modal -->
<div class="modal fade" id="midiaModal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class='modal-content'>

        <?php if( getContext() === 'midia' ): ?>    
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
        </div>
        <?php endif; ?>
    
        <div class="modal-body">

            <ul class="nav nav-tabs" id="midiaTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="novaMidia-tab" data-toggle="tab" href="#novaMidia" role="tab" aria-controls="novaMidia" aria-selected="true">
                        Novo
                    </a>
                </li>
                <?php if( getContext() !== 'midia' ): ?>
                <li class="nav-item">
                    <a class="nav-link" id="carregarMidia-tab" data-toggle="tab" href="#carregarMidia" role="tab" aria-controls="carregarMidia" aria-selected="false">
                        Biblioteca
                    </a>
                </li>
                <?php endif; ?>
            </ul><!-- tabs -->

            <div class="tab-content" id="midiaTabContent">
                <div class="tab-pane fade show active" id="novaMidia" role="tabpanel" aria-labelledby="novaMidia-tab">
                <?php echo $__env->make( 'components.midia-modal.midia-new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="tab-pane fade" id="carregarMidia" role="tabpanel" aria-labelledby="carregarMidia-tab">
                <?php echo $__env->make( 'components.midia-modal.midia-search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div><!-- container -->
            
            <?php if( getContext() !== 'midia' ): ?>
            <div class="page-header">
                <h6>Midias escolhidas</h6>
            </div>
            <div class="row p-3">
                <div v-for="(midia, key) in picked" 
                    class="midia-content m-2" 
                    v-bind:title="midia.name">
                    <a v-bind:href="midia.path" data-lightbox="midias">
                        <img class="position-absolute" v-bind:src="midia.path">
                    </a>
                    <button v-on:click="removeFromList( key )" class="btn btn-danger btn-sm position-absolute" title="Usar imagem">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- corpo do modal -->
        
        <div class="modal-footer">
            <?php if( getContext() !== 'midia' ): ?>
            <button type="button" v-on:click="closeModal()" class="btn btn-secondary">Fechar</button>            
            <button :disabled="picked.length == 0" v-on:click="pickMidias()" type="button" class="btn btn-primary">Escolher</button>
            <?php else: ?>
            <button type="button" <?php echo clickOpen( 'midia' ); ?> class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
            <?php endif; ?>
        </div><!-- botoes de ação -->
    
        </div>
    </div>
</div>