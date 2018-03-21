<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * RSS
 * 
 * Classe para leitura de links RSS
 * 
 */
class Rss {

    /**
     * ci
     * 
     * instancia do ci
     *
     * @var [type]
     */
    public $ci;

    /**
     * Status do feed RSS
     *
     * @var boolean
     */
    public $status = false;

    /**
     * Ultimo erro da classe
     *
     * @var string
     */
    public $error = '';

    /**
     * Noticias encontradas
     *
     * @var array
     */
    public $news = [];

    /**
     * __construct
     * 
     * método construtor
     * 
     */
    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * Pega os links de imagem de uma url
     *
     * @param [type] $str
     * @return void
     */
    private function __getImageUrl( $str ) {

        // Prepara a string
        $str = json_encode( $str );
        $str = stripslashes( $str );
        $str = str_replace( '"', " ", $str );

        // Explode os links
        $parts = explode( 'http', $str );

        // Pega os provaveis pontos de link
        preg_match_all( '/.(?:JPG|PNG|GIF|jpg|png|gif)/', $str, $exts, PREG_OFFSET_CAPTURE );
        preg_match_all( '/(?:http|HTTP|https|HTTPS):\/\//', $str, $https, PREG_OFFSET_CAPTURE );

        // Seta o offset
        $uOffset = false;
        $pOffset = false;
        $img = false;

        // Percorre as extensoes
        foreach( $exts[0] as $ext ) {
            $uOffset = $ext[1];
            $lr = 0;

            // Percorre os http
            foreach( $https[0] as $http ) {
                $res = $uOffset - $http[1];

                // Seta o offset inicial
                $pOffset = ( $pOffset === false || $res < $lr ) ? $http[1] : $pOffset;
                $lr = $res;
            }
            
            // Verifica se existe uma imagem
            if ( !in_array( FALSE, [ $pOffset, $uOffset ] ) )
                $img = substr( $str, $pOffset, ( $uOffset - $pOffset + 4 ) );
        }

        // Volta a imagem encontrada
        return $img;
    }

    /**
     * Faz o parse do XML
     *
     * @param [type] $str
     * @return void
     */
    private function __parseXML( $original ) {
        libxml_use_internal_errors( true );

        // Tenta com o CDATA removido
        $feed = str_replace( ['<![CDATA[', ']]>' ], ' ', $original );
        try {
            $xml = new SimpleXMLElement( $feed );
            return $xml;
        } catch( Exception $e ) {
            $this->status = false;
            $this->error = $e->getMessage();
        }

        // Tenta converter diretamente
        try {
            $xml = new SimpleXMLElement( $original );
            return $xml;
        } catch( Exception $e ) {
            $this->status = false;
            $this->error = $e->getMessage();
        }

        // Faz o encode
        $original = utf8_encode( $original );
        try {
            $xml = new SimpleXMLElement( $original );
            return $xml;
        } catch( Exception $e ) {
            $this->status = false;
            $this->error = $e->getMessage();
        }

        // Volta false
        return false;
    }

    /**
     * Carrega um feed RSS
     *
     * @param [type] $url
     * @return void
     */
    public function load( $url ) {
        
        // Carrega a URL
        $feed = file_get_contents( $url );

        // Converte o XML para array
        $xml = $this->__parseXML( $feed );
        if ( is_bool( $xml ) ) return $this;

        // Verifica se existe o canal
        if ( !isset( $xml->channel ) ) {
            $this->status = false;
            $this->error = 'O feed RSS é inválido';
            return $this;
        }; 

        // Array com as noticias
        $news = [];
           
        // Percorre as entradas
        foreach( $xml->channel->item as $entry ) {

            // Pega a capa
            $entry->cover = $this->__getImageUrl( $entry );

            // Verifica se existe tag de midia
            $midia = $entry->children( 'media', true )->thumbnail;
            if( $midia && $midia->attributes() ) {
                $md = $midia->attributes();
                $entry->cover = $md->url;
            }
            $midia = $entry->children( 'media', true )->content;
            if( $midia && $midia->attributes() ) {
                $md = $midia->attributes();
                $entry->cover = $md->url;
            }
            
            // Adiciona a noticia
            $news[] = json_decode( json_encode( $entry ), TRUE );
        }

        // Faz o mapping das noticias
        $news = array_map( function( $value ) {
            $value['description'] = isset( $value['description'] ) ? $value['description'] : '';

            // Limpa a descrição
            if ( is_array( $value['description'] ) ) $value['description'] = '';
            if ( is_array( $value['title'] ) ) $value['title'] = false;

            // Limpa a descrição
            if ( is_string( $value['description'] ) ) {
                $value['description'] = trim( strip_tags( $value['description'] ) );
            }

            // Arruma a capa
            $value['cover'] = ( count( $value['cover'] ) == 0 ) ? false : $value['cover'];

            // Volta o valor
            return $value;
        }, $news );

        // Retira os que não contemplatam os itens fundamentais
        $this->news = array_filter( $news, function( $value ) {
            return ( $value['title'] );
        });

        // Seta o status como true
        $this->status = true;

        // Volta a instancia
        return $this;
    }

    /**
     * Para cada uma das noticias encontradas
     *
     * @param [type] $callback
     * @return void
     */
    public function forEachRows( $callback ) {
        foreach( $this->news as $new ) $callback( $new );
    }
};

// End of file