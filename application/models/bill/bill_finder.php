<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bill_finder
 * 
 * Finder de bill
 * 
 */
class Bill_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Bill_model';

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