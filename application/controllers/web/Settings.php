<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings
 * 
 * Controller de crud para Settings
 * 
 */
class Settings extends SG_Controller {

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
		context( 'sistema' );

		// Seta o titulo
		setTitle( 'Configurações' );
	}

	/**
	 * index
	 * 
	 * Página inicial
	 * 
	 */
	public function index( $slug = false ) {
		$this->protectIt( admin() );

		// Array de conversão de slug para texto
		if ( !$slug ) close_page( 'home' );
		sidebar( ucfirst( $slug ) );		

		// Pega as configurações
		$settings = $this->settings->getBySlug( $slug );
		$settings = $settings ? $settings : [];

		// Seta na view
		setItem( 'settingsItens', $settings );
		setItem( 'slug', $slug );
		setItem( 'settingsTitle', ucfirst( $slug ) );
		view( 'settings/settings' );
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
	 * delete
	 * 
	 * deleta um dado
	 *
	 * @param boolean $id
	 * @return void
	 */
	public function delete( $key = false, $slug = false ) {
		$this->protectIt( admin() ); 

		// carrega a entidade
		$this->settings->unset( $key );

		// Seta a mensagem
		flash( 'swaSuccessBody', 'Item excluido com sucesso' );

		// carrega a view
		close_page( 'settings/index/'.$slug );
	}

	/**
	 * save
	 * 
	 * salva um dado
	 *
	 * @param boolean $id
	 * @return void
	 */
	public function save() {
		
		// Pega as chaves e os valores
		$keys = $this->input->post( 'keys' ) ? $this->input->post( 'keys' ) : [];
		$vals = $this->input->post( 'vals' ) ? $this->input->post( 'vals' ) : [];
		$slug = $this->input->post( 'slug' );

		// Percorre todas as chaves
		foreach( $keys as $index => $key ) {

			// Verifica se não esta vazia
			if ( !empty( $key ) ) {
				$this->settings->set( $key, $vals[$index], $slug );
			}
		}

		// Pega os dados do novo item
		$newKey = $this->input->post( 'newKey' );
		$newVal = $this->input->post( 'newVal' );

		// Verifica se não esta vazia
		if ( !empty( $newKey ) ) $this->settings->set( $newKey, $newVal, $slug );

		// Seta a mensagem de sucesso
		flash( 'swaSuccessBody', 'As configurações foram alteradas com sucesso.' );
		close_page( "settings/index/$slug" );
	}
}

// End of file
