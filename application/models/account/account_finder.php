<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Account_finder
 * 
 * Finder de account
 * 
 */
class Account_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Account_model';

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