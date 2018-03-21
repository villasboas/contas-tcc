@if( isset( $errorBody ) && !empty( $errorBody ) )
<div class="alert alert-danger">
    @if( $errorTitle )
    <b>{{ $errorTitle }}</b>
    @endif
    <p>{!! $errorBody !!}</p>
</div>
@endif
