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
      1 => 'Cliente',
      2 => 'Nota fiscal',
      3 => 'CNPJ',
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
     * Cria as parcelas quando uma nova duplicata é criada
     *
     * @return void
     */
    function createTranches( $params ) {

      // Carrega a model de parcelas
      $this->load->model('tranche');

      // Verifica quantas parcelas serão cridas
      for( $i = 1; $i <= $this->tranche_number; $i++ ) {

        // O tempo da primeira parcela
        $timeFirstDue = strtotime( $this->expiration_date_first_tranche );

        // Vencimento da parcela atual
        $due = date( 'Y-m-d H:i:s', strtotime( '+'.($i-1).' months', $timeFirstDue ) );

        // Seta os dados da parcela
        $trancheData = [
          'bill_id'         => $this->id,
          'value'           => $this->value_total / $this->tranche_number,
          'expiration_date' => $due,
          'status'          => 'A',
          'interest_rate'   => $i
        ];

        // Cria a parcela
        $parcela = $this->Tranche->new();
        $parcela->fill( $trancheData );

        // Salva a parcela
        $parcela->save();
      }
    }

    /**
     * Remove as parcelas
     *
     * @return void
     */
    function removeTranches() {

    }

    /**
     * Atualiza as parcelas
     *
     * @return void
     */
    function updateTranches() {

    }

    /**
     * Hooks das parcelas
     *
     * @return void
     */
    function hooks() {
      return [
        'afterInsert' => 'createTranches',
        'afterDelete' => 'removeTranches',
        'afterUpdate' => 'updateTranches'
      ];
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
              'label' => 'Cliente',
              'model' => [ 'name' => 'client' , 'call' => 'Client' ],
              'name' => 'client_id',
              'attModel' => 'social_name',
              'type' => 'select',
              'rules' => 'trim|required|max_length[11]|integer',
            ),
            'bill_of_sale_id' => 
            array (
              'label' => 'Nota Fiscal',
              'model' => [ 'name' => 'bill_of_sale' , 'call' => 'Bill_of_sale' ],
              'name' => 'bill_of_sale_id',
              'attModel' => 'number',
              'type' => 'select',
              'rules' => 'trim|required|max_length[11]|integer',
            ),
            'cnpj' => 
            array (
              'label' => 'CNPJ',
              'name' => 'cnpj',
              'type' => 'text',
              'rules' => 'trim|required|max_length[255]',
            ),
            'portador' => 
            array (
              'label' => 'Portador (Banco)',
              'model' => [ 'name' => 'bank' , 'call' => 'Bank' ],
              'name' => 'portador',
              'attModel' => 'name',
              'type' => 'select',
              'rules' => 'trim|required|max_length[255]',
            ),
            'description' => 
            array (
              'label' => 'Descrição',
              'name' => 'description',
              'type' => 'text',
              'rules' => 'trim|required|max_length[255]',
            ),
            'value_total' => 
            array (
              'label' => 'Valor total',
              'name' => 'value_total',
              'type' => 'number',
              'rules' => 'trim|required|max_length[255]',
            ),
            'tranche_number' => 
            array (
              'label' => 'Numero da parcela',
              'name' => 'tranche_number',
              'type' => 'number',
              'rules' => 'trim|required|max_length[255]',
            ),
            'expiration_date_first_tranche' => 
            array (
              'label' => 'Vencimento primeira parcela',
              'name' => 'expiration_date_first_tranche',
              'type' => 'date',
              'rules' => 'trim|required',
            ),
            'status' => 
            array (
              'label'  => 'Status',
              'name'   => 'status',
              'opcoes' => [ 
                  [ 'label' => 'Pago', 'value' => 'P' ],
                  [ 'label' => 'Aberto', 'value' => 'A' ],
                  [ 'label' => 'Cancelado', 'value' => 'C' ],
                ],
              'type'   => 'select',
              'rules'  => 'trim|required|max_length[1]',
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