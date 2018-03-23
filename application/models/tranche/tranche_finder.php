<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tranche_finder
 * 
 * Finder de tranche
 * 
 */
class Tranche_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Tranche_model';

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