<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Midia_finder
 * 
 * Finder de midia
 * 
 */
class Midia_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Midia_model';

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