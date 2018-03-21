<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_group_finder
 * 
 * Finder de user_group
 * 
 */
class User_group_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'User_group_model';

    /**
     * __construct
     * 
     * Método construtor
     * 
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * getByUser
     * 
     * pega as relações pelo usuário
     *
     * @param [type] $user
     * @return void
     */
    public function getByUser( $user ) {
        return $this->where( " user_id = '$user->id' " )->find();
    }

    /**
     * getByGroup
     * 
     * pega as relações pelo grupo
     *
     * @param [type] $group
     * @return void
     */
    public function getByGroup( $group ) {
        return $this->where( " group_id = '$group->id' " )->find();
    }
}

/* end of file */