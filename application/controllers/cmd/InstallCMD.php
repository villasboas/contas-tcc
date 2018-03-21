<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * InstallCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class InstallCMD extends CI_Controller {

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

        // executa as instalações
        cmdLine( "Instalando a aplicacao ..." );
        passthru( "npm install && composer install" );
    }
}

// End of file
