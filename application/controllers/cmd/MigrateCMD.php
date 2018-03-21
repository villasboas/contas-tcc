<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MigrateCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class MigrateCMD extends CI_Controller {

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
    public function index( $tables = false ) {
        cmdLine( 'Iniciando a migracao ...' );

        // verifica se foi especificado as tabelas
        if ( $tables ) {
            $tables = explode( ':', $tables );
            foreach( $tables as $table ) {
                cmdLine( 'Migrando tabela: '.$table );
            }
        }

        // carrega a library de migração
        $this->load->library( 'migration' );

        // faz a migração
        $this->migration->start( $tables );
        cmdLine( 'Migracao feita!' );
    }
}

// End of file
