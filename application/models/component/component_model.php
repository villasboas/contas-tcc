<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'component_finder.php';

/**
 * component
 * 
 * Model de component
 * 
 */
class Component_model extends Component_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'component_id' => 'component_id',
        'slug'         => 'slug',
        'text'         => 'text',
        'link'         => 'link',
        'icon'         => 'icon',
        'context'      => 'context',
        'position'     => 'position',
        'created_at'   => 'created_at',
        'updated_at'   => 'updated_at'
    );

    /**
     * opts
     * 
     * Opções dos campos
     *
     * @var array
     */
    public $opts = [
        'slug' => [
            'navbar'  => 'Navbar',
            'sidebar' => 'Sidebar'
        ]
    ];

    /**
     * visibles
     * 
     * Campos para o Header
     *
     * @var array
     */
    public $visibles = [
        'ID',
        'Slug',
        'Texto',
        'Icone',
        'Criado',
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
        return 'component';
    }

    /**
     * main
     * 
     * Pega o campo principal
     *
     * @return void
     */
    public function main() {
        return $this->text;
    }

    /**
     * columns
     * 
     * Colunas para o DataTables
     *
     * @return void
     */
    public function DataTables() {

        // Columns
        $columns = [
            [   'db' => 'id',   'dt' => 0 ],
            [   'db' => 'slug', 'dt' => 1 ],
            [   'db' => 'text', 'dt' => 2 ],
            [   'db' => 'icon', 
                'dt' => 3,
                'formatter' => function( $d, $row ) {

                    // Verifica se existe um item
                    if ( $d ) return "<i class='fa fa-$d'></i>";

                    // Volta por padrão
                    return '<small>nenhum icone</small>';
                }
            ],
            [   'db' => 'created_at',     
                'dt' => 4,
                'formatter' => function( $d, $row ) {

                    // Formata a data
                   return  date( 'H:i:s d-m-Y', strtotime( $d ) );
                }
            ],
            [   'db' => 'id',     
                'dt' => 5,
                'formatter' => function( $d, $row ) {

                    // Formata a data
                    $edit = editButton();
                    $del  = rmButton();

                    // Volta os botões
                    return $edit.'&nbsp'.$del;
                }
            ]
        ];

        // Volta o resultado
        return $this->datatables->send( $this->table(), $columns );
    }

    /**
     * permissions
     * 
     * Verifica as permissoes do usuário
     * 
     */
    public function permissions() {
        return [
            'read'       => [ 'any' ],
            'delete'     => [ 'admin' ],
            'add'        => [ 'admin' ],
            'edit'       => [ 'admin' ]
        ];
    }
}

// End of file