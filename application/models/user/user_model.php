<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'user_finder.php';

/**
 * user
 * 
 * Model de user
 * 
 */
class User_model extends User_finder {

    /**
     * fields
     *
     * campos do model
     * 
     * @var array
     */
    public $fields = array (
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'token_api' => 'token_api',
        'token_session' => 'token_session',
        'forgot_password_token' => 'forgot_password_token',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'logged_at' => 'logged_at',
        'login_attempts' => 'login_attempts',
        'attempt_interval' => 'attempt_interval',
        'last_attempt' => 'last_attempt',
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
        'E-mail',
        'Grupos',        
        'Ações'
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
     * hashPassword
     * 
     * encrypta o passwors
     *
     * @param [type] $params
     * @return boolean
     */
    public function hashPassword( $params ) {
        $this->password = password_hash( $this->password, PASSWORD_BCRYPT );
    }

    /**
     * hooks
     * 
     * define os hooks da model user
     *
     * @return void
     */
    public function hooks() {
        return [
            'beforeInsert' => 'hashPassword'
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
        return 'user';
    }

    /**
     * setPassword
     * 
     * seta uma nova senha
     *
     * @param [type] $password
     * @return void
     */
    public function setPassword( $password ) {
        $this->password = password_hash( $password, PASSWORD_BCRYPT );
    }

    /**
     * setForgotPasswordToken
     * 
     * seta o token de recuperação de senha
     *
     * @return void
     */
    public function setForgotPasswordToken() {
        $this->forgot_password_token = md5( uniqid( rand() * time() ) );
        return $this;
    }

    /**
     * incrementLoginAttemp
     * 
     * incrementa a tentativa de login
     *
     * @return void
     */
    public function incrementLoginAttempt() {
        
        // seta as tentativas
        $this->login_attempts++;
        $this->last_attempt = now();

        // salva o usuario
        $this->save();
    }

    /**
     * resetAttempts
     * 
     * reseta as tentativas de login
     *
     * @return void
     */
    public function resetAttempts() {

        // seta as tentativas
        $this->login_attempts   = 0;
        $this->last_attempt     = null;
        $this->attempt_interval = null;

        // salva as alteraçoes
        $this->save();
    }

    /**
     * authData
     * 
     * volta os dados de autenticação visiveis na api
     *
     * @return void
     */
    public function authData() {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'token_api'  => $this->token_api,
            'logged_at'  => $this->logged_at,
        ];
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
            [   'db' => 'id',    'dt' => 0 ],
            [   'db' => 'name',  'dt' => 1 ],
            [   'db' => 'email', 'dt' => 2 ],
            [   'db' => 'id',    
                'dt' => 3,
                'formatter' => function( $d, $row ) {

                    // Carrega a model
                    $groups = groups( $d );

                    // Percorre os grupos
                    $tpl = '';
                    foreach( $groups as $group ) {
                        $tpl .= " <span class='badge badge-success'>$group->slug</span> ";
                    }
                    return $tpl;
                }
            ],  [   
                'db' => 'id',    
                'dt' => 4,
                'formatter' => function( $d, $row ) {

                    // Verifica se não é admin
                    if ( !admin() ) return '<small>-- Nenhuma ação --</small>';

                    // Formata os botoes
                    $del  = rmButton( 'user/delete/'.$d );
                    $group = "<a href='".site_url( 'user/list/'.$d )."' class='btn btn-sm text-light btn-warning' title='Grupos de acesso'>
                                    <i class='fa fa-users'></i>
                              </a>";

                    // Volta os botões
                    return $del.'&nbsp'.$group;
                }
            ]
        ];

        // Volta o resultado
        return $this->datatables->send( $this->table(), $columns );
    }

    /**
     * permissions
     * 
     * Verifica as permissoes do usuário
     * 
     */
    public function permissions() {
        return [
            'read'       => [ 'logged' ],
            'delete'     => [ 'admin' ],
            'add'        => [ 'any' ],
            'edit'       => [ 'logged' ],
            'putOnGroup' => [ 'admin' ]
        ];
    }
}

// End of file