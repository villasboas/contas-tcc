<?php

/**
 * LoaderCMD
 * 
 * Agrupa as classes do cmd 
 * 
 */
class LoaderCMD extends CI_Controller {

    /**
     * __construct
     * 
     * Método contructor
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * run
     * 
     * Roda o comando do controller e método correspondentes
     * aos argumentos passados pelo CMD
     *
     * @param [type] ...$params
     * @return void
     */
    public function run( ...$params ) {

        // Seta o nome do controller
        $ctrlName = $params[0];
        unset( $params[0] );

        // Seta o nome do método
        $methodName = isset( $params[1] ) ? $params[1] : 'index';
        if( isset( $params[1] ) ) unset( $params[1] );

        // Verifica se params é um array
        $args = '';
        if ( is_array( $params ) ) {
            foreach( $params as $param ) $args .= ' '.$param.' ';
        }

        // Roda o comando
        passthru( "php index.php cmd/$ctrlName"."CMD $methodName ".$args );
    }
}

// End of file