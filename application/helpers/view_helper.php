<?php

/**
 * view
 * 
 * Carrega uma view
 * 
 */
if ( ! function_exists( 'view' ) ) {
    function view( $file = 'home' ) {
        
        // Pega a instância do CI
        $ci =& get_instance();

        // Renderiza a view
        return $ci->view->render( $file );
    }
}

/**
 * setItem
 * 
 * Seta um item a ser renderizado na view
 * 
 */
if ( ! function_exists( 'setItem' ) ) {
    function setItem( $key, $value ) {
        
        // Pega a instância do CI
        $ci =& get_instance();

        // Renderiza a view
        return $ci->view->set( $key, $value );
    }
}

/**
 * setTitle
 * 
 * Seta o titulo da página
 * 
 */
if ( ! function_exists( 'setTitle' ) ) {
    function setTitle( $title ) {
        
        // Pega a instância do CI
        $ci =& get_instance();

        // Renderiza a view
        return $ci->view->setTitle( $title );
    }
}

/**
 * item
 * 
 * Pega um item na view
 * 
 */
if ( ! function_exists( 'item' ) ) {
    function item( $key ) {
        
        // Pega a instância do CI
        $ci =& get_instance();

        // Renderiza a view
        return $ci->view->item( $key );
    }
}

/**
 * flash
 * 
 * Seta uma mensagem temporária
 * 
 */
if ( ! function_exists( 'flash' ) ) {
    function flash( string $key, $value = null ) {

        // Pega a instancia do codeigniter
        $ci =& get_instance();

        // Verifica se existe um valor
        if ( $value === null ) {
            return $ci->session->flashdata( $key );
        } else {
            $ci->session->set_flashdata( $key, $value );
        }
    }
}

/**
 * navbar
 * 
 * Pega o item atual do navbar
 */
if ( ! function_exists( 'navbar' ) ) {
    function navbar( $slug, $get = false, $ret = 'active' ) {

        // Pega a instancia do CI
        $ci =& get_instance();

        // Verifica se é um get
        if ( $get ) {

            // Pega o item da sessão
            if ( $item = $ci->session->userdata( 'navbar' ) ) {

                // Verifica se é o mesmo do componente
                return ( $item === $slug ) ? $ret : '';
            } else return '';
        } else {

            // Seta na sessão
            $ci->session->set_userdata( 'navbar', $slug );
        }
    }
}

/**
 * sidebar
 * 
 * Pega o item atual do sidebar
 */
if ( ! function_exists( 'sidebar' ) ) {
    function sidebar( $slug, $get = false, $ret = 'active' ) {

        // Pega a instancia do CI
        $ci =& get_instance();

        // Verifica se é um get
        if ( $get ) {

            // Pega o item da sessão
            if ( $item = $ci->session->userdata( 'sidebar' ) ) {

                // Verifica se é o mesmo do componente
                return ( $item === $slug ) ? $ret : '';
            } else return '';
        } else {

            // Seta na sessão
            $ci->session->set_userdata( 'sidebar', $slug );
        }
    }
}

// End of file