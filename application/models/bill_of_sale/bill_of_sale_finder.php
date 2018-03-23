<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bill_of_sale_finder
 * 
 * Finder de bill_of_sale
 * 
 */
class Bill_of_sale_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Bill_of_sale_model';

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