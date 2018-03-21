<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'model/Model_relation.php';

class SG_Model extends Model_relation {

    /**
     * opts
     * 
     * Opções dos campos
     *
     * @var array
     */
    public $opts = [];

    /**
     * visibles
     * 
     * Campos visiveis no grid
     *
     * @var array
     */
    public $visibles = [];

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
     * main
     * 
     * Pega o campo principal
     *
     * @return void
     */
    public function main() {
        return $this->id;
    }

    /**
     * total
     * 
     * O número total de resultados
     *
     * @return void
     */
    public function total() {

        // Pega o número de linhas
        $query = $this->db->query( 'SELECT * FROM '.$this->table() );
        return $query->num_rows();
    }
}

// End of file