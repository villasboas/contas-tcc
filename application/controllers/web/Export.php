<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// Seta o contexto
		context( strtolower( 'Export' ) );
	}
	
	/**
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function index( $model = false ) {

		// Valida a model
		if ( !$model ) return close_page( 'home' );
		$this->load->model( $model );
		$this->model = $this->{ucfirst( $model ) };

		// Verifica se a model pode ser exportada
		if ( isset( $this->model->enableExport ) && $this->model->enableExport ) {

			// Carrega os dados
			$dados = $this->model->find();
			setItem( 'dados', $dados );
			setItem( 'model', $this->model );

			// Exporta o arquivo
			$file = $model.' '.date( 'H:i:s d-m-Y', time() ).'.xls';
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
			echo $this->view->html( 'templates.table' );
		} return close_page( 'home' );
	}
}

// End of file
