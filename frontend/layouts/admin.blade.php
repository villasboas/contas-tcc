<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ base_url( 'public/dist/css/app.css') }}"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"></link>
    @yield( 'styles' )
</head>
<body>
    <script>
        var Site = {
            url: '{{ site_url() }}',
            base: '{{ base_url() }}',
        };
    </script>

    @if( editMode() )
        @include( 'components.edit-mode.edit-mode' )
    @endif
    @include( 'components.helpbar.helpbar' )

    <div class="container">
        @include( 'components.header.header' )
        <div class="row">
            <div class="col-9 p-2">
                @yield( 'content' )
            </div>
            <div class="col-3 p-1">
                @include( 'components.sidebar.sidebar' )  
            </div>
        </div>
        @include( 'components.footer.footer' )        
    </div>

    @include( 'components.midia-modal.midia-modal' )    
    
    <script src="{{ base_url( 'public/dist/js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    
    @yield( 'scripts' )

    @if( flash( 'swaSuccessBody' ) )
    <script>
        swal(
            'Sucesso!',
            '{{ flash( 'swaSuccessBody' ) }}',
            'success'
        );
    </script>
    @endif
    @if( flash( 'swaErrorBody' ) )
    <script>
        swal(
            'Erro!',
            '{{ flash( 'swaErrorBody' ) }}',
            'error'
        );
    </script>
    @endif
</body>
</html>