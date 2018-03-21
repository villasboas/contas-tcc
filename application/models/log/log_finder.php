<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Log_finder
 * 
 * Finder de log
 * 
 */
class Log_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Log_model';

    /**
     * __construct
     * 
     * Método construtor
     * 
     */
    public function __construct() {
        parent::__construct();
    }
}

/* end of file */