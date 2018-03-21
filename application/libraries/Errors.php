<?php defined('BASEPATH') or exit('No direct script access allowed');

class Errors {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * code
     * 
     * código do erro
     *
     * @var [type]
     */
    public $code;

    /**
     * message
     * 
     * mensagem de erro
     *
     * @var [type]
     */
    public $message;

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
     * set_error
     * 
     * seta o erro
     *
     * @param [type] $code
     * @param [type] $message
     * @return void
     */
    public function set_error( $code, $message ) {
        $this->code    = $code;
        $this->message = $message;
        return $this;
    }
};

/* end of file */