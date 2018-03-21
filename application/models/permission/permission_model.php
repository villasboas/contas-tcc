<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'permission_finder.php';

/**
 * permission
 * 
 * Model de permission
 * 
 */
class Permission_model extends Permission_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'component_id' => 'component_id',
        'group_id' => 'group_id',
        'read' => 'read',
        'update' => 'update',
        'create' => 'create',
        'delete' => 'delete',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
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
        return 'permission';
    }
}

/* end of file */