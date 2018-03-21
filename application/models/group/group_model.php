<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'group_finder.php';

/**
 * group
 * 
 * Model de group
 * 
 */
class Group_model extends Group_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'name' => 'name',
        'slug' => 'slug',
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
    public $visibles = [
        'ID',
        'Nome',
        'Slug',       
        'Ações',
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
        return 'group';
    }

    /**
     * putUser
     * 
     * coloca o usuário em um grupo
     *
     * @param [type] $user
     * @return void
     */
    public function putUser( $user ) {

        // carrega a model
        $this->load->model( 'user_group' );

        // cria a relação
        $assoc = $this->User_group->new();

        // seta os dados
        $assoc->user_id  = $user->id;
        $assoc->group_id = $this->id;

        // salva o grupo
        return $assoc->save();
    }

    /**
     * canUseComponent
     * 
     * Verifica se um grupo tem acesso á um componente
     *
     * @param [type] $component_id
     * @return void
     */
    public function canUseComponent( $component_id = null ) {

        // Verifica se foi informado um componente
        if ( !$component_id ) return false;

        // Carrega a model de permissao
        $this->load->model( 'permission' );

        // Verifica se existe
        if ( $this->Permission->byComponentGroup( $component_id, $this->id ) ) {
            return true;
        } else return false;
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
            [   'db' => 'id',   'dt' => 0 ],
            [   'db' => 'name', 'dt' => 1 ],
            [   'db' => 'slug', 'dt' => 2 ],  
            [   
                'db' => 'id',    
                'dt' => 3,
                'formatter' => function( $d, $row ) {

                    // Formata a data
                    $del  = ( $row['slug'] === 'admin' ) ? '' : rmButton( 'group/delete/'.$d );
                    $edit = ( $row['slug'] === 'admin' ) ? '<small>-- Não editavel --</small>' : editButton( 'group/list?addModal=true&id='.$d );

                    // Volta os botões
                    return $del.'&nbsp'.$edit;
                }
            ], [   
                'db' => 'id',    
                'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return '<label class="custom-control custom-checkbox">
                                <input value="'.$d.'" type="checkbox" name="ids[]" class="custom-control-input bulkCheckbox">
                                <span class="custom-control-indicator"></span>
                            </label>';
                }
            ]
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
        $url = $this->id ? 'group/save/'.$this->id : 'group/save';
        $data = [
            'url'    => $url,
            'fields' => [
                'name' => [
                    'label' => 'Nome',
                    'rules' => 'required|max_length[20]|min_length[2]|alpha',
                    'type'  => 'text',
                    'name'  => 'name'
                ],
                'slug' => [
                    'label' => 'Slug',
                    'rules' => 'required|max_length[20]|min_length[2]|alpha',
                    'type'  => 'text',
                    'name'  => 'slug'
                ]
            ]
        ];
        return $data[$key];
    }

    /**
     * permissions
     * 
     * Verifica as permissoes do usuário
     * 
     */
    public function permissions() {
        return [
            'read'       => [ 'admin' ],
            'delete'     => [ 'admin' ],
            'add'        => [ 'admin' ],
            'edit'       => [ 'admin' ]
        ];
    }

    /**
     * bulkActions
     * 
     * Ações em massa
     *
     * @return void
     */
    public function bulkActions() {
        return [
            'Excluir' => site_url( 'group/delete_mutiples' )
        ];
    }
}

/* end of file */