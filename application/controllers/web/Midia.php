<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midia extends SG_Controller {

	/**
	 * __construct
	 * 
	 * método construtor
	 * 
	 */
	public function __construct() {
		parent::__construct();
		setTitle( 'Midias' );

		// Carrega a library
		$this->load->library( 'Slim' );
		$this->load->model( 'midia' );
	}
	
	/**
	 * index
	 * 
	 * método inicial
	 *
	 * @return void
	 */
	public function index( $page = 1 ) {
		
		// Seta o contexto
		context( 'midia' );
		navbar( 'Midias' );

		// Carrega a library de configuração
		$this->config->load( 'pagination' );
		$paginationConfig = $this->config->item( 'pagination' );

		// Carrega todas as midias
		$query  = $this->input->get( 'query' );
		$query  = $query ? $query : '';
		$midias = $this->Midia->where( " name LIKE '%$query%' ")->paginate( $page );		
		setItem( 'query', $query );

		// Carrega a library de paginação
		$paginationConfig['total_rows'] = $midias->total_itens;
		$paginationConfig['per_page']   = $midias->per_page;
		$paginationConfig['base_url']   = '/midia/index';
		$this->load->library( 'pagination', $paginationConfig );
		setItem( 'pagination_links', $this->pagination->create_links() );

		// Percorre todas as midias encontradas
		$formatted = [date( 'd-m-Y', time() ) => [] ];
		foreach( $midias->data as $midia ) {
			$key = date( 'd-m-Y', strtotime( $midia->created_at ) );

			// Verifica se já existe a chave
			if ( isset( $formatted[$key] ) ) {
				$formatted[$key][] = $midia;
			} else $formatted[$key] = [ $midia ];
		}
		setItem( 'midias', $formatted );

		// Carrega a view
		view( 'midias/midias' );
	}

	/**
	 * delete
	 * 
	 * Deleta uma midia
	 *
	 * @param boolean $id
	 * @return void
	 */
	public function delete( $id = false ) {

		// Carrega a midia
		$midia = $this->Midia->findById( $id );
		if ( !$midia ) return close_page( 'midia' );

		// Tenta deletar
		if ( $midia->delete() ) {
			flash( 'swaSuccessBody', 'Midia excluida com sucesso' );
		} else {
			flash( 'swaErrorBody', 'Erro ao excluir a midia' );
		}

		// Carrega a view
		close_page( 'midia' );		
	}

	/**
	 * salvarImagem
	 * 
	 * Salva uma nova imagem
	 *
	 * @return void
	 */
	public function salvar_imagem() {

		// Pega as imagens enviadas
		$images = $this->slim::getImages();
		if ( !isset( $images[0] ) ) return;
		$image  = $images[0];

		// Pega os dados da imagem
		$ext       = pathinfo( $image['input']['name'], PATHINFO_EXTENSION );
		$inputName = $image['input']['name'];
		$hash      = getToken();
		$size      = $image['input']['size'];
		$data      = $image['output']['data'];
		$filename  = $hash.'.'.$ext;		

		// Salva a imagem
		$file = $this->slim::saveFile( $data, $filename, 'public/uploads/', false );

		// Salva a midia
		if ( $file ) {

			// Carrega a model
			$this->load->model( 'midia' );

			// Cria uma nova
			$midia = $this->Midia->new();

			// Seta as propriedades
			$midia->name  = $inputName;
			$midia->hash  = $hash;
			$midia->type  = 'image';
			$midia->ext   = $ext;
			$midia->size  = $size;

			// Salva os dados
			if ( $midia->save() ) {
				echo safe_json_encode( $midia->metadata() );
			} else return;
		} else return;
	}

	/**
	 * find
	 * 
	 * Pega uma midia pelo id
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function find( $id ) {

		// Busca a midia pelo ID
		$midia = $this->Midia->findById( $id );
		if ( !$midia ) return;
		
		// Imprime o JSON
		echo safe_json_encode( $midia->metadata() );
	}

	/**
	 * get
	 * 
	 * Envia as midias para a páginação AJAX
	 *
	 * @param integer $page
	 * @return void
	 */
	public function get( $page = 1 ) {

		// Pega as midias
		$query  = $this->input->get( 'query' );
		$query  = $query ? $query : '';
		$midias = $this->Midia->newer()->where( " name LIKE '%$query%' ")->paginate( $page );

		// Faz o mapping
		$formatted = [date( 'd-m-Y', time() ) => [] ];
		foreach( $midias->data as $midia ) {
			$key = date( 'd-m-Y', strtotime( $midia->created_at ) );

			// Verifica se já existe a chave
			if ( isset( $formatted[$key] ) ) {
				$formatted[$key][] = $midia->metadata();
			} else $formatted[$key] = [ $midia->metadata() ];
		}
		$midias->data = array_filter( $formatted, function( $value ) {
			return ( count( $value ) > 0 );
		});

		// Envia o json
		resolve( $midias );
	}
}

// End of file
