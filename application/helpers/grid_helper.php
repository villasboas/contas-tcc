<?php

/**
 * rmButton
 * 
 * Imprime o botão de remove
 * 
 */
if ( ! function_exists( 'rmButton' ) ) {
    function rmButton( $link = '' ) {
        $link = site_url( $link );
        return "<a href='$link' class='btn btn-danger btn-sm'>
                    <i class='fa fa-trash-o'></i>
                </a>";
    }
}

/**
 * editButton
 * 
 * Imprime o botão de edit
 * 
 */
if ( ! function_exists( 'editButton' ) ) {
    function editButton( $link = '' ) {
        $link = site_url( $link );        
        return "<a href='$link' class='btn btn-info btn-sm'>
                    <i class='fa fa-pencil'></i>
                </a>";
    }
}

// End of file