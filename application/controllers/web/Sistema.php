<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();
		$this->protectIt( admin() );

		// Seta o contexto
		context( strtolower( 'Sistema' ) );

		// Seta a navbar
		navbar( 'sistema' );
		sidebar( 'Sistema' );
	}
	
	/**
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function index() {

		// Carrega as models
		$this->load->model( [ 'user', 'log' ] );

		// Seta o tamanho do banco de dados
		setItem( 'dbSize', getDbSize() );
		setItem( 'userSize', $this->User->total() );
		setItem( 'uploadsSize', folderSize( 'public/uploads' ) );

		// Seta a model do grid
		$this->load->model( 'component' );
		setItem( 'modelGrid', $this->Component );

		// Carrega os logs
		$logs = $this->Log->order( "id", "DESC" )->paginate( 0, 3 );
		setItem( 'logs', $logs );

		// Carrega o grid
		view( 'sistema/sistema' );
	}
}

// End of file
