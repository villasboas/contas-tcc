<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Permission_finder
 * 
 * Finder de permission
 * 
 */
class Permission_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Permission_model';

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
     * byComponent
     * 
     * Busca pelo ID do componente
     *
     * @param [type] $component_id
     * @return void
     */
    public function byComponent( $component_id ) {
        return $this->where( " component_id = $component_id " )->find();
    }

    /**
     * byComponentGroup
     * 
     * pega o componente
     *
     * @param [type] $routine_id
     * @param [type] $group_id
     * @return void
     */
    public function byComponentGroup( $routine_id, $group_id ) {
        return $this->where( " component_id = $routine_id AND group_id = $group_id " )->findOne();
    }
}

/* end of file */