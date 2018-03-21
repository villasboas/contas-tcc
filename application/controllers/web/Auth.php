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
				'rules' => 'matches[confirm]|min_length[6]|max_length[16]|required'
			], [
				'field' => 'confirm',				
				'label' => 'Confirmar',
				'rules' => 'min_length[6]|max_length[16]|required'
			]
		];

		// valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
	}

	/**
	 * __validChangePasswordForm
	 * 
	 * valida um formulário
	 *
	 * @return void
	 */
	private function __validChangePasswordForm() {
		$rules = [
			[
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'valid_email|required'
			], [
				'field' => 'password',
				'label' => 'Senha',
				'rules' => 'matches[confirm]|min_length[6]|max_length[16]|required'
			], [
				'field' => 'confirm',				
				'label' => 'Confirmar',
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
			$this->User->login( $email, $senha );

			// Verifica se o usuário está nos grupos de login
			if ( inGroup( [ 'admin' ] ) ) {
				auth()->resetAttempts();
				close_page( 'home' );
				return true;
			} else $this->logout();

		} catch( Error $e ) {

			// Pega a mensagem
			$message = $e->getMessage();

			// verifica se esta ativo as tentativas
			if ( $this->attempts_limit && $user ) {
				$rest = $this->attempts_limit - $user->login_attempts;
				if ( $rest <= 3 ) {
					$message .= '<br>';
					$message .= 'Você ainda tem <b>'.$rest.'</b> tentativas.'; 
					$message .= 'Depois disso, sua conta será bloqueado por 30 minutos.';
				}
			}

			// seta a mensagem de erro
			setItem( 'errorTitle', 'Erro ao logar' );
			setItem( 'errorBody',  $message );
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
				$this->view->set( 'errors', $message );
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
	public function index() {
		unloggedOnly();

		// Seta o titulo
		setTitle( 'Login' );

		// cria um novo usuário
		$user = $this->User->new();
		$user->fill( $this->input->post(NULL, TRUE) ) ;
		setItem( 'user', $user );

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
				} else {
					if ( $this->attempts_limit ) $user->resetAttempts();
					return;
				}
			}

		} else {

			// seta o usuário
			setItem( 'errors', validation_errors() );
		}

		// renderiza 
		view( 'auth/login' );
	}

	/**
	 * signup
	 * 
	 * abre o formulário de cadastro
	 *
	 * @return void
	 */
	public function signup() {
		unloggedOnly();

		// Seta o titulo
		setTitle( 'Signup' );

		// cria um novo usuário
		$user = $this->User->new();
		$user->fill( $this->input->post(NULL, TRUE) ) ;
		setItem( 'user', $user );

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
			if ( $this->__login( $user->email, $senha ) ) return;

		} else {

			// seta o usuário
			setItem( 'errorTitle', 'Erro ao criar conta' );
			setItem( 'errorBody', validation_errors() );
		}

		// carrega a view
		view( 'auth/signup' );
	}

	/**
	 * forgot_password
	 * 
	 * abre o formulário de esqueci minha senha
	 *
	 * @return void
	 */
	public function forgot_password() {
		unloggedOnly();

		// Seta o titulo
		setTitle( 'Equeci minha senha' );
		
		// seta o usuário padrão
		$user = $this->User->new();
		setItem( 'user', $user );

		// pega o email
		$email = $this->input->post( 'email' );

		// verifica se é um email válido
		if ( valid_email( $email ) ) {

			// pega o usuário
			$user = $this->User->email( $email );

			// se não existir o usuário
			if ( !$user ) {
				setItem( 'errorTitle', 'Erro ao recuperar a senha' );
				setItem( 'errorBody', 'E-mail não cadastrado' );
			} else {

				// seta o token
				$user->setForgotPasswordToken()->save();

				// envia o e-mail
				$this->load->library( 'email' );
				$this->email->to( $user->email, $user->name );
				$this->email->parse( 'RECOVERY_EMAIL', [ '%_TOKEN_%' => $user->forgot_password_token, '%_USER_%' => $user->name ] );
				$this->email->subject( 'Recuperação de senha '.sitename() );

				// seta a mensagem de sucesso
				if ( $this->email->send() ) {
					setItem( 'successTitle', 'Sucesso ao recuperar a senha' );
					setItem( 'successBody', "E-mail enviado com sucesso para <b>$user->email</b>" );
				} else {	
					setItem( 'errorTitle', 'Erro ao recuperar a senha' );
					setItem( 'errorBody', 'Erro ao enviar o e-mail' );
				}
			}
		}
		
		// renderiza a view
		view( 'auth/forgot_password' );
	}

	/**
	 * change_password
	 * 
	 * altera a senha de um usuário
	 *
	 * @param boolean $token
	 * @return void
	 */
	public function change_password( $token = false ) {
		unloggedOnly();

		// Seta o titulo
		$this->view->setTitle( 'Mudar senha' );
		if ( !$token ) return close_page();

		// obtem o usuario
		$user = $this->User->byPasswordToken( $token );
		if ( !$user ) return close_page();

		// seta os dados da view
		setItem( 'user', $user );
		setItem( 'token', $token );

		// valida o formulário
		if ( $this->__validChangePasswordForm() ) {

			// pega o email enviado
			$email = $this->input->post( 'email' );

			// verifica se os emails são iguais
			if ( $email === $user->email ) {

				// pega a senha
				$senha = $this->input->post( 'password' );

				// seta a senha
				$user->setPassword( $senha );
				$user->forgot_password_token = null;

				// salva o usuário
				if ( $user->save() ) {

					// Faz o login
					if ( $this->__login( $user->email, $senha ) ) return;
				} else {

					// Seta as mensagens de erro
					setItem( 'errorTitle', 'Erro ao alterar a senha' );				
					setItem( 'errorBody', 'Houve um erro ao tentar alterar essa senha' );
				}
			} else {

				// Seta as mensagens de erro
				setItem( 'errorTitle', 'Erro ao alterar a senha' );
				setItem( 'errorBody', 'O e-mail digitado está incorreto' );
			}
		} else {

			// Seta as mensagens de erro
			setItem( 'errorTitle', 'Erro ao alterar a senha' );
			setItem( 'errorBody', validation_errors() );
		}

		// renderiza a pagina
		$this->view->render( 'auth/change_password' );
	}

	/**
	 * logout
	 * 
	 * faz o logout
	 *
	 * @return void
	 */
	public function logout() {
		loggedOnly();
		$this->sg_auth->logout();
		close_page( 'auth' );
	}
}

// End of file
