<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model_alter
 * 
 * Faz as alterações na model
 * 
 */
class Model_alter extends CI_Model {

    /**
     * id
     * 
     * id do registro
     * 
     */
    public $id = null;

    /**
     * timestamps
     * 
     * se deve usar o timestamps ou não
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * fields
     *
     * campos da model
     * 
     * @var array
     */
    public $fields = [];

    /**
     * entity
     *
     * entidade da tabela
     * 
     * @var string
     */
    public $entity = '';

    /**
     * __construct
     * 
     * Método construtor
     * 
     */
    public function __construct() {
        parent::__construct();

        // adiciona os campos
        foreach( $this->fields as $attr => $field ) $this->$attr = null; 
    }

    /**
     * registerLog
     * 
     * Registra o log
     *
     * @param [type] $action
     * @param [type] $text
     * @param string $color
     * @return void
     */
    public function registerLog( $params ) {

        // Verifica se a tabela é diferente da tabela de log
        if ( strtolower( $this->table() ) !== 'log' ) {

            // Carrega a model de log
            $logModel = model( 'log' );

            // Seta o usuário
            $params['user_id'] = auth() ? auth()->id : null;

            // Seta os atributos
            $log = $logModel->new();
            $log->fill( $params )->save();
        } else return false;
    }

    /**
     * hooks
     *
     * volta os hooks
     * 
     * @return array
     */
    public function hooks() {
        return [];
    }

    /**
     * load
     * 
     * carrega dados de um array 
     * em forma de objeto da model
     *
     * @param array $data
     * @return $this
     */
    public function load( array $data = [] ) {

        // verifica se é um array
        if ( !is_array( $data ) ) return [];
        
        // verifica a profundidade do array
        if ( array_depth( $data ) == 1 ) {
            
            // percorre os dados
            foreach( $data as $key => $value ) $this->$key = $value;
        }
        
        // volta a instancia
        return $this;
    }

    /**
     * useHook
     *
     * utiliza um hook
     * 
     * @param [type] $hook
     * @param array $params
     * @return void
     */
    public function useHook( $hook, $params = [] ) {

        // pega os hooks
        $hooks = $this->hooks();
        
        // verifica se existe o hook passado
        if ( isset( $hooks[$hook] ) ) {
            $method = $hooks[$hook];

            // verifica se é um array
            if ( is_array( $method ) ) {

                // percorre todos os métodos
                foreach( $method as $item ) $this->$item( $params );
            } else $this->$method( $params );            
        }
    }

    /**
     * serialize
     * 
     * volta os dados da classe em um array
     * para ser inserido no banco de dados
     *
     * @return void
     */
    public function serialize() {

        // os dados a serem inseridos
        $insertData = [];

        // prepara os dados para a operacao
        foreach( $this->fields as $field => $onTable ) $insertData[$onTable] = $this->$field;

        // volta os dados
        return $insertData;
    }

    /**
     * save
     *
     * salva os dados alterados
     * 
     * @return void
     */
    public function save() {

        // verifica o hook a ser chamado
        if ( $this->id ): 
            $this->useHook( 'beforeUpdate', $this );
        else:
            $this->useHook( 'beforeInsert', $this );
        endif;

        // pega os dados
        $insertData = $this->serialize();
        $jsonString = safe_json_encode( $insertData );

        // verifica se é um update
        if ( $this->id ) {

            // verifica se deve usar os timestamps
            if ( $this->timestamps ) $insertData['updated_at'] = date( 'Y-m-d H:i:s', time() );

            // faz o update
            $this->db->where( 'id', $this->id );
            $result = $this->db->update( $this->table(), $insertData );

            // verifica se conseguiu fazer o update
            if ( $result ) {

                // Registra o log
                $this->registerLog([
                    'color'  => 'success',
                    'action' => 'ATUALIZOU '.strtoupper( $this->table() ),
                    'text'   => 'O registro de ID '.$this->id.' foi atualizado',
                    'json'   => $jsonString
                ]);

                // atualiza o update
                $this->updated_at = $insertData['updated_at'];

                // usa o hook
                $this->useHook( 'afterUpdate', $this );
                return true;
            } else return false;
        } else {

            // verifica os timestamps
            if ( $this->timestamps ) $insertData['created_at'] = date( 'Y-m-d H:i:s', time() );            

            // faz a inserção
            $result = $this->db->insert( $this->table(), $insertData );
            
            // verifica se conseguiu inserir
            if ( $result ) {

                // seta o id
                $this->id = $this->db->insert_id();

                // Registra o log
                $this->registerLog([
                    'color'  => 'primary',
                    'action' => 'CRIOU '.strtoupper( $this->table() ),
                    'text'   => 'O registro de ID '.$this->id.' foi criado',
                    'json'   => $jsonString
                ]);

                // atualiza o update
                $this->created_at = $insertData['created_at'];
                
                // utiliza o hook
                $this->useHook( 'afterInsert', $this );
                return true;
            } else return false;
        }
    }

