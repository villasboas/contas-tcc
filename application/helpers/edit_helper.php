<?php

/**
 * editMode
 * 
 * Verifica se o modo de edição está ativo
 * 
 */
if ( ! function_exists( 'editMode' ) ) {
    function editMode() {

        // pega a instancia
        $ci =& get_instance();

        // verifica se o modo de edicao esta habilitado
        return $ci->session->userdata( 'edit_mode' );
    }
}

/**
 * disableEditMode
 * 
 * disablita o edit mode
 * 
 */
if ( ! function_exists( 'disableEditMode' ) ) {
    function disableEditMode() {

        // pega a instancia
        $ci =& get_instance();

        // verifica se o modo de edicao esta habilitado
        return $ci->session->unset_userdata( 'edit_mode' );
    }
}

/**
 * enableEditMode
 * 
 * habilita o edit mode
 * 
 */
if ( ! function_exists( 'enableEditMode' ) ) {
    function enableEditMode() {

        // pega a instancia
        $ci =& get_instance();

        // verifica se o modo de edicao esta habilitado
        return $ci->session->set_userdata( 'edit_mode', true );
    }
}

/**
 * components
 * 
 * Pega components pelo slug
 * 
 */
if ( !function_exists( 'components' ) ) {
    function components( $slug, $parentId = false ) {

        // Pega a instancia do ci
        $ci =& get_instance();

        // Verifica se o usuário está logado
        if ( !auth() ) return [];

        // Carrega a model
        $ci->load->model( [ 'component', 'permission' ] );

        // Pega os grupos do usuário atual
        $groupIds = array_map( function( $value ) {
            return $value->id;
        }, groups( auth()->id ) );

        // Retorna os componets
        $itens = [];
        if ( !$parentId ) {
            $itens = $ci->Component->bySlug( $slug );
        } else {
            $itens = $ci->Component->byParentIdAndSlug( $slug, $parentId );        
        }

        // Verifica se o usuário é admin
        if ( admin() ) return $itens ? $itens : [];
        $itens = $itens ? $itens : [];

        // Percorre os components
        $returnItens = [];
        foreach( $itens as $index => $item ) {

            // Pega as permissons pelo componente
            $permissions = $ci->Permission->byComponent( $item->id );      
            if ( !$permissions ) continue;

            // Percorre as permissões
            foreach( $permissions as $permission ) {

                // Verifica se o usuário atual tem permissão
                if ( in_array( $permission->group_id, $groupIds ) ) {
                    $returnItens[] = $item;
                    break;
                }
            }
        }

        // Volta os itens permitidos
        return $returnItens;
    }
}

/**
 * editLink
 * 
 * Imprime o link de edição
 * 
 */
if ( ! function_exists( 'editLink' ) ) {
    function editLink( $action, $slug, $ordem = 0, $id = false, $parent = false ) {
        $url = "?edit_mode=true&action=$action&slug=$slug&id=$id&parent=$parent&ordem=$ordem&redirect=".uri_string();
        echo site_url( uri_string().$url );
    }
}

/**
 * deleteLink
 * 
 * Imprime o link de delete
 * 
 */
if ( ! function_exists( 'deleteLink' ) ) {
    function deleteLink( $id ) {
        echo site_url( 'edit_mode/delete/'.$id.'?redirect='.uri_string() );
    }
}

/**
 * getAttr
 * 
 * Pega um atributo
 * 
 */
if ( ! function_exists( 'getAttr' ) ) {
    function getAttr( $key ) {
        return get_instance()->input->get( $key );
    }
}

/**
 * attrValue
 * 
 * Pega o valor de um atributo
 * 
 */
if( ! function_exists( 'attrValue' ) ) {
    function attrValue( $key ) {

        // Pega a instãncia do ci
        $ci =& get_instance();

        // Pega o id
        $id = $ci->input->get( 'id' );

        // Carrega a model
        $ci->load->model( 'component' );

        // Carrega pelo id
        $component = $ci->Component->findById( $id );

        // Verifica se existe um atributo
        return ( $component ) ? $component->$key : '';
    }
}

/**
 * getContext
 * 
 * Pega o contexto atual
 * 
 */
if ( ! function_exists( 'getContext' ) ) {
    function getContext() {
        return get_instance()->session->userdata( 'context' );
    }
}

/**
 * context
 * 
 * Seta o contexto da página
 * 
 */
if ( ! function_exists( 'context' ) ) {
    function context( $name ) {
        get_instance()->session->set_userdata( 'context', $name );
    }
}

// End of file