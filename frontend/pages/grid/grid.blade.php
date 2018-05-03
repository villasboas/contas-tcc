@extends('layouts.admin')
@section('content')
@if( !getAttr( 'addModal' ) )
<div class="bg-light p-2 z-depth-1 rounded pt-3 pb-3">
    @yield( 'beforeGrid' )

    <div class="col pb-3 text-right">
        @if( isset( $modelGrid->enableImport ) && $modelGrid->enableImport )
        <button class="btn btn-info">Importar CSV</button>
        @endif

        @if( isset( $modelGrid->enableExport ) && $modelGrid->enableExport )
        <button class="btn btn-info">Exportar CSV</button>
        @endif

        @if( method_exists( $modelGrid, 'form' ) )
        <a href="{{ site_url( $modelGrid->table().'/list?addModal=true' ) }}" class="btn btn-success text-light">
            Adicionar
        </a>
        @endif
    </div>

    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                @foreach( $modelGrid->visibles as $field )
                <th>{!! $field !!}</th>
                @endforeach
                @if( method_exists( $modelGrid, 'bulkActions' ) )
                <th class="text-center" style="width: 20px;">
                    ---
                </th>
                @endif
            </tr>
        </thead>
        <tfoot>
            <tr>
                @foreach( $modelGrid->visibles as $field )
                <th>{{ $field }}</th>
                @endforeach
                @if( method_exists( $modelGrid, 'bulkActions' ) )
                <th class="text-center">
                    <label class="custom-control custom-checkbox">
                        <input id="bulkCheckbox" type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </th>
                @endif
            </tr>
            @if( method_exists( $modelGrid, 'bulkActions' ) )
            <tr>
                <th class="text-right" colspan="{{ count( $modelGrid->visibles ) + 1 }}">
                    <button id="executeBulkActions" class="btn btn-primary">
                        Executar
                    </button>
                    <select class="selectpicker dropup"
                            id="bulkActionSelect"
                            data-size="5"
                            name="groups[]"
                            title="Ações em massa">
                        @foreach( $modelGrid->bulkActions() as $action => $method )
                        <option value="{{ $method }}">{{ $action }}</option>
                        @endforeach
                    </select>
                </th>
            </tr>
            @endif
        </tfoot>
    </table>
</div>
@else
    @if( method_exists( $modelGrid, 'form' ) )
    <div class="pb-3">
        @include( 'components.model-form.model-form' )
    </div>
    @endif
@endif
@endsection

@section( 'scripts' )
<script>
$(document).ready(function() {

    // Seta o datatables
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ site_url( $url ) }}",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
    });

    // Bulk checkbox select
    $( '#bulkCheckbox' ).change( function() {
        if ( $( '#bulkCheckbox' ).is( ':checked' ) ) {
            $( '.bulkCheckbox' ).prop( 'checked', true );
        } else {
            $( '.bulkCheckbox' ).prop( 'checked', false );            
        }
    });

    // Executa ação bulk
    $( '#executeBulkActions' ).click( function() {

        // Pega o valor selecionado
        var val = $( '#bulkActionSelect' ).val();
        if( !val ) {
            swal(   'Selecione uma ação!', 
                    'Você deve selecionar uma ação para ser executada', 
                    'error' );
            return;
        }

        // Cria um formulário
        var form = $( '<form method="POST" class="hidden"></form>' ).attr( 'action', val );
        $( document.body ).append( form );
        form.append( $( '.bulkCheckbox' ) );
        form.submit();
    });
});
</script>
@yield( 'scripts-grid' )
@endsection

@yield( 'afterGrid' )