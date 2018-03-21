<!-- Modal -->
<div class="modal fade {{ getAttr( 'edit_mode' ) ? 'show' : '' }}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      {!! form_open( 'edit_mode/salvar', [ 'class' => 'modal-content'] ) !!}
    
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Item da página</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        <span class="badge badge-success">{{ getAttr( 'slug' ) }}</span>
        
        @if( attrValue( 'id' ) )
        {!! inputHidden( 'id', attrValue( 'id' ) ) !!}
        @endif
        @if( getAttr( 'parent' ) )
        {!! inputHidden( 'component_id', getAttr( 'parent' ) ) !!}
        @endif

        {!! inputHidden( 'redirect', uri_string() ) !!}        
        {!! inputHidden( 'slug', getAttr( 'slug' ) ) !!}        
        {!! inputHidden( 'position', getAttr( 'ordem' ) ) !!}        
        {!! inputText( 'Texto',    'text',    [ 'attr' => [ 'value' => attrValue( 'text' ) ] ] ) !!}
        {!! inputText( 'Link',     'link',    [ 'attr' => [ 'value' => attrValue( 'link' ) ] ]  ) !!}
        {!! inputText( 'Icone',    'icon',    [ 'attr' => [ 'value' => attrValue( 'icon' ) ] ]  ) !!}
        {!! inputText( 'Contexto', 'context', [ 'attr' => [ 'value' => attrValue( 'context' ) ] ]  ) !!}
        <br>
        <div class="row">
          <div class="col">
            <select class="form-control selectpicker dropup" 
                    data-live-search="true"
                    data-size="5"
                    name="groups[]"
                    title="Escolha os grupos de acesso ..."
                    multiple>
              @foreach( $groups as $group )
              <option value="{{ $group->id }}"
                      {{ $group->canUseComponent( attrValue( 'id' ) ) ? 'selected="selected"' : '' }}>              
                      {{ $group->name }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    
    </div>
  {!! form_close() !!}  
</div>