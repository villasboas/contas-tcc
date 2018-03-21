<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User
 * 
 * Controller de crud para User
 * 
 */
class User extends SG_Controller {

	/**
	 * model
	 * 
	 * model sendo usada no crud
	 *
	 * @var [type]
	 */
	public $model;

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// Seta o contexto
		context( 'sistema' );
		sidebar( 'Usuários' );

		// carrega a model
		$this->load->model( 'user' );
		$this->model = $this->User;
	}

	/**
	 * __validate
	 * 
	 * valida um formulário
	 *
	 * @return void
	 */
	public function __validate() {
		$rules = [];

		// valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
	}

	/**
	 * datatables
	 * 
	 * Volta a tabela
	 *
	 * @return void
	 */
	public function datatables() {

		// Chama o método da datatables
		echo $this->model->DataTables();
	}

	/**
	 * list
	 * 
	 * lista os dados
	 *
	 * @return void
	 */
	public function list( $id = false ) {
		setTitle( 'Usuários' );
		$this->protectIt( 'read' );
		
		// Seta a model do grid
		setItem( 'url', 'user/datatables' );
		setItem( 'modelGrid', $this->model );

		// Verifica se existe um id
		if ( $id ) {

			// Carrega o usuario
			if ( $user = $this->model->findById( $id ) ) {

				// Carrega a model de grupos
				$this->load->model( 'group' );
				setItem( 'groups', $this->Group->find() );

				// Seta o usuário
				setItem( 'user', $user );

				// Pega os grupos do usuário
				$userGroups = array_map( function( $value ) {
					return $value->id;
				}, groups( $user->id ) );
				setItem( 'userGroups', $userGroups );
			}
		}

		// Carrega o grid
		view( 'auth/group-modal' );
	}

	/**
	 * delete
	 * 
	 * deleta um dado
	 *
	 * @param boolean $id
	 * @return void
	 */
	public function delete( $id = false ) {

		// carrega a entidade
		$item = $this->model->findById( $id );
		if ( !$item ) close_page( 'home' );

		// Remove o componente
		if ( $item->delete() ) {
			
			// Seta a mensagem
			flash( 'swaSuccessBody', 'Usuário excluido com sucesso' );
		} else {
			
			// Seta a mensagem
			flash( 'swaErrorBody', 'Não foi possivel excluir o usuário' );
		}

		// carrega a view
		close_page( 'user/list' );
	}

	/**
	 * save_group
	 * 
	 * Salva os grupos de um usuário
	 *
	 * @return void
	 */
	public function save_group( $id = false ) {

		// Carrega as models
		$this->load->model( [ 'group', 'user_group' ] );

		// Carrega o usuário
		$user = $this->model->findById( $id );
		if ( !$user ) return close_page( 'user/list' );

		// Verifica se pelo menos um grupo foi enviado
		$groupsPost = $this->input->post( 'groups' );
		if ( count( $groupsPost ) == 0 ) {

			// Seta a mensagem
			flash( 'swaErrorBody', 'Pelo menos um grupo deve ser informado' );
			return close_page( 'user/list/'.$id );
		}

		// Obtem todos os registros de grupos do usuários
		$actualGroups = $this->User_group->getByUser( $user );
		$actualGroupsIds = array_map( function( $value ) {
			return $value->group_id;
		}, $actualGroups );

		// Percorre os grupos atuais e remove se não tiver sido selecionado
		foreach( $actualGroupsIds as $index => $groupId ) {
			$key = array_search( $groupId, $groupsPost );

			// Verifica se existe o item
			if ( $key !== FALSE ) {
				
				// Remove dos grupos a serem salvos
				unset( $groupsPost[$key] );
			} else $actualGroups[$index]->delete();
		}

		// Percorre os grupos que deve ser salvos
		foreach( $groupsPost as $groupId ) {
			$item = $this->User_group->new();
			$item->fill([
				'user_id'  => $user->id,
				'group_id' => $groupId
			])->save();
		}

		// Finaliz com a mensagem de sucesso
		flash( 'swaSuccessBody', 'Usuário alocado com sucesso' );
		close_page( 'user/list' );
	}
}

// End of file
