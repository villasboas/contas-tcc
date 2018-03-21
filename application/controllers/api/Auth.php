<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth
 * 
 * Controller básico para autenticação
 * 
 */
class Auth extends SG_Controller {

	/**
	 * attempts_limit
	 * 
	 * limit de tentativa de login
	 *
	 * @var integer
	 */
	public $attempts_limit = 5;

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// carrega a model de usuários
		$this->load->model( 'user' );
	}
	
	/**
	 * __validSignupForm
	 * 
	 * valida um formulário
	 *
	 * @return void
	 */
	private function __validSignupForm() {
		$rules = [
			[
				'field' => 'name',
				'label' => 'Nome',
				'rules' => 'min_length[2]|max_length[40]|required'
			], [
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'valid_email|is_unique[user.email]|required'
			], [
				'field' => 'password',
				'label' => 'Senha',
				'rules' => 'min_length[6]|max_length[16]|required'
			]
		];

		// valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
	}

	/**
	 * __validLoginForm
	 * 
	 * valida um formulário
	 *
	 * @return void
	 */
	private function __validLoginForm() {
		$rules = [
			[
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'valid_email|required'
			], [
				'field' => 'password',
				'label' => 'Senha',
				'rules' => 'min_length[6]|max_length[16]|required'
			]
		];

		// valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
	}

	/**
	 * __login
	 * 
	 * faz o login
	 *
	 * @param [type] $email
	 * @param [type] $senha
	 * @return void
	 */
	private function __login( $email, $senha ) {

		// carrega o usuario
		$user = $this->User->email( $email );

		try {

			// Tenta fazer o login
			$this->User->login( $email, $senha, true );

			// Reseta as tentativas de login
			$this->User->apiUser->resetAttempts();

			// Volta os dados de autenticação
			resolve( $this->User->apiUser->authData() );

			// Volta true
			return true;
		} catch( Error $e ) {

			// Pega a mensagem
			$message = $e->getMessage();

			// Verifica se esta ativo as tentativas
			if ( $this->attempts_limit && $user ) {
				$rest = $this->attempts_limit - $user->login_attempts;
				if ( $rest <= 3 ) {
					$message .= '<br>';
					$message .= 'Você ainda tem <b>'.$rest.'</b> tentativas.'; 
					$message .= 'Depois disso, sua conta será bloqueado por 30 minutos.';
				}
			}

			// seta a mensagem de erro
			reject(  $message );
			return false;
		}
	}

	/**
	 * __checkAttempts
	 *
	 * @param [type] $user
	 * @return void
	 */
	private function __checkAttempts( $user ) {

		// verifica se a função esta habilitada
		if ( !$this->attempts_limit ) return true;

		// verifica se existe um usuário
		if ( !$user ) return true;

		// verifica se o usuário nao esta bloqueado temporariamente
		if ( $user->attempt_interval ) {
	
			// verifica se já pode fazer login
			$start = strtotime( $user->last_attempt );
			$end   = time();

			// transforma a diferença em minutos
			$diff = ( $end - $start ) / 60;

			// verifica se já passou tempo o suficiente
			if ( $diff >= $user->attempt_interval ) {

				// reseta os dados
				$user->resetAttempts();
				return true;

			} else {

				// seta os minutos restantes
				$rest = $user->attempt_interval - $diff;
				$rest = ceil( $rest );

				// seta a mensagem de erro
				$message  = 'Essa conta encontra-se temporariamente suspensa por ter ';
				$message .= 'excedido o limite máximo de tentativas de login.';
				$message .= '<br> Você poderá tentar novamente em <b>'.$rest.'</b> minutos';
				reject( $message );
				return false;
			}
		} else return true;
	}

	/**
	 * index
	 * 
	 * abre o formulário de login
	 *
	 * @return void
	 */
	public function login() {

		// cria um novo usuário
		$user = $this->User->new();
		$user->fill( $this->input->post(NULL, TRUE) ) ;
		$this->view->set( 'user', $user );

		// valida o formulário
		if ( $this->__validLoginForm() ) {
			
			// pega os dados
			$email = $this->input->post( 'email' );
			$senha = $this->input->post( 'password' );
			
			// carrega o usuario
			$user = $this->User->email( $email );

			// verifica se pode tentar logar
			if ( $this->__checkAttempts( $user ) ) {

				// faz o login
				if ( !$this->__login( $email, $senha ) ) {
					
					// verifica se existe um usuário
					if ( $user && $this->attempts_limit ) {
						$user->incrementLoginAttempt();
						if ( $user->login_attempts >= $this->attempts_limit ) {
							$user->attempt_interval = 30;
							$user->save();
						}
					}
					return;

				} else {
					if ( $this->attempts_limit ) $user->resetAttempts();
					return;
				}
			}

		} else {

			// seta o usuário
			return reject( validation_errors() );
		}

		// renderiza 
		return reject( 'Erro ao logar' );
	}

	/**
	 * signup
	 * 
	 * abre o formulário de cadastro
	 *
	 * @return void
	 */
	public function signup() {

		// cria um novo usuário
		$user = $this->User->new();
		$user->fill( $this->input->post(NULL, TRUE) );

		// valida o formulário
		if ( $this->__validSignupForm() ) {
			
			// carrega o grupo padrao
			$this->load->model( 'group' );
			$group = $this->Group->defaultGroup();

			// pega a senha
			$senha = $user->password;

			// salva o usuario
			$user->save();

			// salva o grupo
			$group->putUser( $user );

			// faz o login
			return resolve( $user->authData() );

		} else {

			// seta o usuário
			return reject( validation_errors() );
		}

		return reject( 'Erro ao carregar o endpoint' );
	}

	/**
	 * forgot_password
	 * 
	 * abre o formulário de esqueci minha senha
	 *
	 * @return void
	 */
	public function forgot_password() {

		// pega o email
		$email = $this->input->post( 'email' );

		// verifica se é um email válido
		if ( valid_email( $email ) ) {

			// pega o usuário
			$user = $this->User->email( $email );

			// se não existir o usuário
			if ( !$user ) {
				return reject( 'E-mail não cadastrado' );
			} else {

				// seta o token
				$user->setForgotPasswordToken()->save();

				// envia o e-mail
				$this->load->library( 'email' );
				$this->email->from( 'postmaster@sandbox1fe1cc36a08141f28e9102e42b635f3a.mailgun.org', $this->config->item( 'site_name' ) );
				$this->email->to( $user->email, $user->name );
				$this->email->render( 'recovery', [ 'token' => $user->forgot_password_token, 'user_name' => $user->name ] );
				$this->email->subject( 'Recuperação de senha '.$this->config->item( 'site_name' ) );

				// seta a mensagem de sucesso
				if ( $this->email->send() ) {
					return resolve( "E-mail enviado com sucesso para <b>$user->email</b>" );
				} else {
					return reject( 'Erro ao enviar o e-mail' );
				}
			}
		} else return reject( 'E-mail incorreto' );
		
		// renderiza a view
		return reject( 'Erro ao carregar o endpoint' );
	}
}

// End of file
