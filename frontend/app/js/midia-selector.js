$.fn.midiaSelector = function( opts ) {
    var self = this;

    /**
     * Atributos do elemento
     * 
     */
    self.attributes = null;

    /**
     * modal
     * 
     * Modal de midias
     * 
     */
    self.modal = $( '#midiaModal' );

    /**
     * __constructor
     * 
     * Método construtor
     * 
     */
    var __constructor = function() {
        if ( self[0] ) self.attributes = self[0].attributes;
    }
    __constructor();

    /**
     * click
     * 
     * Quando clicado, abre o modal de midia
     * 
     */
    self.click( function(){
        
        // Abre o modal
        self.modal.modal({
            backdrop: 'static',
            keyboard: false
        });
        delete window.slimConfig.ratio;
        $( '#newMidiaInput' ).slim( window.slimConfig );        
        self.modal.modal( 'show' );
    });
};

/**
 * Seta o plugin para todos os elementos com a classe
 * midia-selector
 * 
 */
$( document ).ready( function(){
    $( '.midia-seletor' ).midiaSelector();
});

// End of file