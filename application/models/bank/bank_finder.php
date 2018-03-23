<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bank_finder
 * 
 * Finder de bank
 * 
 */
class Bank_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Bank_model';

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