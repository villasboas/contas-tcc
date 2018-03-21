<?php defined('BASEPATH') or exit('No direct script access allowed');

require( 'DataTables/ssp.class.php' );

class DataTables {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * __construct
     * 
     * método construtor
     * 
     */
    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * send
     * 
     * Envia os dados DataTable
     *
     * @param [type] $table
     * @param [type] $columns
     * @return void
     */
    public function send( $table, $columns ) {

        // SQL server connection information
        $sql_details = array(
            'user' => $this->ci->db->username,
            'pass' => $this->ci->db->password,
            'db'   => $this->ci->db->database,
            'host' => $this->ci->db->hostname,
        );

        // Chama o método do DataTables
        $json = SSP::simple( $_GET, $sql_details, $table, 'id', $columns );

        // Volta os dados
        return safe_json_encode( $json );
    }
};

// End of file