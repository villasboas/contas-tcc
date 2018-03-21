@extends( 'layouts.admin' )
@section( 'content' )
    <div class="page-header">
        <h1>Simple News Admin</h1>
    </div>

    <div class="row">
        <form method="GET" action="{{site_url( 'home' ) }}" class="input-group mb-3">
            <input  type="text" 
                    class="form-control" 
                    placeholder="Buscar link RSS" 
                    name="query">
            <div class="input-group-prepend">
                <button class="btn btn-warning" type="submit">Buscar</button>
            </div>
        </form>

        @foreach( $rss->news as $new )
        <div class="col-md-4 p-0">
            <div class="card">
                @if( $new['cover'] )
                <img class="card-img-top" src="{{ $new['cover'] }}" alt="Card image cap">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $new['title'] }}</h5>
                    <p class="card-text">{{ $new['description'] }}</p>
                    @if( isset( $new['pubDate'] ) )
                    <p>
                        <small>{{ date( 'H:i:s d-m-Y', strtotime( $new['pubDate']))}}</small>
                    </p>
                    @endif
                    <a href="{{ $new['link'] }}" target="blank" class="btn btn-primary">Abrir link</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    

@endsection