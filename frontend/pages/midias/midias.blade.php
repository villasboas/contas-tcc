@extends('layouts.admin')
@section('content')
    <div id="midias" class="row pr-3">
        <div class="col bg-light z-depth-1 rounded pb-3">
            
            <div class="page-header">
                <h2>Midias</h2>
            </div>

            <form mehotd="get" action="{{ site_url( 'midia' ) }}" class="row">
                <div class="col p-3">
                    <div class="input-group">
                        <input  type="text" 
                                class="form-control" 
                                placeholder="Encontre suas midias..." 
                                value="{{ $query ? $query : '' }}"
                                name="query">
                        <span class="input-group-btn">
                            <button class="btn btn-primary">Pesquisar!</button>
                        </span>
                    </div>
                </div>
            </form><!-- formulário de pesquisa -->

            @if( $query )
            <div class="row pl-3 pr-3">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <b>Buscando por:</b> {{ $query }}
                        </li>
                    </ol>
                </nav>
            </div>
            @endif<!-- breadcrumb -->

            <div class="row pl-3 pr-3">
                @foreach( $midias as $key => $item )
                <div class="title-divider">
                    <span>{{ $key }}</span>
                </div>

                @if ($loop->first)
                <div class="midia-seletor midia-content text-center col-xs-12 col-md-2 pt-3 m-1">
                    <small>
                        Adicionar nova imagem <br>
                        <i class="fa fa-plus"></i>
                    </small>
                </div>
                @endif

                @foreach( $item as $midia )
                <div class="midia-content p-0 m-1" title="{{ $midia->name }}">
                    <a href="{{ $midia->path() }}" data-lightbox="midias">
                        <img class="position-absolute" src="{{ $midia->path() }}">
                    </a>
                    <button {!! clickOpen( 'midia/delete/'.$midia->id ) !!} class="btn btn-danger btn-sm position-absolute" title="Remover imagem">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
                @endforeach
                @endforeach
            </div>
            
            <div class="row">
                <div class="col pt-5">
                    {!! $pagination_links !!}
                </div>
            </div>
        </div>
    </div>
@endsection