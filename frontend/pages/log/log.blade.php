@extends('pages.grid.grid')
@section('beforeGrid')
<div class="modal fade {{ isset( $viewLog ) ? 'show' : '' }}" id="logModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class='modal-content'>
    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <h4>
                    {{ $viewLog->action }}
                </h4>
                <p>
                    <small class="text-muted">
                        <i class="fa fa-clock-o"></i> 
                        {{ date( 'H:i:s d-m-Y', strtotime( $viewLog->created_at ) ) }}
                    </small>
                    @if( $viewLog->user_id )
                    <br>
                    <small class="text-muted">
                        <i class="fa fa-user-o"></i> 
                        {{ $viewLog->belongsTo( 'user' )->email }}
                    </small>
                    @endif
                </p>
                <p>{!! $viewLog->text !!}</p>
                @if( $viewLog->json )
                <b>Registro</b>
                <pre>{!! json_encode( json_decode( $viewLog->json ), JSON_PRETTY_PRINT )  !!}</pre>
                @endif
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
    
        </div>
    </div>
</div>
@endsection