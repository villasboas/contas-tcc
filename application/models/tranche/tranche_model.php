<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'tranche_finder.php';

/**
 * tranche
 * 
 * Model de tranche
 * 
 */
class Tranche_model extends Tranche_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'bill_id' => 'bill_id',
  'value' => 'value',
  'expiration_date' => 'expiration_date',
  'payment_date' => 'payment_date',
  'paid_value' => 'paid_value',
  'status' => 'status',
  'interest_rate' => 'interest_rate',
);

    /**
     * visibles
     * 
     * Campos visiveis no grid
     *
     * @var array
     */
    public $visibles = array (
  0 => 'ID',
  1 => 'bill_id',
  2 => 'value',
  3 => 'expiration_date',
  4 => 'Ações',
);

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
     * table
     *
     * pega a tabela
     * 
     * @return void
     */
    public function table() {
        return 'tranche';
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
     * columns
     * 
     * Colunas para o DataTables
     *
     * @return void
     */
    public function DataTables() {
        
        // Carrega a library
        $this->load->library( 'DataTables' );

        // Columns
        $columns = array (
  0 => 
  array (
    'db' => 'id',
    'dt' => 0,
  ),
  1 => 
  array (
    'db' => 'bill_id',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'value',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'expiration_date',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'tranche/delete/'.$d );
                $edit = editButton( 'tranche/list?addModal=true&id='.$d );

                // Volta os botões
                return $del.'&nbsp'.$edit;
            }
        ];

        // Volta o resultado
        return $this->datatables->send( $this->table(), $columns );
    }
    
    /**
     * form
     * 
     * Form de inserção
     *
     * @return void
     */
    public function form( $key ) {
        $url = $this->id ? 'tranche/save/'.$this->id : 'tranche/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'bill_id' => 
  array (
    'label' => 'bill_id',
    'name' => 'bill_id',
    'type' => 'number',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'value' => 
  array (
    'label' => 'value',
    'name' => 'value',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'expiration_date' => 
  array (
    'label' => 'expiration_date',
    'name' => 'expiration_date',
    'type' => 'text',
    'rules' => 'trim|required',
  ),
  'payment_date' => 
  array (
    'label' => 'payment_date',
    'name' => 'payment_date',
    'type' => 'text',
    'rules' => 'trim',
  ),
  'paid_value' => 
  array (
    'label' => 'paid_value',
    'name' => 'paid_value',
    'type' => 'text',
    'rules' => 'trim|max_length[255]',
  ),
  'status' => 
  array (
    'label' => 'status',
    'name' => 'status',
    'type' => 'text',
    'rules' => 'trim|required|max_length[1]',
  ),
  'interest_rate' => 
  array (
    'label' => 'interest_rate',
    'name' => 'interest_rate',
    'type' => 'text',
    'rules' => 'trim|max_length[255]',
  ),
)
        ];
        return $data[$key];
    }

    /**
     * permissions
     * 
     * Volta o array de permissões
     *
     * @return Array
     */
    public function permissions() {
        return [
            'add'    => [ 'any' ],
            'edit'   => [ 'any' ],
            'delete' => [ 'any' ],
            'read'   => [ 'any' ]
        ];
    }
}

// End of file