<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'user_group_finder.php';

/**
 * user_group
 * 
 * Model de user_group
 * 
 */
class User_group_model extends User_group_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'user_id' => 'user_id',
        'group_id' => 'group_id',
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
        return 'user_group';
    }
}

/* end of file */