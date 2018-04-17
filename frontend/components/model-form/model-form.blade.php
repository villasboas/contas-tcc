<!-- Modal -->
<div class="modal fade {{ getAttr( 'addModal' ) ? 'show' : '' }}" id="addModal" tabindex="-1">
<div class="modal-dialog  modal-lg" role="document">
    {!! form_open_multipart( $modelGrid->form( 'url' ), [ 'class' => 'modal-content'] ) !!}
  
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      @php

        // Obtem os campos
        $formFields = array_chunk( $modelGrid->form( 'fields' ), 5 );
 
      @endphp

      <div class="row">
      @foreach( $formFields as $columns )
        <div class="col">
        @foreach(  $columns as $item )
          @if( $item['type'] == 'midia' )

          @section( 'headScripts' )
            @php
              $midia = $modelGrid->belongsTo( 'midia' );
            @endphp
            @if( $midia )
              <script>
              var selectedMidias = [
                {!! json_encode( $midia->metadata() ) !!}
              ];
              </script>
            @endif
          @endsection

          <div  class="midiaInput"         
                {!! isset( $item['size'] ) ? 'data-size="'.$item['size'].'"' : 'data-size=""' !!}
                {!! isset( $item['ratio'] ) ? 'data-ratio="'.$item['ratio'].'"' : '' !!}>

              <label class="d-block pt-2">{{ $item['label'] }}</label>

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
                @{{ title }}
              </button><!-- botao de adicionar foto -->

          </div><!-- input de midia -->

          @endif
          
          @if( $item['type'] == 'text' )
          {!! inputText( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ) !!}
          @endif
          @if( $item['type'] == 'number' )
          {!! inputNumber( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ) !!}
          @endif
          @if( $item['type'] == 'file' )
          {!! inputFile( $item['label'],  $item['name'], [ 'attr' => [ 'value' => $modelGrid->{$item['name']} ] ] ) !!}
          @endif
          @if( $item['type'] == 'select' )
            @if( isset( $item['attModel'] ) )
              {!! select( $item['model'], $item['label'], $item['name'], $modelGrid->{$item['name']}, $item['attModel'] ) !!}
            @elseif( isset( $item['model'] ) )
              {!! select( $item['model'], $item['label'], $item['name'], $modelGrid->{$item['name']} ) !!}
            @elseif( $item['opcoes'] )
              {!! selectOpc( $item['opcoes'], $item['label'], $item['name'],$modelGrid->{$item['name']} ) !!}
            @endif
          @endif
        @endforeach
        </div>
      @endforeach
      </div>
    </div>
    
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
  
  </div>
{!! form_close() !!}  
</div>