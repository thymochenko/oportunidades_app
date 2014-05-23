<?php
include 'class.phpmailer.php';
include 'class.smtp.php';

class MailerComponent {

    CONST HOST = 'smtp.gmail.com';
    CONST USERNAME = 'thymochenko';
    CONST PASSWORD = 'silvia25';
    CONST ADDADDRESS = 'cpdweb@oabpiaui.org.br';

    //oabpi123 - email ouvidoria 
    public function __construct(array $parans) {
        $phpmail = new PHPMailer();
        $phpmail->IsSMTP(); // envia por SMTP
        //smtp.oab.com senha:123456 
        $phpmail->Host = self::HOST; // SMTP servers
        $phpmail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
        //$phpmail->SMTPDebug  = 2; // enables SMTP debug information (for testing)
        $phpmail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $phpmail->Port = 465; // set the SMTP port for the GMAIL server
        $phpmail->SetFrom('cpdweb@oabpiaui.org.br', 'OABPI'); // De (original)
        #$phpmail->AddReplyTo($email, utf8_decode($nome)); // De (Responder para)
        $phpmail->Username = self::USERNAME; // SMTP usuário
        $phpmail->Password = self::PASSWORD; // SMTP senha
        $phpmail->AddAddress(self::ADDADDRESS, 'OABPI'); // Para (VOCÊ PODE 		    		    REPETIR 		    		    		    ESTA 		    LINHA 		    SE PRECISAR INSERIR OUTRO DESTINATÁRIO.)
        //assunto
        $phpmail->Subject = utf8_decode("Mensagem - OABPI - Banco de Oportunidades - "); //Assunto
        $body = '';
        $body .= "<p><small>Data envio: " . date('d/m/Y') . "</small></p>";
        $body = '';
        $body .= "<b>Nome:</b> " . "Ola Dr(Dra): {$parans['nome']}" . "<br />";
        $body .= "<b>Email:</b> " . " {$parans['email']}" . "<br />";
        $body .= "<b>Mensagem:</b> " . " {$parans['mensagem']}" . "<br />";

        $phpmail->MsgHTML($body);
        //$phpmail->AddAttachment("images/exemplo.gif"); // Anexo (VOCÊ PODE REPETIR ESTA LINHA SE PRECISAR INSERIR OUTRO ANEXO.)
        $send = $phpmail->Send();

        if ($send) {
            echo utf8_encode("<h2>Mensagem enviada com sucesso</h2>");
        } else {
            echo utf8_encode("<h2>Não foi possível enviar a mensagem. Ouve Algum erro tente de novo e atualize a página:</h2>");
            exit;
        }
        return true;
    }

}

?>