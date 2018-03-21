<?php defined('BASEPATH') or exit('No direct script access allowed');

class DefaultSeed {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * seeders
     * 
     * indica onde estão os seeders
     * A ordem com que estão presentes no array
     * é a ordem com que serão executados
     *
     * @var array
     */
    public $seeders = [
        'userseed' => '../seeds/UserSeed'
    ];

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
     * populate
     * 
     * popula a seed
     * 
     */
    public function populate() {
        
        // percorre todas as seeds
        foreach( $this->seeders as $method => $seed ) {

            // carrega a library
            $this->ci->load->library( $seed );

            // executa o método
            $this->ci->$method->populate();
        }
    }
};

/* end of file */