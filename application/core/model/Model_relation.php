<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Model_finder.php';

/**
 * Model_relation
 * 
 * Relações entre models
 * 
 */
class Model_relation extends Model_finder {
    
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
     * belongsTo
     * 
     * define uma relação de belongsTo
     *
     * @param [string] $model
     * @param [string] $parentId
     * @param [string] $id
     * @return void
     */
    public function belongsTo( string $model, $instance = false ) {

        // pega a chave
        $key = $model.'_id';

        // verifica se existe a instancia
        if ( $instance ) {

            // prepara o update
            $this->db->where( 'id', $this->id );
            $ret = $this->db->update( $this->table(), [ $key => $instance->id ] );

            // verifica se fez o update
            if ( $ret ) {

                // seta o id
                $this->$key = $instance->id;

                // volta true
                return true;

            } else return false;
        
        } else {

            // carrega model
            $this->load->model( $model );

            // seta o nome da model carregada
            $name = ucfirst( $model );

            // procura pelo id
            $this->$model = $this->$name->findById( $this->$key );

            // volta o resultado
            return $this->$model;
        }
    }

    /**
     * hasMany
     * 
     * define uma relacao de hasMany
     *
     * @param string $model
     * @param boolean $instances
     * @return boolean
     */
    public function hasMany( string $model, $instances = false ) {
        
        // carrega o helper
        $this->load->helper( 'inflector' );

        // seta a chave
        $me = strtolower( str_replace( '_model', '', $this->entity ) );
        $key = $me.'_id';
        
        // verifica se existe instancias
        if ( $instances ) {
            
            // verifica se é um array
            if ( is_array( $instances ) ) {

                // percorre todas as instancias
                foreach( $instances as $instance ) 
                    $instance->belongsTo( $me, $this );
            } else $instances->belongsTo( $me, $this );
        }

        // carrega a model
        $this->load->model( $model );

        // seta o nome da model
        $name = ucfirst( $model );

        // faz a busca
        return $this->$name->where( " $key = $this->id " );
    }
}

// End of file