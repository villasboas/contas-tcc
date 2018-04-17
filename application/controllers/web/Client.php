<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Client
 * 
 * Controller de crud para Client
 * 
 */
class Client extends SG_Controller {

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
		context( 'client' );

		// carrega a model
		$this->load->model( 'client' );
		$this->model = $this->Client;

		// Verifica se existe um id
		$id = $this->input->get( 'id' );
		$model = $this->model;
		if ( $id ) {
			if ( $md = $this->model->findById( $id ) ) $model = $md;
		}
		
		// Seta a model do grid
		setItem( 'url', 'client/datatables' );
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
		$rules = array (
  0 => 
  array (
    'field' => 'cnpj',
    'label' => 'cnpj',
    'rules' => 'trim|required|max_length[255]',
  ),
  1 => 
  array (
    'field' => 'social_name',
    'label' => 'social_name',
    'rules' => 'trim|required|max_length[255]',
  ),
  2 => 
  array (
    'field' => 'fantasy_name',
    'label' => 'fantasy_name',
    'rules' => 'trim|required|max_length[255]',
  ),
  3 => 
  array (
    'field' => 'representative',
    'label' => 'representative',
    'rules' => 'trim|required|max_length[255]',
  ),
  4 => 
  array (
    'field' => 'cpf',
    'label' => 'cpf',
    'rules' => 'trim|required|max_length[255]',
  ),
  5 => 
  array (
    'field' => 'email',
    'label' => 'email',
    'rules' => 'trim|required|max_length[255]',
  ),
  6 => 
  array (
    'field' => 'city',
    'label' => 'city',
    'rules' => 'trim|required|max_length[255]',
  ),
  7 => 
  array (
    'field' => 'zip_code',
    'label' => 'zip_code',
    'rules' => 'trim|required|max_length[255]',
  ),
  8 => 
  array (
    'field' => 'address',
    'label' => 'address',
    'rules' => 'trim|required|max_length[255]',
  ),
  9 => 
  array (
    'field' => 'address_number',
    'label' => 'address_number',
    'rules' => 'trim|required|max_length[255]',
  ),
  10 => 
  array (
    'field' => 'complement',
    'label' => 'complement',
    'rules' => 'trim|max_length[255]',
  ),
  11 => 
  array (
    'field' => 'neighborhood',
    'label' => 'neighborhood',
    'rules' => 'trim|required|max_length[255]',
  ),
  12 => 
  array (
    'field' => 'phone_number',
    'label' => 'phone_number',
    'rules' => 'trim|required|max_length[255]',
  ),
  13 => 
  array (
    'field' => 'cellphone_number',
    'label' => 'cellphone_number',
    'rules' => 'trim|required|max_length[255]',
  ),
  14 => 
  array (
    'field' => 'status',
    'label' => 'status',
    'rules' => 'trim|required|max_length[1]',
  ),
);

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
		$this->protectIt( 'read' ); 
		setTitle( 'Listagem' );
		
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

		// deleta o item
		if( $item->delete() ) {

			// Seta a mensagem
			flash( 'swaSuccessBody', 'Item excluido com sucesso' );
		} else {

			// Seta a mensagem
			flash( 'swaErrorBody', 'Erro ao excluir o item' );
		}

		// carrega a view
		close_page( 'client/list' );
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
			$item = $this->model->findById( $id );
			$this->protectIt( 'edit' );
		} else {
			$item = $this->model->new();
			$this->protectIt( 'add' ); 			
		}

		// preenche a entidade
		$item->fill( $this->input->post() );
		setItem( 'modelGrid', $item );

		// valida o formulario
		if ( $this->__validate() ) {

			// tenta salvar o item
			if ( $item->save() ) {
				
				// Seta a mensagem
				flash( 'swaSuccessBody', 'Item salvo com sucesso' );
			} else {

				// Seta a mensagem
				flash( 'swaErrorBody', 'Erro ao salvar o item' );
			}
		} else {
			flash( 'swaErrorBody', oneLine( validation_errors() ) );
		}

		// carrega a view
		view( 'grid/grid' );
	}
}

// End of file
