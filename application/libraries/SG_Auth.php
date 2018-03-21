<?php defined('BASEPATH') or exit('No direct script access allowed');

class SG_Auth {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * user
     * 
     * usuario logado
     *
     * @var [type]
     */
    public $user = null;

    /**
     * __construct
     * 
     * método construtor
     * 
     */
    public function __construct() {
        $this->ci =& get_instance();

        // carrega a model
        $this->ci->load->model( 'user' );
    }

    /**
     * generate_random_token
     * 
     * gera um token aleátorio
     *
     * @return void
     */
    public function generate_random_token() {
        return md5( uniqid( rand() * time() ) );
    }

    /**
     * set_session
     * 
     * seta a sessao
     *
     * @param [type] $user
     * @return void
     */
    public function set_session( $user ) {
        
        // seta os dados na sessão
        $this->ci->session->set_userdata( 'auth-id',    $user->id );
        $this->ci->session->set_userdata( 'auth-email', $user->email );
        $this->ci->session->set_userdata( 'auth-token', $user->token_session );
    }

    /**
     * user
     * 
     * pega o usuário logado
     *
     * @return void
     */
    public function user() {

        // pega os itens da sessao
        $id    = $this->ci->session->userdata( 'auth-id' );
        $email = $this->ci->session->userdata( 'auth-email' );
        $token = $this->ci->session->userdata( 'auth-token' );

        // verifica se os itens não estão no header
        $id    = $id    ? $id    : get_header( 'auth_id' );
        $email = $email ? $email : get_header( 'auth_email' );
        $token = $token ? $token : get_header( 'auth_token' );

        // verifica se os dados existem
        if ( !$id || !$email || !$token ) return null;

        // carrega o usuario
        if ( !$this->user ){
            $user = $this->ci->User->findById( $id );
            $this->user = $user;
        } else {
            $user = $this->user;
        }
        

        // verifica se o email esta certo
        if ( $email != $user->email ) return null;

        // verifica o token
        if ( $token != $user->token_session && $token != $user->token_api ) return null;

        // volta o usuario
        return $user;
    }

    /**
     * login
     * 
     * faz login
     *
     * @param [type] $user
     * @return void
     */
    public function login( $user ) {

        // seta os tokens
        $user->token_session = $this->generate_random_token();
        $user->logged_at     = now();

        // salva o token
        $user->save();
        $this->set_session( $user );
    }

    /**
     * api_login
     * 
     * faz login pela api
     *
     * @param [type] $user
     * @return void
     */
    public function api_login( $user ) {

        // seta os tokens
        $user->token_api = $this->generate_random_token();
        $user->logged_at = now();

        // salva o token
        $user->save();
    }

    /**
     * logout
     * 
     * faz o logout
     *
     * @return void
     */
    public function logout() {
        $this->ci->session->sess_destroy();
    }
};

/* end of file */