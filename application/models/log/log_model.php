<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'log_finder.php';

/**
 * log
 * 
 * Model de log
 * 
 */
class Log_model extends Log_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'text'       => 'text',
        'user_id'    => 'user_id',
        'action'     => 'action',
        'color'      => 'color',
        'json'       => 'json',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at'
    );

    /**
     * visibles
     * 
     * Campos visiveis no grid
     *
     * @var array
     */
    public $visibles = [
        'ID',
        'Ação',
        'Texto',
        'Data',
        'Ações'
    ];

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
        return 'log';
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
        $columns = [
            [   'db' => 'id',     'dt' => 0 ],
            [   'db' => 'action', 'dt' => 1 ],
            [   'db' => 'text',   'dt' => 2 ],
            [   'db' => 'created_at',   
                'dt' => 3,
                'formatter' => function( $d, $row ) {
                    return date( 'H:i:m d/m/Y', strtotime( $d ) );
                } 
            ],
            [   'db' => 'id',   
                'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return "<a href='".site_url( 'log/list/'.$d )."' class='btn btn-warning btn-sm' title='Visualizar'>
                                <i class='fa fa-eye'></i>
                            </a>";
                } 
            ],
        ];

        // Volta o resultado
        return $this->datatables->send( $this->table(), $columns );
    }
}

/* end of file */