<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'client_finder.php';

/**
 * client
 * 
 * Model de client
 * 
 */
class Client_model extends Client_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'cnpj' => 'cnpj',
  'social_name' => 'social_name',
  'fantasy_name' => 'fantasy_name',
  'representative' => 'representative',
  'cpf' => 'cpf',
  'email' => 'email',
  'city_id' => 'city_id',
  'zip_code' => 'zip_code',
  'address' => 'address',
  'address_number' => 'address_number',
  'complement' => 'complement',
  'neighborhood' => 'neighborhood',
  'phone_number' => 'phone_number',
  'cellphone_number' => 'cellphone_number',
  'status' => 'status',
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
  1 => 'cnpj',
  2 => 'social_name',
  3 => 'fantasy_name',
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
        return 'client';
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
    'db' => 'cnpj',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'social_name',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'fantasy_name',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'client/delete/'.$d );
                $edit = editButton( 'client/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'client/save/'.$this->id : 'client/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'cnpj' => 
  array (
    'label' => 'cnpj',
    'name' => 'cnpj',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'social_name' => 
  array (
    'label' => 'social_name',
    'name' => 'social_name',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'fantasy_name' => 
  array (
    'label' => 'fantasy_name',
    'name' => 'fantasy_name',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'representative' => 
  array (
    'label' => 'representative',
    'name' => 'representative',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cpf' => 
  array (
    'label' => 'cpf',
    'name' => 'cpf',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'email' => 
  array (
    'label' => 'email',
    'name' => 'email',
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
  'zip_code' => 
  array (
    'label' => 'zip_code',
    'name' => 'zip_code',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address' => 
  array (
    'label' => 'address',
    'name' => 'address',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_number' => 
  array (
    'label' => 'address_number',
    'name' => 'address_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'complement' => 
  array (
    'label' => 'complement',
    'name' => 'complement',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'neighborhood' => 
  array (
    'label' => 'neighborhood',
    'name' => 'neighborhood',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'phone_number' => 
  array (
    'label' => 'phone_number',
    'name' => 'phone_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'cellphone_number' => 
  array (
    'label' => 'cellphone_number',
    'name' => 'cellphone_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
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