    /**
     * delete
     * 
     * exclui um registro
     *
     * @return void
     */
    public function delete() {

        // verifica se existe um id
        if ( $this->id ) {
            
            // executa o hook
            $this->useHook( 'beforeDelete', null );

            // pega os dados
            $deleteData = $this->serialize();
            $jsonString = safe_json_encode( $deleteData );

            // exclui o item
            $result = $this->db->delete( $this->table(), [ 'id' => $this->id ] );

            // verifica o resultado
            if ( $result ) {
                
                // Grava o hook
                // Registra o log
                $this->registerLog([
                    'color'  => 'danger',
                    'action' => 'DELETOU '.strtoupper( $this->table() ),
                    'text'   => 'O registro de ID '.$this->id.' foi excluido',
                    'json'   => $jsonString
                ]);

                // Seta o hook
                $this->useHook( 'afterDelete', $this->id );
            }

            // Verifica o que deve ser retornado
            return $result ? true : false;

        } else return false;
    }

    /**
     * new
     * 
     * volta um novo usuario
     *
     * @return void
     */
    public function new() {
        $instance = $this->entity();
        return new $instance;
    }

    /**
     * entity
     * 
     * entidade
     *
     * @return void
     */
    public function entity() {
        return $this->entity;
    }

    /**
     * table
     *
     * pega a tabela da model
     * 
     * @return void
     */
    public function table() {
        return strtolower( str_replace( '_model', '', get_class() ) );
    }

    /**
     * fill
     *
     * preenche os dados da tabela
     * 
     * @param array $data
     * @return void
     */
    public function fill( $data = [] ) {

        // percorre os campos
        foreach( $this->fields as $classField => $tableField ) {

            // check if $classField existes
            if ( isset( $data[$classField ] ) ) {

                // adiciona a classe
                $this->$classField = $data[$classField];
                $this->$classField = empty( $data[$classField] ) ? null : $data[$classField];

            } else if ( isset( $data[$tableField ] ) ) {
                
                // adiciona a classe
                $this->$classField = $data[$tableField];
                $this->$classField = empty( $data[$tableField] ) ? null : $data[$tableField];                
            }
        }

        // verifica se tem um id
        if ( isset( $data['id'] ) ) $this->id = $data['id'];

        // volta a instancia
        return $this;
    }

    /**
     * permissions
     * 
     * Permissoes de alteracoes na model
     * 
     */
    public function permissions() {
        return [];
    }

    /**
     * authorize
     * 
     * Verifica se um usuário tem permissão para realizar
     * uma ação especifica na model
     * 
     */
    public function authorize( $action = 'any' ) {

        // Obtem as permissoes
        $permissions = $this->permissions();
        $canAccess   = false;

        // Verifica se exis a ação
        if ( !isset( $permissions[$action] ) ) return false;

        // Pega os grupos
        $groups = $permissions[$action];

        // Percorre todas as ações
        foreach( $groups as $group ) {

            // Verifica se esta livre para usuário não logados
            if ( $group === 'unlogged' && !auth() ) return true;
            
            // Verifica se esta livre para usuario logados
            if ( $group === 'logged' && auth() ) return true;

            // Verifica se esta livre para qualquer grupo
            if ( $group === 'any' ) return true;
            
            // Verifica se o usuário esta no grupo
            if ( inGroup( $group ) ) return true;
        }

        // Volta false por padrão
        return false;
    }
}

// End of file