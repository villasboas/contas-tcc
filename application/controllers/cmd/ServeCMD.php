<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * ServeCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class ServeCMD extends CI_Controller {

    /**
     * Método constructor
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Método principal
     *
     * @return void
     */
    public function index() {
        
        // executa o compilador
        cmdLine( "Iniciando o servidor ..." );
        passthru( 'gulp connect' );
    }
}

// End of file
