<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// Seta o contexto
		context( strtolower( 'Import' ) );
	}
	
	/**
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function index() {
		echo 'Welcome to Import';
	}
}

// End of file
