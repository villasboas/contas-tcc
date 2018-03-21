<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group
 * 
 * Controller de crud para Group
 * 
 */
class Group extends SG_Controller {

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

		// Verifica se o usuário é um admin
		if ( !admin() ) return close_page( 'home' );

		// Seta o contexto
		context( 'sistema' );
		sidebar( 'Grupos' );

		// carrega a model
		$this->load->model( 'group' );
		$this->model = $this->Group;

		// Verifica se existe um id
		$id = $this->input->get( 'id' );
		$model = $this->model;
		if ( $id ) {
			if ( $md = $this->model->findById( $id ) ) $model = $md;
		}
		
		// Seta a model do grid
		setItem( 'url', 'group/datatables' );
		setItem( 'modelGrid', $model );
	}

	/**
	 * __validate
	 * 
	 * valida um formulário
	 *
	 * @return void
	 */
	public function __validate() {
		$rules = [
			[
				'field' => 'name',
				'label' => 'Nome',
				'rules' => 'min_length[3]|max_length[30]|required'
			], [
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'min_length[3]|max_length[30]|required'
			]
		];

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
	public function list() {
		setTitle( 'Grupos' );
		$this->protectIt( 'read' );
		
		// Carrega o grid
		view( 'grid/grid' );
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
		$this->protectIt( 'delete' );
		
		// carrega a entidade
		$item = $this->model->findById( $id );
		if ( !$item ) close_page( 'home' );
		$this->load->model( 'user_group' );

		// deleta o item
		if( $item->delete() ) {

			// Pega todas as relações
			$rels = $this->User_group->getByGroup( $item );
			if ( is_array( $rels ) ) {
				foreach( $rels as $rel ) $rel->delete();				
			}

			// Seta a mensagem
			flash( 'swaSuccessBody', 'Item excluido com sucesso' );
		} else {

			// Seta a mensagem
			flash( 'swaErrorBody', 'Erro ao excluir o item' );
		}

		// carrega a view
		close_page( 'group/list' );
	}

	/**
	 * save
	 * 
	 * salva um dado
	 *
	 * @param boolean $id
	 * @return void
	 */
	public function save( $id = false ) {

		// verifica se existe um id
		if ( $id ) {
			$this->protectIt( 'edit' );	
			$item = $this->model->findById( $id );
		} else {
			$this->protectIt( 'add' );			
			$item = $this->model->new();
		}

		// valida o formulario
		if ( $this->__validate() ) {

			// preenche a entidade
			$item->fill( $this->input->post() );

			// tenta salvar o item
			if ( $item->save() ) {
				
				// Seta a mensagem
				flash( 'swaSuccessBody', 'Grupo salvo com sucesso' );
			} else {

				// Seta a mensagem
				flash( 'swaErrorBody', 'Erro ao salvar o grupo' );
			}
		} else {
			flash( 'swaErrorBody', validation_errors() );
		}

		// carrega a view
		view( 'grid/grid' );
	}
}

// End of file
