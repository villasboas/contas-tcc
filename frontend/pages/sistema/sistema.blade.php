@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-header">Banco de dados</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-database"></i>
                    </div>
                    <h4 class="card-title text-center">
                        {{ number_format( $dbSize, 2 ) }} mb
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-header">Arquivos</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-files-o"></i>
                    </div>
                    <h4 class="card-title text-center">
                        {{ number_format( $userSize / 1024, 2 ) }} mb
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-header">Usuários</div>
                <div class="card-body">
                    <div class="pb-3 text-center">
                        <i class="fa fa-4x fa-users"></i>
                    </div>
                    <h4 class="card-title text-center">
                        {{ $userSize }}
                    </h4>
                </div>
            </div>
        </div>
    </div><!-- dados do sistema -->

    @if ( admin() )
    <div class="row mt-3 p-3">
        <div class="col bg-light pt-3 pl-5 pr-5 z-depth-1">
            <div class="page-header">
                <h3>Últimos logs</h3>
            </div>
            <br>
            <ul class="timeline">
                @foreach( $logs->data as $log )
                <li class="timeline-inverted">
                    <div class="timeline-badge {{ $log->color }}"></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">
                                    {{ $log->action }}
                                </h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 
                                        {{ date( 'H:i:s d-m-Y', strtotime( $log->created_at ) ) }}
                                    </small>
                                    @if( $log->user_id )
                                    <br>
                                    <small class="text-muted">
                                        <i class="fa fa-user-o"></i> 
                                        {{ $log->belongsTo( 'user' )->email }}
                                    </small>
                                    @endif
                                </p>
                        </div>
                        <div class="timeline-body">
                            <p>{!! $log->text !!}</p>
                            @if( $log->json )
                            <br>
                            <b>Registro</b>
                            <pre>{!! json_encode( json_decode( $log->json ), JSON_PRETTY_PRINT )  !!}</pre>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div><!-- logs -->

    <div class="row mt-5">
        <div class="col text-center">
            <a href="{{ site_url( 'log/list' ) }}">Ver todos os logs</a>
        </div>
    </div><!-- link para os logs -->
    @endif
@endsection