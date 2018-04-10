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
  'state' => 'state',
  'city' => 'city',
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
  1 => 'Agencia',
  2 => 'Número',
  3 => 'Saldo',
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
    'label' => 'Agência',
    'model' => [ 'name' => 'agency' , 'call' => 'Agency' ],
    'name' => 'agency_id',
    'type' => 'select',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'account_number' => 
  array (
    'label' => 'Número',
    'name' => 'account_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'balance' => 
  array (
    'label' => 'Saldo',
    'name' => 'balance',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cpf_holder' => 
  array (
    'label' => 'CPF do titular',
    'name' => 'cpf_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'name_holder' => 
  array (
    'label' => 'Nome do titular',
    'name' => 'name_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'email_holder' => 
  array (
    'label' => 'Email do titular',
    'name' => 'email_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'state' => 
  array (
    'label' => 'Estado do titular',
    'name' => 'state',
    'type' => 'text',
    'rules' => 'trim|required|max_length[11]',
  ),
  'city' => 
  array (
    'label' => 'Cidade do titular',
    'name' => 'city',
    'type' => 'text',
    'rules' => 'trim|required|max_length[11]',
  ),
  'zip_code_holder' => 
  array (
    'label' => 'CEP do titular',
    'name' => 'zip_code_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_holder' => 
  array (
    'label' => 'Endereço do titular',
    'name' => 'address_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_number_holder' => 
  array (
    'label' => 'Número do titular',
    'name' => 'address_number_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'complement_holder' => 
  array (
    'label' => 'Complemento do titular',
    'name' => 'complement_holder',
    'type' => 'text',
    'rules' => 'trim|max_length[255]',
  ),
  'neighborhood_holder' => 
  array (
    'label' => 'Bairro do titular',
    'name' => 'neighborhood_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'phone_number_holder' => 
  array (
    'label' => 'Telefone do titular',
    'name' => 'phone_number_holder',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cellphone_number_holder' => 
  array (
    'label' => 'Celular do titular',
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