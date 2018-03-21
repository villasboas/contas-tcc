<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Edit_mode
 * 
 * Controller de crud para Edit_mode
 * 
 */
class  Edit_mode extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// Verifica se é um administrador
		if ( !admin() ) close_page( 'home' );		

		// Carrega a model de componente
		$this->load->model( 'component' );
	}

	/**
	 * reposition
	 * 
	 * Reposiciona os outros itens
	 *
	 * @return void
	 */
	private function __reposition() {
		
		// Carrega os componentes depois deste
		$rePosition = $this->Component->after( $this->input->post( 'slug' ), $this->input->post( 'position' ) );
		if ( is_array( $rePosition ) ) {
			foreach( $rePosition as $item ) {
				$item->position++;
				$item->save();
			}
		}
	}

	/**
	 * delete
	 * 
	 * Exclui um componente
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function delete( $id ) {

		// Carrega o componente
		$component = $this->Component->findById( $id );
		if ( !$component ) return close_page( $this->input->get( 'redirect' ) );
	
		// Remove o componente
		if ( $component->delete() ) {

			// Seta a mensagem
			flash( 'swaSuccessBody', 'Item excluido com sucesso' );
		} else {
			
			// Seta a mensagem
			flash( 'swaErrorBody', 'Não foi possivel excluir o componente' );
		}

		// Redireciona a página
		close_page( $this->input->get( 'redirect' ) );
	}
	
	/**
	 * __setAccessGroups
	 * 
	 * Seta os grupos de acesso
	 *
	 * @param [type] $component
	 * @return void
	 */
	private function __setAccessGroups( $component ) {

		// Carrega as models
		$this->load->model( [ 'group', 'permission' ] );

		// Pega os grupos
		$groups = $this->input->post( 'groups' );
		if ( !$groups ) return;

		// Pega o grupo de admin
		$admin       = $this->Group->slug( 'admin' );
		$groups[]    = $admin->id;
		$groupsToAdd = $groups;

		// Carrega as permissões
		$permissions      = $this->Permission->byComponent( $component->id );
		$permissions	  = $permissions ? $permissions : [];
		$permissionGroups = array_map( function( $value ) {
			return $value->group_id;
		}, $permissions );

		// Percorre os grupos
		foreach( $groupsToAdd as $index => $groupId ) {

			// Verifica se já existe a permissão para esse grupo
			if ( in_array( $groupId, $permissionGroups ) ) unset( $groupsToAdd[$index] );
		}

		// Percorre as permissoes
		foreach( $permissions as $index => $permission ) {

			// Verifica se não esta no grupo
			if ( !in_array( $permission->group_id, $groups ) ) $permissions[$index]->delete();
		}

		// Salva as novas permissoes
		foreach( $groupsToAdd as $groupId ) {

			// Cria a nova permissão
			$permission = $this->Permission->new();
			$permission->fill([
				'group_id'     => $groupId,
				'component_id' => $component->id,
				'read'         => 'S',
				'update'       => 'S',
				'create'       => 'S',
				'delete'       => 'S',
			])->save();
		}
	}

	/**
	 * salvar
	 * 
	 * Salva um novo componente
	 *
	 * @return void
	 */
	public function salvar() {
		
		// Verifica se existe
		if ( $id = $this->input->post( 'id' ) ) {
			$component = $this->Component->findById( $id );
			$this->__reposition();
		} else $component = $this->Component->new();

		// Cria um novo item
		$component->fill( $this->input->post() );

		// Salva o componente
		if ( $component->save() ) {

			// Seta os grupos de acesso
			$this->__setAccessGroups( $component );

			// Seta a mensagem de sucesso
			flash( 'swaSuccessBody', 'Item salvo com sucesso' );
		} else {

			// Seta a mensagem de erro
			flash( 'swaErrorBody', 'Houve um erro ao salvar o componente' );
		}

		// Redireciona para a ultima url
		close_page( $this->input->post( 'redirect' ) );
	}
}

/* end of file */
