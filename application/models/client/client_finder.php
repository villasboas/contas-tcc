<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Client_finder
 * 
 * Finder de client
 * 
 */
class Client_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Client_model';

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