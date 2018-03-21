<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

/**
* SG_Email
*
* Cuida do envio de emails
*
*/
class SG_Email extends PHPMailer {

    // instancia do ci
    public $ci;

    // email que enviou
    public $emailEnvio;

    // usuario que enviou
    public $usuarioEnvio;

    // assunto do email
    public $assunto;

    // para quem será enviado
    public $para;

    // nome de quem receberá o email
    public $paraNome;

    // seta o kind
    public $kind = [];

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {

        // pega a instancia do codeigniter
        $this->ci =& get_instance();

        // parametriza o phpmailer
        $this->From     = settings( 'SMTP_FROM' );
        $this->Sender   = settings( 'SMTP_FROM' );
        $this->FromName = settings( 'SMTP_FROM_NAME' );
        $this->Port     = settings( 'SMTP_PORT' );
        parent::SetLanguage("br");
        $this->CharSet = 'UTF-8';
        
        // verifica se deve adicionar o replyTo
        $this->AddReplyTo( settings( 'SMTP_FROM' ), settings( 'SMTP_FROM_NAME' ) );

        // seta as opções de SMTP
        parent::IsSMTP( true );
        parent::IsHTML( true );
        $this->SMTPAuth = true;
        $this->Host     = settings( 'SMTP_HOST' );
        $this->Username = settings( 'SMTP_USER' );
        $this->Password = settings( 'SMTP_PASSWORD' );
    }

   /**
    * subject
    *
    * seta o assunto do email
    *
    */
    public function subject( $sub = '' ) {

        // seta o assunto
        $this->Subject = $sub;

        // chama a funcao pai
        return $this;
    }

   /**
    * to
    *
    * seta o usuário destinatário
    *
    */
    public function to( $email = '', $name = '' ) {

        // seta o to
        $this->para     = $email;
        $this->paraNome = $name;

        // volta a instancia
        return $this;
    }

   /**
    * send
    *
    * envia o email
    *
    */
    public function send( $auto_clear = true ) {

        // prepara os dados para salvar no banco
        $dados = [
            'Para'         => $this->para,
            'EmailEnvio'   => $this->From,
            'UsuarioEnvio' => $this->FromName,
            'Corpo'        => $this->Body,
            'Assunto'      => $this->Subject,
            'Data'         => date( 'Y-m-d H:i:s', time() ),
            'host' => $this->Host,
            'password' => $this->Password,
            'user' => $this->Username,
            'from' => $this->From
        ];

        // seta para quem será enviado
        parent::AddAddress( $this->para, $this->paraNome );

        // seta o status
        $status = parent::Send();

        // limpa os destinatários
        parent::ClearAddresses();

        // seta o status do envio
        $dados['Status'] = $status ? 'S' : 'N';

        // volta o status
        return $status;
    }

   /**
    * message
    *
    * seta o corpo da mensagem
    *
    */
    public function message( $corpo ) {
        
        // seta o corpo
        $this->Body = $corpo;
        
        // volta a instancia
        return $this;
    }

    /**
     * render
     * 
     * renderiza o template
     *
     * @param string $template
     * @param [type] $data
     * @return void
     */
    public function render( string $template, $data ) {

        // seta o corpo
        $this->Body = $this->ci->view->html( 'emails/'.$template, $data );

        // volta a instancia
        return $this;
    }

    /**
     * parse
     * 
     * Pega o corpo do email das configurações
     *
     * @param string $template
     * @param array $data
     * @return void
     */
    public function parse( string $template, array $data = [] ) {

        // Carraga o corpo
        $body = $this->ci->settings->get( $template );

        // Percorre os dados
        foreach( $data as $key => $item ) {
            $body = str_replace( $key, $item, $body );
        }

        // Seta o corpo
        $this->Body = $body;

        // Volta a instancia
        return $this;
    }

   /**
    * set_mailtype
    *
    * seta o corpo da mensagem
    *
    */
    public function set_mailtype( $type ) {
        return $this;
    }
}

// End of file