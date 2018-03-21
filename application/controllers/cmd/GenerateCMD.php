<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * GenerateCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class GenerateCMD extends CI_Controller {

    /**
     * ci_sessions
     * 
     * tabelas que não devem gerar model
     *
     * @var array
     */
    public $exceptions = [ 'ci_sessions', 'sg_settings' ];

    /**
     * construct
     * 
     * método constructor
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * __getFields
     * 
     * pega os campos de uma tabela
     *
     * @param [type] $table
     * @return void
     */
    private function __getFields( $table ) {

        // verifica se a tabela existe
        if ( ! $this->db->table_exists( $table ) ) return [];

        // pega os campos
        $fields = $this->db->list_fields( $table );

        // array de retorno
        $ret = [];

        // seta o array
        foreach ( $fields as $field ) {
            
            // se for id, ignore
            if ( $field == 'id' ) continue;

            // seta o campo
            $key = lcfirst( $field );
            $ret[$key] = $field;
        }

        // volta os campos
        return $ret;
    }

    /**
     * __getForm
     * 
     * Volta o formulário
     *
     * @param [type] $schema
     * @return void
     */
    private function __getForm( $schema ) {

        // Seta os campos que aparecem no formulário
        $schema = array_filter( $schema, function( $key ) {
            if ( !in_array( $key, [ 'id', 'created_at', 'updated_at' ] ) ) return true;
        }, ARRAY_FILTER_USE_KEY );

        // Seta os campos no formato correto
        array_walk( $schema, function( &$value, $key ) {
            
            // Seta o tipo padrao
            $type = 'text';
            
            // Seta as regras
            $rules  = 'trim'; 
            $rules .= ( isset( $value['null'] ) && $value['null'] ) ? '' : '|required';
            $rules .= ( isset( $value['constraint'] ) ) ? '|max_length['.$value['constraint'].']' : '';

            // Faz o swictch no tipo
            switch( $value['type'] ) {
                case 'int':
                    $type = 'number';
                    $rules .= '|integer';
                break;
            }

            // Seta os valores
            $value = [
                'label' => $key,
                'name'  => $key,
                'type'  => $type,
                'rules' => $rules
            ];
        });    

        // Volta o formulário encontrado
        return $schema;
    }

    /**
     * __getDataTable
     * 
     * Seta o array de datatable
     *
     * @param [type] $model
     * @param [type] $schema
     * @return void
     */
    private function __getDataTable( $model, $schema ) {
        
        // Seta os campos que aparecem no formulário
        $schema = array_filter( $schema, function( $key ) {
            if ( !in_array( $key, [ 'id', 'created_at', 'updated_at' ] ) ) return true;
        }, ARRAY_FILTER_USE_KEY );

        // Seta o schema
        $schema = $schema ? $schema : [];
        
        // Seta o datatables
        $datatable = [ [ 'db' => 'id', 'dt' => 0 ] ];

        // Campos das tabelas
        $visibles = [ 'ID' ];
        $cont = 1;
        foreach( $schema as $key => $item ) {
            if ( count( $visibles ) >= 4 ) break;
            $visibles[] = $key;
            $datatable[] = [ 'db' => $key, 'dt' => $cont ];
            $cont++;
        }
        $visibles[] = 'Ações';

        // Volta os dados encontrados
        return [ 
            'visibles' => $visibles,
            'datatables' => $datatable
        ];
    }

    /**
     * model
     *
     * cria uma nova model
     * 
     * @param [type] $modelName
     * @return void
     */
    public function model($name = false, $schema = false ) {

        // se não existir um nome
        if (!$name) return cmdLine( 'Você deve informar um nome!' );

        // pega o nome da tabela
        $table_name = ucfirst( $name );
        if ( strpos( $name, ':' ) !== false ) {

            // explode
            $pts = explode( ':', $name );
            $table_name = $pts[1];
            $name       = $pts[0];
        }

        // verifica se a model já existe
        if ( file_exists( "application/models/$name/$name"."_model.php" ) ) {
            return cmdLine( 'A model já existe!' );
        }

        // Seta o formulário
        $form = $schema ? $this->__getForm( $schema ) : [];

        // pega os campos da tabela
        $fields    = $this->__getFields( $name );
        $datatable = $this->__getDataTable( $name, $schema );

        // seta os atributos velhos
        $in_file = [
            '%_FINDER_FILE_%',
            '%_ENTITY_NAME_%',
            '%_MODEL_NAME_%',
            '%_FINDER_NAME_%',
            '%_TABLE_NAME_%',
            '%_FIELDS_%',
            '%_FORM_FIELDS_%',
            '%_VISIBLES_%',
            '%_DATATABLES_%',
            '%_ACTION_NUMBER_%'
        ];
    
        // seta os atributos novos
        $to_file = [
            $name.'_finder.php',
            $name,
            ucfirst( $name ).'_model',
            ucfirst( $name ).'_finder',
            strtolower( $table_name ),
            var_export( $fields, true ),
            var_export( $form, true ),
            var_export( $datatable['visibles'], true ),
            var_export( $datatable['datatables'], true ),
            count( $datatable['datatables'] )
        ];
    
        // pega o conteudo do arquivo
        $temp = file_get_contents( 'application/core/templates/default_model.txt' );
        
        // aplica o replace
        $record = str_replace( $in_file, $to_file, $temp );

        // cria o arquivo
        file_force_contents( "application/models/$name/$name"."_model.php", $record );
        
        // exibe mensagem de sucesso
        cmdLine( "Model $name criada com sucesso" );
    }

    /**
     * finder
     *
     * cria um finder
     * 
     * @param boolean $name
     * @return void
     */
    public function finder($name = false) {

        // se não existir um nome
        if (!$name) return cmdLine( 'Você deve informar um nome para o finder!' );

        // verifica se o finder já existe
        if ( file_exists( "application/models/$name/$name"."_finder.php" ) ) {
            return cmdLine( "O finder $name já existe!" );
        }

        // seta os atributos velhos
        $in_file = [
            '%_FINDER_NAME_%',
            '%_FINDER_ENTITY_%',
            '%_MODEL_NAME_%'
        ];

        // seta os atributos novos
        $to_file = [
            ucfirst( $name ).'_finder',
            $name,
            ucfirst( $name ).'_model'
        ];

         // pega o conteudo do arquivo
        $temp = file_get_contents( 'application/core/templates/default_finder.txt' );
    
        // aplica o replace
        $record = str_replace( $in_file, $to_file, $temp );

        // cria o arquivo
        file_force_contents( "application/models/$name/$name"."_finder.php", $record );
    
        // mensagem de sucesso
        cmdLine( "Finder $name criado com sucesso" );
    }

    /**
     * table
     *
     * cria a tabela
     * 
     * @param [type] $table_name
     * @return void
     */
    public function table( $table_name, ...$properties ) {

        // seta o campo padrao
        $default = [
            (object) [
                'type'           => 'int',
                'max_length'     => 11,
                'name'           => 'id',
                'primary_key'    => true,
                'auto_increment' => true,
                'null'           => false
            ], 
            (object) [
                'name' => 'created_at',
                'type' => 'datetime',
                'null' => false,
            ],
            (object) [
                'name' => 'updated_at',
                'type' => 'datetime',
                'null' => true
            ],
        ];

        // Verifica se foram informadas propriedades
        if ( count( $properties ) > 0 ) {

            // percorre todos os argumentos
            foreach( $properties as $prop ) {

                // Verifica se é uma string
                if ( !is_string( $prop ) ) continue;

                // Faz o explode
                $exp = explode( '::', $prop );

                // O campo
                $propField = [];

                // Seta as propriedades
                foreach( $exp as $line ) {
                    $p = explode( ':', $line );
                    $propField[$p[0]] = $p[1];
                }
                
                // Adiciona o campo
                $default[] = (object) $propField;
            }
        }

        // percorre as proriedades
        foreach( $properties as $propertie ) {
            $field['type'] = 'string';
        }

        // pega a informação dos campos
        $fields = $this->db->table_exists( $table_name ) ? $this->db->field_data( $table_name ) : $default;

        // esquema do banco
        $schema = [];

        // percorre os campos
        foreach ( $fields as $field ) {

            // seta as propriedades dos campos
            $schema[$field->name]['type'] = $field->type;            
            if ( isset( $field->max_length ) && $field->max_length )  $schema[$field->name]['constraint']     = $field->max_length;
            if ( isset( $field->primary_key ) && $field->primary_key ) $schema[$field->name]['primary_key']    = true;
            if ( isset( $field->primary_key ) && $field->primary_key ) $schema[$field->name]['auto_increment'] = true;
            $schema[$field->name]['null'] = isset( $field->null ) ? $field->null : is_nullable( $table_name.'.'.$field->name );
        }

        // seta os atributos velhos
        $in_file = [
            '%_TABLE_NAME_% ',
            '%_TABLE_SCHEMA_%'
        ];

        // seta os atributos novos
        $to_file = [
            $table_name,
            var_export( $schema, true )
        ];

        // carrega o inflector
        $this->load->helper( 'inflector' );

        // nome da model
        $modelName = lcfirst( $table_name );

        // pega o conteudo do arquivo
        $temp = file_get_contents( 'application/core/templates/default_table.txt' );
         
        // aplica o replace
        $record = str_replace( $in_file, $to_file, $temp );

        // cria o arquivo
        file_force_contents( "application/models/$modelName/$modelName"."_table.php", $record );
    
        // mensagem de sucesso
        cmdLine( "Tabela $modelName criada com sucesso" );

        // Volta os campos da tabela
        return $schema;
    }

    /**
     * dao
     *
     * cria uma model e um finder
     * 
     * @param boolean $name
     * @return void
     */
    public function dao( $name = false, ...$properties ) {
        $schema = $this->table( $name, $properties );
        $this->finder( $name );
        $this->model( $name, $schema );
    }

    /**
     * page
     *
     * gera uma nova página
     * 
     * @param boolean $name
     * @return void
     */
    public function page( $name = false ) {
        
        // se não existir um nome
        if (!$name) return cmdLine( "Voce deve informar um nome para a pagina!" );

        // verifica se a página já existe
        if ( file_exists( "frontend/pages/$name/$name.blade.php" ) ) {
            return cmdLine( "A pagina $name ja existe!" );
        }

        // pega os caminhos dos templates
        $t_paths = [
            'scss' => 'application/core/templates/default_page_scss.txt',
            'js'   => 'application/core/templates/default_page_js.txt',
            'html' => 'application/core/templates/default_page_html.txt',
        ];

        // seta os caminhos
        $paths = [
            'scss' => "frontend/pages/$name/$name.scss",
            'js'   => "frontend/pages/$name/$name.js",
            'html' => "frontend/pages/$name/$name.blade.php"
        ];

        // seta as variaveis do template
        $t_vars = [ '%_PAGE_ID_%' ];

        // seta as variaveis com valor
        $t_val = [ $name ];

        // percorre todas as vars
        foreach( $t_paths as $key => $value ) {

             // pega o conteudo
             $record = file_get_contents( $value );

             // subistiui os valores
             $record = str_replace( $t_vars, $t_val, $record );

             // salva no novo arquivo
             file_force_contents( $paths[$key], $record );
        }

        // imprime a mensagem
        cmdLine( "Pagina $name criada com sucesso!" );
    }

    /**
     * component
     *
     * gera um novo component
     * 
     * @param boolean $name
     * @return void
     */
    public function component( $name = false ) {
        
        // se não existir um nome
        if (!$name) return cmdLine( "Voce deve informar um nome para o componente!" );

        // verifica se o componente já existe
        if ( file_exists( "frontend/components/$name/$name.blade.php" ) ) {
            cmdLine( "O componente $name ja existe!" );
        }

        // pega os caminhos dos templates
        $t_paths = [
            'scss' => 'application/core/templates/default_page_scss.txt',
            'js'   => 'application/core/templates/default_page_js.txt',
            'html' => 'application/core/templates/default_component_html.txt',
        ];

        // seta os caminhos
        $paths = [
            'scss' => "frontend/components/$name/$name.scss",
            'js'   => "frontend/components/$name/$name.js",
            'html' => "frontend/components/$name/$name.blade.php"
        ];

        // seta as variaveis do template
        $t_vars = [ '%_PAGE_ID_%' ];

        // seta as variaveis com valor
        $t_val = [ $name ];

        // percorre todas as vars
        foreach( $t_paths as $key => $value ) {

             // pega o conteudo
             $record = file_get_contents( $value );

             // subistiui os valores
             $record = str_replace( $t_vars, $t_val, $record );

             // salva no novo arquivo
             file_force_contents( $paths[$key], $record );
        }

        // imprime a mensagem
        cmdLine( "Componente criada com sucesso" );
    }

    /**
     * layout
     *
     * gera um novo layout
     * 
     * @param boolean $name
     * @return void
     */
    public function layout( $name = false ) {
        
        // se não existir um nome
        if (!$name) return cmdLine( "Voce deve informar um nome para o layout!" );

        // verifica se o componente já existe
        if ( file_exists( "frontend/layouts/$name.blade.php" ) ) {
            return cmdLine( "O Layout $name ja existe!" );
        }

        // pega os caminhos dos templates
        $t_paths = [
            'html' => 'application/core/templates/default_page_layout.txt',
        ];

        // seta os caminhos
        $paths = [
            'html' => "frontend/layouts/$name.blade.php"
        ];

        // percorre todas as vars
        foreach( $t_paths as $key => $value ) {

             // pega o conteudo
             $record = file_get_contents( $value );

             // salva no novo arquivo
             file_force_contents( $paths[$key], $record );
        }

        // imprime a mensagem
        cmdLine( "Layout $name criado com sucesso!" );
    }

    /**
     * scafold
     * 
     * gera as models com base no banco de dados
     *
     * @return void
     */
    public function scafold( $crud = false ) {

        // pega todas as tabelas do banco
        $tables = $this->db->list_tables();
        cmdLine( 'Iniciando scafold da aplicacao ...' );
        
        // percorre as tabelas
        foreach ( $tables as $table ) {
            
            // verifica se é uma excessao
            if ( in_array( $table, $this->exceptions ) ) continue;

            // model name
            $model_name = lcfirst( $table );

            // cria a model para a tabela
            $schema = $this->table( $table );
            $this->model( $model_name.':'.$table, $schema );
            $this->finder( $model_name );
            
            // verifica se deve gerar com crud
            if ( $crud ) $this->controller( 'web:'.$model_name, $model_name );
        }
    }

    /**
     * library
     * 
     * cria uma nova library
     *
     * @param boolean $name
     * @return void
     */
    public function library( $name = false ) {
         
        // se não existir um nome
        if (!$name) return cmdLine( 'Voce deve informar o nome da library' );

        // seta o nome
        $name = ucfirst( $name );

        // verifica se a página já existe
        if ( file_exists( "application/libraries/$name.php" ) ) {
            return cmdLine( "Library $name foi criada com sucesso!" );
        }

        // seta as variaveis do template
        $t_vars = [ '%_LIBRARY_NAME_%' ];

        // seta as variaveis com valor
        $t_val = [ $name ];

        // pega o conteudo
        $record = file_get_contents( "application/core/templates/default_library.txt" );
        
        // subistiui os valores
        $record = str_replace( $t_vars, $t_val, $record );

        // salva no novo arquivo
        file_force_contents( "application/libraries/$name.php", $record );

        // imprime a mensagem
        cmdLine( "Library $name criada com sucesso!" );
    }

    /**
     * seed
     * 
     * cria uma seed
     *
     * @param boolean $name
     * @return void
     */
    public function seed( $name = false ) {
        
       // se não existir um nome
       if (!$name) {
           print 'Você deve informar um nome ....';
           return;
       }

       // seta o nome
       $name = ucfirst( $name );
       $name .= 'Seed';

       // verifica se a página já existe
       if ( file_exists( "application/seeds/$name.php" ) ) {
           print "A seed já existe ".PHP_EOL;
           return;
       }

       // seta as variaveis do template
       $t_vars = [ '%_LIBRARY_NAME_%' ];

       // seta as variaveis com valor
       $t_val = [ $name ];

       // pega o conteudo
       $record = file_get_contents( "application/core/templates/default_seed.txt" );
       
       // subistiui os valores
       $record = str_replace( $t_vars, $t_val, $record );

       // salva no novo arquivo
       file_force_contents( "application/seeds/$name.php", $record );

       // imprime a mensagem
       print "Seed criada com sucesso".PHP_EOL;
   }

    /**
     * controller
     * 
     * cria um novo controller
     *
     * @param boolean $name
     * @return void
     */
    public function controller( $name = false, $model = false ) {

       // se não existir um nome
       if (!$name) return cmdLine( 'Voce deve informar o nome do controller!' );

       // paths permitidos
       $paths = [ 'api', 'web' ];

       // separa os nomes
       $path = explode( ':', $name )[0];

       // verifica se é permitidos
       if ( !in_array( $path, $paths ) ) {
        cmdLine( 'Caminho não permitido!' );
        return;
       }

       // seta o nome
       $name = explode( ':', $name )[1];

       // seta o nome
       $name = ucfirst( $name );

       // verifica se a página já existe
       if ( file_exists( "application/controllers/$path/$name.php" ) ) {
           return cmdLine( "O controller $name já existe!" );
       }

       // seta as variaveis do template
       $t_vars = [ '%_CONTROLLER_NAME_%' ];

       // seta as variaveis com valor
       $t_val = [ $name ];

       // caminho do template;
       $t_path = "application/core/templates/default_controller.txt";

       // verifica se é de crud
       if ( $model ) {
            
            // carrega a library de migração
            $this->load->library( 'migration' );
            $schema = $this->migration->_getNewSchema( [ $model ] );
            $schema = isset( $schema[$model] ) ? $schema[$model] : [];
            $schema =  $this->__getForm( $schema );

            // Seta as regras
            $rules = [];
            foreach( $schema as $item ) {
                $rules[] = [
                    'field' => $item['name'],
                    'label' => $item['label'],
                    'rules' => $item['rules']
                ];
            }
            
            // seta as variaveis
            $t_vars[] = '%_MODEL_FILE_%';
            $t_vars[] = '%_MODEL_CLASS_%';
            $t_vars[] = '%_FORM_RULES_%';

            // seta os valores
            $t_val[] = $model;
            $t_val[] = ucfirst( $model );
            $t_val[] = var_export( $rules, true );

            // define o novo template
            $t_path = "application/core/templates/default_crud_controller.txt";
       }

       // pega o conteudo
       $record = file_get_contents( $t_path );
       
       // subistiui os valores
       $record = str_replace( $t_vars, $t_val, $record );

       // salva no novo arquivo
       file_force_contents( "application/controllers/$path/$name.php", $record );

       // imprime a mensagem
       print "Controller criado com sucesso".PHP_EOL;
    }

    /**
     * populate
     * 
     * popula uma tabela de acordo com a seed especificada
     *
     * @param boolean $seed
     * @return void
     */
    public function populate( $seed = false ) {

        // verifica se existe um seeder
        if ( $seed ) {

            // seta o nome da seed
            $name = ucfirst( $seed ).'Seed';

            // verifica se existe
            if ( file_exists( 'application/seeds/'.$name.'.php' ) ) {
            
                // carrega a librayr
                $this->load->library( '../seeds/'.$name );

                // seta o nome
                $n = strtolower( $name );

                // chama o método
                $this->$n->populate();

            } else {
                print "A seed $name não existe".PHP_EOL;
            }

        } else {

            // carrega a library
            $this->load->library( '../seeds/DefaultSeed' );
            $this->defaultseed->populate();
        }
    }

    /**
     * crud
     * 
     * gera os controllers de crud
     *
     * @param [type] $name
     * @return void
     */
    public function crud( $name ) {
        $this->dao( $name );
        $this->controller( 'web:'.$name, $name );
    }
}

// End of file
