<?php defined('BASEPATH') or exit('No direct script access allowed');

use Philo\Blade\Blade;

class View {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * blade
     *
     * a instancia do blade
     * 
     * @var [type]
     */
    public $blade;

    /**
     * data
     * 
     * os dados que serão enviados a view
     * 
     * @var [type]
     */
    public $data;

    /**
     * titlePrefix
     * 
     * titulo da página
     *
     * @var string
     */
    public $titlePrefix;

    /**
     * __construct
     * 
     * método construtor
     * 
     */
    public function __construct() {
        $this->ci =& get_instance();

        // Seta o prefixo do titlo
        $this->titlePrefix = sitename().' - ';

        // inicializa a instancia do blade 
        $this->blade = new Blade( FCPATH.DIRECTORY_SEPARATOR.'frontend', APPPATH.'/cache/' );
    }

    /**
     * set
     * 
     * seta uma variavel
     *
     * @param string $key
     * @param [type] $data
     * @return void
     */
    public function set( string $key, $data ) {
        $this->data[$key] = $data;
        return $this;
    }

    /**
     * unset
     *
     * retira uma variavel
     * 
     * @param string $key
     * @return void
     */
    public function unset( string $key ) {
        if ( isset( $this->data[$key ] ) ) unset( $this->data[$key] );
        return $this;
    }

    /**
     * setTitle
     * 
     * seta o titulo
     *
     * @param string $title
     * @return void
     */
    public function setTitle( string $title ) {
        $this->data['title'] = $this->titlePrefix.$title;
    }

    /**
     * render
     * 
     * renderiza a view
     */
    public function render( $view, $data = [], $return = false ) {
        
        // verifica se o titulo foi setado
        $this->data['title'] = isset( $this->data['title'] ) ? $this->data['title'] : $this->titlePrefix;
        
        // seta o caminho da view
        $view = 'pages/'.$view;

        // seta o array
        $this->data = array_merge( $this->data, $data );

        // carrega view
        $blview = $this->blade->view()->make( $view, $this->data )->render();
        return ( !$return ) ? print( $blview ) : $blview;   
    }

    /**
     * html
     * 
     * volta o html do item solicitado
     *
     * @param [type] $view
     * @param array $data
     * @return void
     */
    public function html( $view, $data = [], $return = true ) {
          
        // verifica se o titulo foi setado
        $this->data['title'] = isset( $this->data['title'] ) ? $this->data['title'] : $this->titlePrefix;

        // seta o array
        $this->data = array_merge( $this->data, $data );

        // carrega view
        $blview = $this->blade->view()->make( $view, $this->data )->render();
        return ( !$return ) ? print( $blview ) : $blview;    
    }
};

/* end of file */