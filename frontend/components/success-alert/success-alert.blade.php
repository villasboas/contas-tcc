@if( isset( $successBody ) && !empty( $successBody ) )
<div class="alert alert-danger">
    @if( $successTitle )
    <b>{{ $successTitle }}</b>
    @endif
    <p>{!! $successBody !!}</p>
</div>
@endif