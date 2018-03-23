<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'bill_finder.php';

/**
 * bill
 * 
 * Model de bill
 * 
 */
class Bill_model extends Bill_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'client_id' => 'client_id',
  'bill_of_sale_id' => 'bill_of_sale_id',
  'cnpj' => 'cnpj',
  'portador' => 'portador',
  'description' => 'description',
  'value_total' => 'value_total',
  'tranche_number' => 'tranche_number',
  'expiration_date_first_tranche' => 'expiration_date_first_tranche',
  'status' => 'status',
  'created_at' => 'created_at',
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
  1 => 'client_id',
  2 => 'bill_of_sale_id',
  3 => 'cnpj',
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
        return 'bill';
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
    'db' => 'client_id',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'bill_of_sale_id',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'cnpj',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'bill/delete/'.$d );
                $edit = editButton( 'bill/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'bill/save/'.$this->id : 'bill/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'client_id' => 
  array (
    'label' => 'client_id',
    'name' => 'client_id',
    'type' => 'number',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'bill_of_sale_id' => 
  array (
    'label' => 'bill_of_sale_id',
    'name' => 'bill_of_sale_id',
    'type' => 'number',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'cnpj' => 
  array (
    'label' => 'cnpj',
    'name' => 'cnpj',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'portador' => 
  array (
    'label' => 'portador',
    'name' => 'portador',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'description' => 
  array (
    'label' => 'description',
    'name' => 'description',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'value_total' => 
  array (
    'label' => 'value_total',
    'name' => 'value_total',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'tranche_number' => 
  array (
    'label' => 'tranche_number',
    'name' => 'tranche_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'expiration_date_first_tranche' => 
  array (
    'label' => 'expiration_date_first_tranche',
    'name' => 'expiration_date_first_tranche',
    'type' => 'text',
    'rules' => 'trim|required',
  ),
  'status' => 
  array (
    'label' => 'status',
    'name' => 'status',
    'type' => 'text',
    'rules' => 'trim|required|max_length[1]',
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