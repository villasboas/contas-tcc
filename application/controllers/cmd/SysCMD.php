<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SysCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class SysCMD extends CI_Controller {

    /**
     * [
     *  'cliente' => [ 
     *      'hasMany': [ 'pedido' ],
     *  ],
     *  'produto' => [
     *      'belongsToMany': [ 'pedido' ], 
     *  ],
     *  'pedido' => [
     *      'manyToMany': ['produto' ],
     *      'belongsTo' : [ 'cliente' ] 
     *  ]
     * ]
     *  
     */

    /**
     * relationsTables
     * 
     * Tabelas usadas somente para relação
     *
     * @var array
     */
    public $relationsTables = [];

    /**
     * relations
     * 
     * Relações entre tabelas
     *
     * @var array
     */
    public $relations = [];

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
     * __getRelations
     * 
     * Obtem as relations
     *
     * @param [type] $tableName
     * @param [type] $tableSchema
     * @param [type] $schema
     * @return void
     */
    public function __getRelations( $tableName, $tableSchema, $schema ) {

        // Seta a chave de referência
        $referenceKey = $tableName.'_id';

        // Relações
        $rels = [];

        // Percorre os campos dessa tabela
        foreach( $tableSchema as $name => $field ) {

            // Verifica o final
            if ( endsWith( $name, '_id' ) ) {
                $rels[$tableName]['hasOne'][] = str_replace( '_id', '', $name ); 
                $rels[str_replace( '_id', '', $name )]['hasMany'][] = $tableName; 
            }
        }
        
        // Nomes de tabelas
        $tablesNames = array_keys( $this->relationsTables );

        // Verifica relações N:M
        foreach( $schema as $tableSchemaName => $fieldName ) {
            
            // Verifica se são diferentes
            if ( $tableName !== $tableSchemaName ) {
                $rel1 = $tableName.'_'.$tableSchemaName;
                $rel2 = $tableSchemaName.'_'.$tableName;
                
                // Verifica se a tabela existe
                if ( in_array( $rel1, $tablesNames ) || in_array( $rel2, $tablesNames ) ) {
                    $rels[$tableName]['manyToMany'][] = $tableSchemaName;
                }
            }
        }

        // Volta as relações encontradas
        return count( $rels ) > 0 ? $rels : false;
    }

    /**
     * run
     * 
     * Monta as relações
     *
     * @return void
     */
    public function setJsonFile() {
        
        // carrega a library de migração
        $this->load->library( 'migration' );

        // Seta o Schema
        $schema = $this->migration->_getNewSchema();
        $rels = [];

        // Percorre as tabelas
        foreach( $schema as $tableName => $table ) {

            // Verifica se é uma tabela de relacionamento
            if ( strpos( $tableName, '_' ) !== false ) {
                $this->relationsTables[$tableName] = $table;
                unset( $schema[$tableName] );
            }
        }

        // Percorre as tabelas
        foreach( $schema as $tableName => $table ) {

            // Seta as relacoes
            if ( $rel = $this->__getRelations( $tableName, $table, $schema ) ) {
                $rels = array_merge( $rel, $rels );
            }
        }

        // Escreve o arquivo
        $str = json_encode( $rels, JSON_PRETTY_PRINT );
        file_put_contents( APPPATH.'/config/relations.json', $str );
        
        // Arquivo preenchido
        echo $str.PHP_EOL;
        echo 'Arquivo preenchido com sucesso.'.PHP_EOL;
    }
}

// End of file
