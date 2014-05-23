<?php
class Usuarios extends Model
{
	CONST ATIVO = 1;
	CONST INATIVO = 0;
	CONST HOST='smtp.gmail.com';
	CONST USERNAME='thymochenko';
	CONST PASSWORD='silvia25';
	CONST ADDADDRESS='cpdweb@oabpiaui.org.br';
	
	public function isSetAvatar(){
		return ($_FILES['imagem']['name'])? true : false;
	}
	
	public function destroy()
	{
	}
	
	/**
	*method recoveryPass()
	*verifica se um email informado esta cadastrado, caso sim, 
	*recupera e envia para o usuário
	*@ return boolean
	*/
	public function recoveryPass(){
		if($this->emailaddress){
			include_once ConfigPath::AppCore() . '/components/phpmailer.class.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = self::HOST;
			$mail->SMTPAuth = true;   
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->Username = self::USERNAME;
			$mail->Password = self::PASSWORD;
			$mail->SetFrom($this->data['emailaddress'], 'Banco de Oportunidades - OABPI'); // De (original)
			$mail->AddReplyTo($this->data['emailaddress'], utf8_decode($this->data['emailaddress'])); // De (Responder para)
			$mail->AddAddress($this->data['emailaddress'], 'Banco de Oportunidades - OABPI'); 
			$mail->Subject = utf8_decode("OABPI - Banco de Oportunidades - Recuperação de senha"); //Assunto
			$novasenha = substr(md5($this->emailaddress), 0, 6) . rand(0,500) . rand(0,500);
			if($this->updatePass($novasenha)){
				$body = "<p><small>Data envio: ".date('d/m/Y') . "</small></p>";	
				$body .= "<b>email:</b> ".  $this->data['username'] ."<br />";
				$body .= "<b>Nova senha :</b> ". $novasenha. "<br />";
				$mail->MsgHTML($body);
			}else{
				return false;
			}
			
			return ($mail->Send()) ?  true : false;
		}
	}
	
	public function set_email($email) {
        if ($email != '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			/** @Usuarios */ $u = $this->finder()->find(array(
				'entity' => array(null),
				'attributes' => array(null),
				'where' => array('usuarios.emailaddress', '=', ':email', $email),
				'order' => array('id' => 'desc'),
				'limit' => array(1))
			);
			
			$this->data = $u[0]->toArray();
			
			return ($this->data['emailaddress']) ?  $this->data['emailaddress']  :  false;
			
        }
    }
	
	public function updatePass($pass){
		$this->id = $this->data['id'];
		$this->password = crypt($pass);

		return (parent::update()) ? true : false; 
	}
}