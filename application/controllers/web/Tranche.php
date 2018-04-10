<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tranche
 * 
 * Controller de crud para Tranche
 * 
 */
class Tranche extends SG_Controller {

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
		context( 'bill' );
		navbar( 'Contas' );

		// carrega a model
		$this->load->model( 'tranche' );
		$this->model = $this->Tranche;

		// Verifica se existe um id
		$id = $this->input->get( 'id' );
		$model = $this->model;
		if ( $id ) {
			if ( $md = $this->model->findById( $id ) ) $model = $md;
		}
		
		// Seta a model do grid
		setItem( 'url', 'tranche/datatables' );
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
    'field' => 'bill_id',
    'label' => 'bill_id',
    'rules' => 'trim|required|max_length[11]|integer',
  ),
  1 => 
  array (
    'field' => 'value',
    'label' => 'value',
    'rules' => 'trim|required|max_length[255]',
  ),
  2 => 
  array (
    'field' => 'expiration_date',
    'label' => 'expiration_date',
    'rules' => 'trim|required',
  ),
  3 => 
  array (
    'field' => 'payment_date',
    'label' => 'payment_date',
    'rules' => 'trim',
  ),
  4 => 
  array (
    'field' => 'paid_value',
    'label' => 'paid_value',
    'rules' => 'trim|max_length[255]',
  ),
  5 => 
  array (
    'field' => 'status',
    'label' => 'status',
    'rules' => 'trim|required|max_length[1]',
  ),
  6 => 
  array (
    'field' => 'interest_rate',
    'label' => 'interest_rate',
    'rules' => 'trim|max_length[255]',
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
		close_page( 'tranche/list' );
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
