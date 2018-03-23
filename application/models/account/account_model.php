<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'account_finder.php';

/**
 * account
 * 
 * Model de account
 * 
 */
class Account_model extends Account_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'agency_id' => 'agency_id',
  'account_number' => 'account_number',
  'balance' => 'balance',
  'cpf_holder' => 'cpf_holder',
  'name_holder' => 'name_holder',
  'email_holder' => 'email_holder',
  'city_id' => 'city_id',
  'zip_code_holder' => 'zip_code_holder',
  'address_holder' => 'address_holder',
  'address_number_holder' => 'address_number_holder',
  'complement_holder' => 'complement_holder',
  'neighborhood_holder' => 'neighborhood_holder',
  'phone_number_holder' => 'phone_number_holder',
  'cellphone_number_holder' => 'cellphone_number_holder',
  'created_at' => 'created_at',
  'updated_at' => 'updated_at',
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
  1 => 'agency_id',
  2 => 'account_number',
  3 => 'balance',
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
        return 'account';
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
    'db' => 'agency_id',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'account_number',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'balance',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'account/delete/'.$d );
                $edit = editButton( 'account/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'account/save/'.$this->id : 'account/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'agency_id' => 
  array (
    'label' => 'agency_id',
    'name' => 'agency_id',
    'type' => 'number',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'account_number' => 
  array (
    'label' => 'account_number',
    'name' => 'account_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'balance' => 
  array (
    'label' => 'balance',
    'name' => 'balance',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cpf_holder' => 
  array (
    'label' => 'cpf_holder',
    'name' => 'cpf_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'name_holder' => 
  array (
    'label' => 'name_holder',
    'name' => 'name_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'email_holder' => 
  array (
    'label' => 'email_holder',
    'name' => 'email_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'city_id' => 
  array (
    'label' => 'city_id',
    'name' => 'city_id',
    'type' => 'number',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'zip_code_holder' => 
  array (
    'label' => 'zip_code_holder',
    'name' => 'zip_code_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_holder' => 
  array (
    'label' => 'address_holder',
    'name' => 'address_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_number_holder' => 
  array (
    'label' => 'address_number_holder',
    'name' => 'address_number_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'complement_holder' => 
  array (
    'label' => 'complement_holder',
    'name' => 'complement_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'neighborhood_holder' => 
  array (
    'label' => 'neighborhood_holder',
    'name' => 'neighborhood_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'phone_number_holder' => 
  array (
    'label' => 'phone_number_holder',
    'name' => 'phone_number_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cellphone_number_holder' => 
  array (
    'label' => 'cellphone_number_holder',
    'name' => 'cellphone_number_holder',
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