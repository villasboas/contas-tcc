<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group_finder
 * 
 * Finder de group
 * 
 */
class Group_finder extends SG_Model {

    /**
     * default
     *
     * grupo padrao
     * 
     * @var string
     */
    public $default = 'admin';
    
    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Group_model';

    /**
     * __construct
     * 
     * Método construtor
     * 
     */
    public function __construct() {
        parent::__construct();

        // verifica se existe um grupo padrão
        $this->default = $this->settings->get( 'default-auth-group', 'admin' );
    }

    /**
     * slug
     * 
     * busca um grupo pelo slug
     *
     * @param [type] $slug
     * @return void
     */
    public function slug( $slug ) {
        return $this->where( " slug = '$slug' " )->findOne();
    }

    /**
     * nonAdmin
     * 
     * Busca os grupos que não são admin
     *
     * @param [type] $slug
     * @return void
     */
    public function nonAdmin() {
        return $this->where( " slug != 'admin' " )->find();
    }

    /**
     * defaultGroup
     * 
     * pega o grupo padrao
     *
     * @return void
     */
    public function defaultGroup() {
        return $this->where( " slug = '$this->default' " )->findOne();
    }
}

// End of file