<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Agency_finder
 * 
 * Finder de agency
 * 
 */
class Agency_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Agency_model';

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