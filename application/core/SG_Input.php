<?php defined('BASEPATH') or exit('No direct script access allowed');

class SG_Input extends CI_Input {

    /**
     * __construct
     * 
     * método construtor
     * 
     */
    public function __construct() {
        parent::__construct();
        
        // adiciona o json ao post
        $data = json_decode(file_get_contents('php://input'), true);
        if ( $data ) $_POST = $data; 
    }
};

/* end of file */