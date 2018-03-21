<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ base_url( 'public/dist/css/app.css') }}"></link>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></link>
    @yield( 'styles' )
</head>
<body>
    <script>
        var Site = {
            url: '{{ site_url() }}',
            base: '{{ base_url() }}',
        };
    </script>

    @yield( 'content' )

    <script src="{{ base_url( 'public/dist/js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    @yield( 'scripts' )
    
    <!-- Sweet alert body -->
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