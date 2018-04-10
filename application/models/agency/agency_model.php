<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'agency_finder.php';

/**
 * agency
 * 
 * Model de agency
 * 
 */
class Agency_model extends Agency_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
  'bank_id' => 'bank_id',
  'agency_number' => 'agency_number',
  'name' => 'name',
  'state' => 'state',
  'city' => 'city',
  'zip_code' => 'zip_code',
  'address' => 'address',
  'address_number' => 'address_number',
  'complement' => 'complement',
  'neighborhood' => 'neighborhood',
  'phone_number' => 'phone_number',
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
  1 => 'Banco',
  2 => 'Número',
  3 => 'Nome',
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
        return 'agency';
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
    'db' => 'bank_id',
    'dt' => 1,
  ),
  2 => 
  array (
    'db' => 'agency_number',
    'dt' => 2,
  ),
  3 => 
  array (
    'db' => 'name',
    'dt' => 3,
  ),
);
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'agency/delete/'.$d );
                $edit = editButton( 'agency/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'agency/save/'.$this->id : 'agency/save';
        $data = [
            'url'    => $url,
            'fields' => array (
  'bank_id' => 
  array (
    'label' => 'Banco',
    'model' => [ 'name' => 'bank' , 'call' => 'Bank' ],
    'name' => 'bank_id',
    'type' => 'select',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  'agency_number' => 
  array (
    'label' => 'Número',
    'name' => 'agency_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'name' => 
  array (
    'label' => 'Nome',
    'name' => 'name',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'state' => 
  array (
    'label' => 'Estado',
    'name' => 'state',
    'type' => 'text',
    'rules' => 'trim|required|max_length[11]',
  ),
  'city' => 
  array (
    'label' => 'Cidade',
    'name' => 'city',
    'type' => 'text',
    'rules' => 'trim|required|max_length[11]',
  ),
  'zip_code' => 
  array (
    'label' => 'CEP',
    'name' => 'zip_code',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address' => 
  array (
    'label' => 'Endereço',
    'name' => 'address',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'address_number' => 
  array (
    'label' => 'Número endereço',
    'name' => 'address_number',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'complement' => 
  array (
    'label' => 'Complemento',
    'name' => 'complement',
    'type' => 'text',
    'rules' => 'trim|max_length[255]',
  ),
  'neighborhood' => 
  array (
    'label' => 'Bairro',
    'name' => 'neighborhood',
    'type' => 'text',
    'rules' => 'trim|required|max_length[255]',
  ),
  'phone_number' => 
  array (
    'label' => 'Telefone',
    'name' => 'phone_number',
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