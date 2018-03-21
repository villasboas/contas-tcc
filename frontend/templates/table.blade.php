<table>
    <tr>
        <td>id</td>
        @foreach( $model->fields as $item ) 
        <td>{{ $item }}</td>
        @endforeach
    </tr>
    @foreach( $dados as $dado ) 
    <tr>
        <td>{{ $dado->id }}</td>
        @foreach( $model->fields as $item ) 
        <td>{{ $dado->{$item} }}</td>
        @endforeach
    </tr>
    @endforeach
</table>