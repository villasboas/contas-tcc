import Emitter from 'emitter-js/dist/emitter';

/**
 * Faz o Bootstrap do JS da aplicação
 * 
 */
try {
    
    // Carrega o jQuery
    window.$ = window.jQuery = require( 'jquery' );

    // Carrega o Popper
    window.Popper = require( 'popper.js' );

    // Seta o emissor de eventos
    window.emitter = new Emitter();

} catch (error) {}

// Inclui o view
window.Vue = require( './js/vue.min' );
window.Hub = new window.Vue();

// Inclui o Bootstrap
require( 'bootstrap' );
require( 'bootstrap-select' );
require( '../../node_modules/summernote/dist/summernote-bs4' );
require( '../../node_modules/summernote/lang/summernote-pt-BR' );

// Libs
require( 'lightbox2' );

// Slim
require( './slim/slim.jquery' );

// Plugins
require( './js/midia-selector' );

// Components
require( '../components/edit-mode/edit-mode' );
require( '../components/model-form/model-form' );
require( '../components/midia-modal/midia-modal' );

// Pages
require( '../pages/log/log' );
require( '../pages/settings/settings' );
require( '../pages/midias/midias' );

/**
 * Quando o documento carregar
 * 
 */
$( document ).ready( function() {
    window.slimConfig = {
        label: 'Clique ou arraste sua imagem aqui',
        buttonConfirmLabel: 'Confirmar',
        service: Site.url+'midia/salvar_imagem',
        buttonCancelLabel: 'Cancelar',
        onComplete: function( err, res ) {
            if ( !err ) window.emitter.emit( 'slimSavedPicture', res );
        }
    };
});

// End of file
