<?php

/**
 * defaultInput
 *
 * imprime o input padrão
 *
 * @return void
 */
if ( !function_exists( 'defaultInput' ) ) {
    function defaultInput( $params ) {

        // faz o extract dos parametros
        extract( $params );

        // inicializa o template
        $template = '';

        // verifica o grid
        if ( isset( $row ) && $row )     $template .= '<div class="row mt-3">';
        if ( isset( $col ) && $col )     $template .= "<div class='$col'>";
        if ( isset( $label ) && $label ) $template .= '<label for="basic-url">'.$label.'</label>';
        if ( isset( $group ) && $group ) $template .= "<div class='$group'>";
        
        // seta os atributos padroes
        $type        = isset( $type ) ? $type : 'text';        
        $class       = 'form-control';
        $placeholder = isset( $placeholder ) ? $placeholder : 'text';

        // verifica se existe um icone
        if ( isset( $icon ) && $icon ) {
            $template .=  "<span class='input-group-addon'>
                                <i class='fa fa-$icon'></i>
                            </span>";
            $class .= ' border-left-0 ';
        }
        
        
        // adiciona o input
        $template .= "<input type='$type' 
                             class='$class' 
                             placeholder='$placeholder' ";
        
        // verifica se existe atributos
        if ( isset( $attr ) && $attr ) {
            foreach( $attr as $key => $item ) $template .= "$key='$item'";
        }

        // fecha o input
        $template .= '>';
        
        // fecha as tags
        if ( isset( $group ) && $group ) $template .= "</div>";
        if ( isset( $col ) && $col ) $template .= "</div>";
        if ( isset( $row ) && $row ) $template .= '</div>';

        // volta o template
        return $template;
    }
}

/**
 * inputText
 * 
 * imprime o input de texto
 * 
 */
if ( ! function_exists( 'inputText' ) ) {
    function inputText( $label, $name, $params = [] ) {
        
        // prepara os parametros
        $params['label'] = $label;
        $params['placeholder'] = isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
        $params['type']  = 'text';
        $params['row']   = isset( $params['row'] ) ? $params['row'] : true;
        $params['col']   = isset(  $params['col'] ) ? $params['col'] : 'col';
        $params['group'] = isset(  $params['group'] ) ? $params['group'] : 'input-group';
        $params['attr']['name'] = $name;

        // chama a funcao;
        echo defaultInput( $params );
    }
}

/**
 * inputNumber
 * 
 * imprime o input numero
 * 
 */
if ( ! function_exists( 'inputNumber' ) ) {
    function inputNumber( $label, $name, $params = [] ) {
        
        // prepara os parametros
        $params['label'] = $label;
        $params['placeholder'] = isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
        $params['type']  = 'number';
        $params['row']   = isset( $params['row'] ) ? $params['row'] : true;
        $params['col']   = isset(  $params['col'] ) ? $params['col'] : 'col';
        $params['group'] = isset(  $params['group'] ) ? $params['group'] : 'input-group';
        $params['attr']['name'] = $name;

        // chama a funcao;
        echo defaultInput( $params );
    }
}

/**
 * inputFile
 * 
 * imprime o input numero
 * 
 */
if ( ! function_exists( 'inputFile' ) ) {
    function inputFile( $label, $name, $params = [] ) {
        
        // prepara os parametros
        $params['label'] = $label;
        $params['placeholder'] = isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
        $params['type']  = 'file';
        $params['row']   = isset( $params['row'] ) ? $params['row'] : true;
        $params['col']   = isset(  $params['col'] ) ? $params['col'] : 'col';
        $params['group'] = isset(  $params['group'] ) ? $params['group'] : 'input-group';
        $params['attr']['name'] = $name;

        // chama a funcao;
        echo defaultInput( $params );
    }
}

/**
 * inputEmail
 * 
 * imprime o input de email
 * 
 */
if ( ! function_exists( 'inputEmail' ) ) {
    function inputEmail( $label, $name, $params = [] ) {
        
        // prepara os parametros
        $params['label'] = $label;
        $params['placeholder'] = isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
        $params['type']  = 'email';
        $params['row']   = isset( $params['row'] ) ? $params['row'] : true;
        $params['col']   = isset(  $params['col'] ) ? $params['col'] : 'col';
        $params['group'] = isset(  $params['group'] ) ? $params['group'] : 'input-group';
        $params['attr']['name'] = $name;
        
        // chama a funcao;
        echo defaultInput( $params );
    }
}

