$( document ).ready( function(){
    $('#summernote').summernote({
        lang: 'pt-BR',
        height: 300
    });

    // Salva o item
    $( '.html-modal' ).click( function() {
        var key = $( this ).attr( 'data-item' );
        $( '#summernote' ).summernote( 'code', $( '#'+key+'Value' ).val() );
        $( '#htmlInput' ).val( key );
    });

    // Seta o input
    $( '#use-template' ).click( function() {

        var key = $( '#htmlInput' ).val();
        $( '#'+key+'Value' ).val( $( '#summernote' ).summernote( 'code' ) );
    });
});
