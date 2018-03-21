<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome
 * 
 * Controller inical do codeigniter
 */
class Welcome extends SG_Controller {

	/**
	 * index
	 * 
	 * ponto de entrada da aplicação
	 *
	 * @return void
	 */	
	public function index() {
		redirect( site_url( 'auth' ) );
	}
}

/* end of file */