/**
 * inputPassword
 * 
 * imprime o input de senha
 * 
 */
if ( ! function_exists( 'inputPassword' ) ) {
    function inputPassword( $label, $name, $params = [] ) {
        
        // prepara os parametros
        $params['label'] = $label;
        $params['placeholder'] = isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
        $params['type']  = 'password';
        $params['row']   = isset( $params['row'] ) ? $params['row'] : true;
        $params['col']   = isset(  $params['col'] ) ? $params['col'] : 'col';
        $params['group'] = isset(  $params['group'] ) ? $params['group'] : 'input-group';
        $params['attr']['name'] = $name;
        
        // chama a funcao;
        echo defaultInput( $params );
    }
}

/**
 * inputHidden
 * 
 * imprime o input hidden
 * 
 */
if ( ! function_exists( 'inputHidden' ) ) {
   function inputHidden( $name, $value = false, $params = [] ) {
       
        // prepara os parametros
        $params['type']         = 'hidden';
        $params['attr']['name'] = $name;
    
        // Verifica se existe um valor
        if ( $value ) {
            $params['attr']['value'] = $value;
        }

        // chama a funcao;
        echo defaultInput( $params );
   }
}

/**
 * select
 * 
 * imprime o select
 * 
 */
if ( ! function_exists( 'select' ) ) {
   function select( $model, $label, $atributo, $entidade, $attModel = 'name', $attr = [] ) {
       
        // seta a instancia do codeignite
        $ci =& get_instance();
        $ci->load->model( [ $model['name'] ] );
       
       
        // verifica se foi adicionada alguma classe
        if ( isset( $attr['class'] ) ) {
            $attr['class'] = $attr['class'].' form-control';
        } else {
            $attr['class'] = 'form-control';            
        }

        // comeca o template
        $template = "<div class='row mt-3'>
                        <div class='col'>
                            <label for='$atributo'>$label</label>
                                <select id='$atributo' 
                                 class='selectpicker dropup form-control'
                                 name='$atributo'
                                 data-live-search='true'";
        
        // percorre os atributos
        foreach( $attr as $chave => $valor ) $template .= " $chave='$valor'";

        // concatena o template
        $template .= ">";
        foreach ( $ci->{$model['call']}->find() as $opt ) {
                
            // inicio
            $template .= "<option value='".$opt->id ."'";
            
            // verifica se existe uma entidade
            if ( $entidade ) {
                if ( $entidade == $opt->id )
                    $template .= "selected='selected'";
            }
                
            // finaliza
            $template .= ">" .$opt->$attModel ."</option>";

        }

        // seta o template
        $template .= "</select></div></div>";

        // imprime o template
        echo $template;
   }
}

/**
 * selectOpc
 * 
 * imprime o select
 * 
 */
if ( ! function_exists( 'selectOpc' ) ) {
   function selectOpc( $opcoes, $label, $name, $entidade, $attr = [] ) {       
       
        // verifica se foi adicionada alguma classe
        if ( isset( $attr['class'] ) ) {
            $attr['class'] = $attr['class'].' selectpicker dropup form-control';
        } else {
            $attr['class'] = 'selectpicker dropup form-control';            
        }

        // comeca o template
        $template = "<div class='row mt-3'>
                        <div class='col'>
                            <label for='$name'>$label</label>
                                <select id='$name' 
                                 class='". $attr['class'] ."'
                                 name='$name'";
        if( isset( $attr['search'] ) )
            $template .= "data-live-search='true'";
        
        // percorre os atributos
        foreach( $attr as $chave => $valor ) $template .= " $chave='$valor'";

        // concatena o template
        $template .= ">";
        foreach ( $opcoes as $opt ) {
                
            // inicio
            $template .= "<option value='".$opt['value'] ."'";
            
            // verifica se existe uma entidade
            if ( $entidade ) {
                if ( $entidade == $opt['value'] )
                    $template .= "selected='selected'";
            }
                
            // finaliza
            $template .= ">" .$opt['label'] ."</option>";

        }

        // seta o template
        $template .= "</select></div></div>";

        // imprime o template
        echo $template;
   }
}

/* end of file */