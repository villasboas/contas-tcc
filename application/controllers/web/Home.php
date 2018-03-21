<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home
 * 
 * Controller para a home
 * 
 */
class Home extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();

		// Seta o contexto
		context( 'home' );

		// Seta a navbar
		navbar( 'Inicio' );
	}
	
	/**
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function index() {
		setTitle( 'Inicio' );

		$link = $this->input->get( 'query' );
		$link = $link ? $link : 'http://rss.home.uol.com.br/index.xml';

		$this->load->library( 'rss' );
		$rss = $this->rss->load( $link );

		if ( !$rss->status ) {
			flash( 'swaErrorBody', $rss->error );
		}

		setItem( 'rss', $rss );

		// Carrega o grid
		view( 'home/home' );
	}

	/**
	 * modo_de_edicao
	 * 
	 * Habilita o modo de edição
	 *
	 * @return void
	 */
	public function modo_de_edicao() {
		loggedOnly();

		// Pega a url de redirect
		$url = $this->input->get( 'redirect' );
		$url = $url ? $url : 'home';

		// Verifica se está no modo de edição
		if ( editMode() ) {
			disableEditMode();
		} else enableEditMode();

		// redireciona para a url
		close_page( $url );
	}
}

// End of file
