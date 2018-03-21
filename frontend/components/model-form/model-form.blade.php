<!-- Modal -->
<div class="modal fade {{ getAttr( 'addModal' ) ? 'show' : '' }}" id="addModal" tabindex="-1">
  <div class="modal-dialog" role="document">
      {!! form_open( $modelGrid->form( 'url' ), [ 'class' => 'modal-content'] ) !!}
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
      
      <div  class="midiaInput"
            data-size="1"           
            data-name="midias"
            data-ratio="4:3">

          <label class="d-block">Avatar</label>

          <div v-if="picked.length > 0" class="row pr-2 pl-2">
            <div  v-for="(midia, key) in picked" 
                  class="midia-content p-0 m-2" 
                  v-bind:title="midia.name">
                <input type="hidden" name="midias[]" v-model="midia.id">
                <a v-bind:href="midia.path" data-lightbox="midias">
                    <img class="position-absolute" v-bind:src="midia.path">
                </a>
                <button type="button" v-on:click="removeFromList( key )" class="btn btn-danger btn-sm position-absolute" title="Usar imagem">
                  <i class="fa fa-trash-o"></i>
                </button>
            </div>
          </div><!-- midias -->

          <button v-if="attrs.size != picked.length" type="button" class="btn btn-success" v-on:click="open()">
            @{{ title }}
          </button><!-- botao de adicionar foto -->

      </div><!-- input de midia -->
      
        @foreach( $modelGrid->form( 'fields' ) as $item )
          @if( $item['type'] == 'text' )
          {!! inputText( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ) !!}
          @endif
          @if( $item['type'] == 'number' )
          {!! inputNumber( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ) !!}
          @endif
        @endforeach
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    
    </div>
  {!! form_close() !!}  
</div>