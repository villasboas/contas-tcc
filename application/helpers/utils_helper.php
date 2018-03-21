<?php

/**
 * array_depth
 * 
 * verifica a profundidade do array
 * 
 */
if ( !function_exists( 'array_depth' ) ) {
    function array_depth( array $array ) {

        // verifica a profundidade
        $max_depth = 1;

        // percorre o array
        foreach ( $array as $value ) {

            // verifica se é um array
            if ( is_array( $value ) ) {

                // pega a profundidade
                $depth = array_depth( $value ) + 1;

                // verifica se é maior
                if ( $depth > $max_depth ) $max_depth = $depth;
            }
        }

        // retorna a profundidade
        return $max_depth;
    }
}

/**
 * debug
 *
 * faz o debug do código
 *
 */
if ( ! function_exists( 'debug' ) ) {
    function debug( $var, $blocking = true ) {
        
        // imprime a pré visualizacao
        echo '<pre>';
    
        // verifica se é um dump bloqueante
        if ( $blocking )
            die( var_dump( $var ) );
        else
            var_dump( $var );
        
        // volta false
        return false;
    }
}

/**
 * sitename
 *
 * imprime o nome do site
 *
 */
if ( ! function_exists( 'sitename' ) ) {
    function sitename() {
        
        // Pega a instancia do CI
        $ci =& get_instance();

        // Pega o nome do site
        return $ci->config->item( 'site_name' );
    }
}

/**
 * is_nullable
 * 
 * verifica se um campo é nulo
 * 
 */
if ( ! function_exists( 'is_nullable' ) ) {
    function is_nullable( $path = 'table.column' ) {

        // pega a coluna e a tabela
        $table  = explode( '.', $path )[0];
        $column = explode( '.', $path )[1];

        // pega a instancia do ci
        $ci =& get_instance();

        // seta o banco
        $db = $ci->db->database;

        // monta a query
        $query = "SELECT IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table' AND table_schema = '$db' AND column_name LIKE '$column'";
        
        // executa a busca
        $busca = $ci->db->query( $query );

        // Verifica se existe resultado
        if ( $busca->num_rows() > 0 ) {
            
            // verifica se é nulo
            $isn = $busca->result_array()[0]['IS_NULLABLE'];

            // volta o resultado
            return $isn === 'YES' ? true : false;
        } else return false;
    }
}

/**
 * now
 * 
 * gera um novo item
 * 
 */
if ( ! function_exists( 'now' ) ) {
    function now() {
        return date( 'Y-m-d H:i:s', time() );
    }
}

/**
 * site_name
 * 
 * volta o nome do site
 * 
 */
if ( ! function_exists( 'site_name' ) ) {
    function site_name() {

        // pega a instancia do ci
        $ci =& get_instance();

        // volta o nome do site
        return $ci->config->item( 'SITE_NAME' );
    }
}

/**
 * close_page
 * 
 * fecha a página e vai para outro
 * 
 */
if ( ! function_exists( 'close_page' ) ) {
    function close_page( $path = 'auth' ) {
        redirect( $path );
        return null;
    }
}

/**
 * startsWith
 * 
 * Indica se uma string começa com uma sequencia de chars
 * 
 */
if ( ! function_exists( 'startsWith' ) ) {
    function startsWith( $haystack, $needle ) {
         $length = strlen($needle);
         return ( substr( $haystack, 0, $length ) === $needle );
    }
}

/**
 * endsWith
 * 
 * Verifica se uma string termina com uma sequencia de chars
 * 
 */
if ( ! function_exists( 'endsWith' ) ) {    
    function endsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        return $length === 0 || ( substr( $haystack, -$length ) === $needle );
    }
}

/**
 * clickOpen
 * 
 * Abre um link ao ser clicado
 * 
 */
if ( ! function_exists( 'clickOpen' ) ) {
    function clickOpen( $link ) {
        return 'onclick="location.href =\''.site_url( $link ).'\'"';
    }
}

/**
 * model
 * 
 * Carrega uma model
 * 
 */
if ( ! function_exists( 'model' ) ) {
    function model( $model ) {

        // Carrega a instancia do CI
        $ci =& get_instance();

        // Carrega a model
        $ci->load->model( $model );
        $model = ucfirst( $model );

        // Volta a model carregada
        return $ci->$model;
    }
}

/**
 * utf8ize
 * 
 * Corrige strings para UTF8
 * 
 */
if ( ! function_exists( 'utf8ize' ) ) {
    function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = utf8ize($value);
            }
        } else if (is_string ($mixed)) {
            return utf8_encode($mixed);
        }
        return $mixed;
    }
}

/**
 * safe_json_encode
 * 
 * Gera um JSON seguro
 */
if ( ! function_exists( 'safe_json_encode' ) ) {
    function safe_json_encode($value, $options = 0, $depth = 512){
        $encoded = json_encode($value, $options, $depth);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $encoded;
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_UTF8:
                $clean = utf8ize($value);
                return safe_json_encode($clean, $options, $depth);
            default:
                return 'Unknown error'; // or trigger_error() or throw new Exception()
    
        }
    }
}

/**
 * getDbSize
 * 
 * Pega o tamanho do size
 * 
 */
if ( ! function_exists( 'getDbSize' ) ) {
    function getDbSize() {
        
        // Pega a instancia do CI
        $CI = &get_instance();
        $CI->load->database();
        
        // Pega o nome do banco
        $dbName = $CI->db->database;
        $dbName = $CI->db->escape( $dbName );
        
        // Seta a query
        $sql = "SELECT table_schema AS db_name, sum( data_length + index_length ) / 1024 / 1024 AS db_size_mb 
                FROM information_schema.TABLES 
                WHERE table_schema = $dbName
                GROUP BY table_schema ;";
        
        // Executa a query
        $query = $CI->db->query( $sql );
        
        // Verifica se existe resultado
        if ( $query->num_rows() == 1 ) {
            
            // Pega o tamanho do banco
            $row = $query->row(); 
            $size = $row->db_size_mb;
            
            // Volta o tamanho
            return $size;
        } else return 0;
    }
}

/**
 * folderSize
 * 
 * Pega o tamanho de uma pasta
 * 
 */
if ( ! function_exists( 'folderSize' ) ) {
    function folderSize ( $dir ) {
        $size = 0;
        foreach ( glob( rtrim( $dir, '/' ).'/*', GLOB_NOSORT ) as $each ) {
            $size += is_file( $each ) ? filesize( $each ) : folderSize( $each );
        }
        return $size;
    }
}

/**
 * settings
 * 
 * Pega um item das configurações
 * 
 */
if ( ! function_exists( 'settings' ) ) {
    function settings( $key ) {

        // Pega a instancia do ci
        $ci =& get_instance();

        // Volta o item
        return $ci->settings->get( $key );
    }
}

/**
 * oneLine
 * 
 * Imprime uma string em uma linha
 * 
 */
if ( !function_exists( 'oneLine' ) ) {
    function oneLine( $str ) {
        $str = strip_tags( $str );
        $str = filter_var( $str, FILTER_SANITIZE_STRING );
        $str = preg_replace("/(\/[^>]*>)([^<]*)(<)/","\\1\\3",$str);
        $str = preg_replace("/[\r\n]*/","",$str);
        $str = str_replace(array("\r","\n"),"",$str);
        return trim( $str );
    }
}

/**
 * getToken
 * 
 * Pega um token aleatório
 * 
 */
if ( !function_exists( 'getToken' ) ) {
    function getToken() {
        return md5( uniqid( rand() * time() ) );
    }
}

// End of file