<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * DeployCMD
 * 
 * Comandos que serão rodados no CMD
 * 
 */
class DeployCMD extends CI_Controller {

    /**
     * construct
     * 
     * método constructor
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->library( 'ftp' );
    }

    /**
     * __connectFTP
     * 
     * Faz a conexão com o FTP
     *
     * @return void
     */
    private function __connectFTP() {
        
        // Carrega as configurações do FTP
        $this->config->load( 'ftp' );
        $ftpCredentials = $this->config->item( 'ftp' );
        
        // Realiza a conexão
        return $this->ftp->connect( $ftpCredentials );
    }

    /**
     * __mirror
     * 
     * Move o site para o ar
     *
     * @return void
     */
    private function __mirror() {
        cmdLine( 'Origem: '.realpath('deployed').'/' );
        cmdLine( 'Destino: '.deploy_path() );
        return $this->ftp->mirror( realpath('deployed').'/', deploy_path() );
    }

    /**
     * __setDeployFolder
     * 
     * Seta a pasta de deploy
     *
     * @return void
     */
    private function __setDeployFolder() {

        // Cria a pasta de deploy
        xremove( 'deployed' );
        mkdir( 'deployed' );

        // Move as pastas
        $deployFolder = [
            'application',
            '.htaccess',
            'index.php',
            'frontend',
            'public',
            'system',
            'vendor',
        ];

        // Copia todas as pastas de deploy
        foreach( $deployFolder as $folder ) xcopy( $folder, "deployed/$folder" );
    }

    /**
     * __deleteDeveloperFiles
     * 
     * Remove os arquivos que são utilizados especialmente
     * para o desenvolvimento
     *
     * @return void
     */
    private function __deleteDeveloperFiles( $vendorFolder ) {

        // Remove os arquivos que não devem ser subistituidos no servidor
        $toRemove = [
            'deployed/application/config/database.php',
            'deployed/application/config/config.php',
            'deployed/system'
        ];

        // Verifica se deve adicionar a pasta vendor
        if ( !$vendorFolder ) $toRemove[] = 'deployed/vendor';

        // Percorre os arquivos que devem ser deletados
        foreach( $toRemove as $removable ) {
            if ( is_file( $removable ) ) {
                unlink( $removable );
            } else xremove( $removable );
        }
    }

    /**
     * index
     * 
     * Método principal
     *
     * @return void
     */
    public function index( $firstTime = false, $vendorFolder = false ) {
        $firstTime    = $firstTime === 'false' ? false : $firstTime;
        $vendorFolder = $vendorFolder === 'false' ? false : $vendorFolder;

        // Verifica se é a primeira vez
        if ( $firstTime ) {
            cmdLine( 'Preparando para subir os arquivos no servidor pela primeira vez ...' );
        }

        // Cria a pasta de deploy
        cmdLine( 'Criando pasta de deplioy ...' );
        $this->__setDeployFolder();
        cmdLine( 'Pasta de deploy criada com sucesso!' );

        // Verifica se é a primeira vez
        if ( !$firstTime ) {
            cmdLine( 'Excluindo arquivos do desenvolvedor ...' );
            try {
                $this->__deleteDeveloperFiles( $vendorFolder );
                cmdLine( 'Arquivos do desenvolvedor excluidos com sucesso.' );
            } catch( Exception $e ) {

                // Caso exista algum erro no processo
                cmdLine( 'Erro ao excluir os arquivos do desenvolvedor.' );
                return;
            }
        }

        // Connecta com o FTP
        cmdLine( 'Conectando com o servidor FTP ...' );
        if ( $this->__connectFTP() ) {
            cmdLine( 'Conexao realizada com sucesso!' );

            // Faz o espelhamento
            cmdLine( 'Fazendo o espelhamento com o servidor ...' );
            cmdLine( '( Isso pode levar alguns minutos )' );
            $this->__mirror();
            cmdLine( 'Espelhamento feito com sucesso!' );

            // Exlui a pasta de deploy
            cmdLine( 'Removendo pasta de deploy ...' );
            try {
                xremove( 'deployed' );
                cmdLine( 'Pasta de deploy removido com sucesso!' );
            } catch( Exception $e ) {
                cmdLine( 'Erro ao remover a pasta de deploy!' );                
            }

            // Fecha a conexão
            cmdLine( 'Fechando a conexão com o servidor...' );
            $this->ftp->close();
            cmdLine( 'Conexão encerrada com sucesso!' );
        } else cmdLine( 'Erro ao conectar ao servidor' );
    }
}

// End of file
