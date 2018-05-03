<!-- Modal -->
{!! form_open_multipart( $modelGrid->form( 'url' ).'?addModal=true', [ 'class' => 'modal-content'] ) !!}
  
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Novo registro</h5>
    </div>

    <div class="modal-body">

      @if(isset( $modelGrid->hasFieldsets ) && $modelGrid->hasFieldsets )
        @foreach( $modelGrid->form('fields') as $fieldset => $group )
        <fieldset>
          <legend>{{ $fieldset }}</legend>
          @php
          $even    = !( count( $group ) % 2 == 0 );
          $printLn = true;
          @endphp
          @foreach( $group as $item )
            @if( $loop->last && $even )
              <div class="row">
                <div class="col">
                  @include('components.model-fields.model-fields')
                </div>
              </div>
            @else
              @if( ( $loop->index % 2 == 0 ) && $loop->index != 1  )
              <div class="row">
              @endif

              <div class="col">
                  @include('components.model-fields.model-fields')
              </div>

              @if( ( $loop->index % 2 != 0 ) || $loop->index == 1  )
              </div>
              @endif

            @endif
          @endforeach
        </fieldset>
        <hr>
        @endforeach 
      @else
        @php
        $formFields = array_chunk( $modelGrid->form( 'fields' ), 5 );
        @endphp

        <div class="row">
        @foreach( $formFields as $columns )
          <div class="col">
              @foreach(  $columns as $item )
              @include('components.model-fields.model-fields')
              @endforeach
          </div>
        @endforeach
        </div>
      @endif
    </div>
    
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="window.history.back()">Fechar</button>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

{!! form_close() !!}  
