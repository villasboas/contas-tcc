<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'bill_of_sale_finder.php';

/**
 * bill_of_sale
 * 
 * Model de bill_of_sale
 * 
 */
class Bill_of_sale_model extends Bill_of_sale_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'number' => 'number',
  'cnpj' => 'cnpj',
  'value_icms' => 'value_icms',
  'value_ipi' => 'value_ipi',
  'value_produtos' => 'value_produtos',
  'value_total' => 'value_total',
  'issue_date' => 'issue_date',
  'tranche_number' => 'tranche_number',
  'expiration_date_first_tranche' => 'expiration_date_first_tranche',
  'value_tranche' => 'value_tranche',
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
  1 => 'number',
  2 => 'cnpj',
  3 => 'value_icms',
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
        return 'bill_of_sale';
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
    'db' => 'number',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'cnpj',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'value_icms',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'bill_of_sale/delete/'.$d );
                $edit = editButton( 'bill_of_sale/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'bill_of_sale/save/'.$this->id : 'bill_of_sale/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'number' => 
  array (
    'label' => 'number',
    'name' => 'number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cnpj' => 
  array (
    'label' => 'cnpj',
    'name' => 'cnpj',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'value_icms' => 
  array (
    'label' => 'value_icms',
    'name' => 'value_icms',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'value_ipi' => 
  array (
    'label' => 'value_ipi',
    'name' => 'value_ipi',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'value_produtos' => 
  array (
    'label' => 'value_produtos',
    'name' => 'value_produtos',
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
  'issue_date' => 
  array (
    'label' => 'issue_date',
    'name' => 'issue_date',
    'type' => 'text',
    'rules' => 'trim|required',
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
  'value_tranche' => 
  array (
    'label' => 'value_tranche',
    'name' => 'value_tranche',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
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