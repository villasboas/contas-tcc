<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Component_finder
 * 
 * Finder de component
 * 
 */
class Component_finder extends SG_Model {

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = 'Component_model';

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
     * bySlug
     * 
     * Carrega o componente pelo slug
     *
     * @param [type] $slug
     * @return void
     */
    public function bySlug( $slug ) {
        $this->db->order_by( 'position', 'ASC' );

        // Seta o where
        $where = " slug = '$slug' ";

        // Verifica se existe um contexto
        if ( $context = getContext() ) {
            $where .= " AND ( context IS NULL OR context = '$context' ) ";            
        } else {
            $where .= " AND context IS NULL";
        }
        return $this->where( $where )->find();        
    }

    /**
     * byParentIdAndSlug
     * 
     * Pega um componente pelo slug e pelo parentId
     *
     * @param [type] $slug
     * @param [type] $parentId
     * @return void
     */
    public function byParentIdAndSlug( $slug, $parentId ) {
        $this->db->order_by( 'position', 'ASC' );

        // Seta o where
        $where = " slug = '$slug' AND component_id = $parentId ";

        // Verifica se existe um contexto
        if ( $context = getContext() ) {
            $where .= " AND ( context IS NULL OR context = '$context' ) ";            
        } else {
            $where .= " AND context IS NULL ";            
        }

        // Volta os dados
        return $this->where( $where )->find();        
    }

    /**
     * after
     * 
     * Obtem os elementos após um elemento
     *
     * @param [type] $position
     * @return void
     */
    public function after( $slug, $position ) {
        return $this->where( " slug = '$slug' AND position >= $position " )->find();
    }
}

/* end of file */