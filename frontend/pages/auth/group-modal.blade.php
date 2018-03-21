@extends( 'pages.grid.grid' )
@if( isset( $user ) && isset( $groups ) )
    @section( 'beforeGrid')
    <div class="modal fade show" id="groupModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!! form_open( 'user/save_group/'.$user->id, [ 'class' => 'modal-content'] ) !!}
        
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Grupos de acesso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="list-group">
                @foreach( $groups as $group )
                <label class="list-group-item custom-control custom-checkbox">
                    <div class="d-block float-left">
                        <input  type="checkbox" 
                                name="groups[]" 
                                value="{{ $group->id }}" 
                                {{ in_array( $group->id, $userGroups ) ? 'checked="checked"': '' }}
                                class="custom-control-input">
                        <div class="mt-3 ml-2 custom-control-indicator"></div>
                    </div>
                    <div class="d-block float-right">                    
                    {{ $group->name }} <small>( {{ $group->slug }} )</small>
                    </div>
                </label>
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
    @endsection
    @section( 'scripts-grid' )
    <script>
        $( document ).ready( function(){
            $('#groupModal.show').modal('show');
        });
    </script>
    @endsection
@endif