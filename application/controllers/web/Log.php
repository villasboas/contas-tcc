<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends SG_Controller {

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
		$this->protectIt( admin() );

		// carrega a model
		$this->load->model( 'log' );
		$this->model = $this->Log;

		// Seta o contexto
		context( 'sistema' );
		sidebar( 'Logs' );
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
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function list( $id = false ) {
		setTitle( 'Listagem' );
		$this->load->model( 'log' );

		// Seta a model do grid
		setItem( 'url', 'log/datatables' );
		setItem( 'modelGrid', $this->model );

		// Verifica se existe um id
		if ( $id ) {
			if ( $item = $this->model->findById( $id ) ) {
				setItem( 'viewLog', $item );
			}
		}
		
		// Carrega o grid
		view( 'log/log' );
	}
}

// End of file
