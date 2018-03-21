<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'midia_finder.php';

/**
 * midia
 * 
 * Model de midia
 * 
 */
class Midia_model extends Midia_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
      'name' => 'name',
      'hash' => 'hash',
      'type' => 'type',
      'size' => 'size',
      'ext' => 'ext',
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
      1 => 'name',
      2 => 'hash',
      3 => 'type',
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
     * metadata
     * 
     * Seta os metadados
     *
     * @return void
     */
    public function metadata() {
      return [
        'id'         => $this->id,
        'name'       => $this->name,
        'hash'       => $this->hash,
        'type'       => $this->type,
        'size'       => $this->size,
        'ext'        => $this->ext,
        'path'       => $this->path(),
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
      ];
    }

    /**
     * path
     * 
     * Volta o Path completo da imagem
     *
     * @return void
     */
    public function path() {
      if ( file_exists( 'public/uploads/'.$this->hash.'.'.$this->ext  ) ) {
        return base_url( 'public/uploads/'.$this->hash.'.'.$this->ext );
      } else {
        return base_url( 'public/images/empty.jpg' );
      }
    }

    /**
     * removeFile
     *
     * @param [type] $id
     * @return void
     */
    public function removeFile( $id ) {
      if ( file_exists( 'public/uploads/'.$this->hash.'.'.$this->ext  ) ) {
        return unlink( 'public/uploads/'.$this->hash.'.'.$this->ext );
      }
    }

    /**
     * hooks
     *
     * @return void
     */
    public function hooks() {
      return [
        'afterDelete' => 'removeFile'
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
        return 'midia';
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
            'db' => 'name',
            'dt' => 1,
          ),
          2 => 
          array (
            'db' => 'hash',
            'dt' => 2,
          ),
          3 => 
          array (
            'db' => 'type',
            'dt' => 3,
          ),
        );
        $columns[] = 
        [   
            'db' => 'id',
            'dt' => 4,  
            'formatter' => function( $d, $row ) {

                // Formata a data
                $del  = rmButton( 'midia/delete/'.$d );
                $edit = editButton( 'midia/list?addModal=true&id='.$d );

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
        $url = $this->id ? 'midia/save/'.$this->id : 'midia/save';
        $data = [
            'url'    => $url,
            'fields' => array (
              'name' => 
              array (
                'label' => 'name',
                'name' => 'name',
                'type' => 'text',
                'rules' => 'trim|required|max_length[255]',
              ),
              'hash' => 
              array (
                'label' => 'hash',
                'name' => 'hash',
                'type' => 'text',
                'rules' => 'trim|required|max_length[31]',
              ),
              'type' => 
              array (
                'label' => 'type',
                'name' => 'type',
                'type' => 'text',
                'rules' => 'trim|max_length[10]',
              ),
              'size' => 
              array (
                'label' => 'size',
                'name' => 'size',
                'type' => 'number',
                'rules' => 'trim|max_length[255]|integer',
              ),
              'ext' => 
              array (
                'label' => 'ext',
                'name' => 'ext',
                'type' => 'text',
                'rules' => 'trim|max_length[4]',
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