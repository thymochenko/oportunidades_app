<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author oab
 */
class Pessoa extends Model {
    //put your code here

    CONST EMPRESA = '1';
    CONST ADVOGADO = '2';
    CONST CANDIDATO = '3';
	CONST ESTAGIARIO = '4';

    protected $Usuario;
    protected $errors;

    public function __construct() {
        $this->Usuario = new Usuarios;
        $this->errors = new stdClass;
    }
	
	public function __set($prop, $value){
		if($_POST){
			parent::__set($prop,$value);
		}
		else{
			$this->data[$prop] = $value;
		}
	}
	
    public function store() {
		$this->senha = $this->data['senha'];
        $this->senha_confirm = $this->data['senha_confirm'];
        $this->nome = $this->data['nome'];
        $this->email = $this->data['email'];
        $this->telefone = $this->data['telefone'];
        $this->cep = $this->data['cep'];
        $this->data['cidade_id'] = $this->data['uf'];
        $this->data['estado_id'] = $this->data['estado'];
        $this->cidade_id = $this->data['cidade_id'];
        $this->estado_id = $this->data['estado_id'];
        $this->nomeLogradouro = $this->data['nomeLogradouro'];
        $this->tipoLogradouro = $this->data['tipoLogradouro'];
        $this->bairro = $this->data['bairro'];

        unset($this->data['estado'], $this->data['uf'], $this->data['senha_confirm'], $this->data['enviar'], $this->data['insert']);
		
        if (SessionRegistry::getValue('error')) {
            return false;
        }
        //senha não é persistido na classe Pessoa
        $senha = $this->data['senha'];
        unset($this->data['senha']);
		
        $email = $this->Usuario->finder()->find(array(
            'entity' => array(null),
            'attributes' => array('id'),
			'where'=>array('emailaddress', '=', ':email', $this->data['email']),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );
		
		if($email){
            $this->errors->errorEmailVerify = 'Email já cadastrado';
            SessionRegistry::setObject('error', $this->errors);
			
			return false;
		}
		
        if (!parent::store()) {
            return false;
        }

        $pessoa = $this->finder()->find(array(
            'entity' => array('Pessoa'),
            'attributes' => array('id'),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );
		
        $this->Usuario->username = $this->data['email'];
        $this->Usuario->password = crypt($senha);
        $this->Usuario->emailaddress = $this->data['email'];

        if (get_class($this) == 'Empresa') {
            $this->Usuario->user_type = '1';
        } elseif (get_class($this) == 'Advogado') {
            $this->Usuario->user_type = '2';
        } elseif (get_class($this) == 'Candidato') {
            $this->Usuario->user_type = '3';
        } elseif (get_class($this) == 'Estagiario') {
            $this->Usuario->user_type = '4';
        }
        $this->Usuario->user_fk_id = $pessoa[0]->id;
        $this->Usuario->status = '1';
		
		if($this->Usuario->isSetAvatar()){
			$this->Usuario->user_img = md5($_FILES['imagem']['name']) . '.jpg';
			$this->Usuario->user_thumb = '_thumb_' . md5($_FILES['imagem']['name']) . '.jpg';
			
			$image = new ImageManager($filekey = 'imagem', null, $directory = 'files');
			$image->processUpload()
                ->createImage(420, 330, $this->Usuario->user_img)
                ->createImage(150, 150, $this->Usuario->user_thumb);
		}
		else{
			$this->errors->errorImagem = 'Imagem é um campo Obrigatório';
            SessionRegistry::setObject('error', $this->errors);
			return false;
		}
		
        $this->Usuario->descricao = $this->data['nome'];
        $this->Usuario->datecreated = date("Y-m-d H:i:s");
        $this->Usuario->dateupdated = date("Y-m-d H:i:s");
		
        if ($this->Usuario->store()) {
            return true;
        }
    }
	
	public function modelUpdate(){
		parent::update();
	}
	
	public function update() {

        $this->senha = $this->data['senha'];
        $this->senha_confirm = $this->data['senha_confirm'];
        $this->nome = $this->data['nome'];
        $this->email = $this->data['email'];
        $this->telefone = $this->data['telefone'];
        $this->cep = $this->data['cep'];
        $this->data['cidade_id'] = $this->data['uf'];
        $this->data['estado_id'] = $this->data['estado'];
        $this->cidade_id = $this->data['cidade_id'];
        $this->estado_id = $this->data['estado_id'];
        $this->nomeLogradouro = $this->data['nomeLogradouro'];
        $this->tipoLogradouro = $this->data['tipoLogradouro'];
        $this->bairro = $this->data['bairro'];
        $this->data_nasc = $this->data['data_nasc'];
		
        unset($this->data['estado'], $this->data['uf'], $this->data['senha_confirm'], $this->data['enviar'], $this->data['update']);

        if (SessionRegistry::getValue('error')) {
            SessionRegistry::freeSession();
            return false;
        }
        //senha não é persistido na classe Pessoa
        $senha = $this->data['senha'];
        unset($this->data['senha']);

        if (!parent::update()) {
            return false;
        }

        $user = $this->finder()->find(array(
            'entity' => array('Usuarios'),
            'attributes' => array('id'),
			'where'=>array('usuarios.user_fk_id','=',':id',$this->id), 
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );
		
		$this->Usuario->id = $user[0]->id;
        $this->Usuario->username = $this->data['email'];
        $this->Usuario->password = crypt($senha);
        $this->Usuario->emailaddress = $this->data['email'];
		
        if (get_class($this) == 'Empresa') {
            $this->Usuario->user_type = '1';
        } elseif (get_class($this) == 'Advogado') {
            $this->Usuario->user_type = '2';
        } elseif (get_class($this) == 'Candidato') {
            $this->Usuario->user_type = '3';
        } elseif (get_class($this) == 'Estagiario') {
            $this->Usuario->user_type = '4';
        }
		
        $this->Usuario->user_fk_id = $this->id;
        $this->Usuario->status = '1';
        if($this->Usuario->isSetAvatar()){
			$this->Usuario->user_img = md5($_FILES['imagem']['name']) . '.jpg';
			$this->Usuario->user_thumb = '_thumb_' . md5($_FILES['imagem']['name']) . '.jpg';
			
			$image = new ImageManager($filekey = 'imagem', null, $directory = 'files');
			$image->processUpload()
                ->createImage(420, 330, $this->Usuario->user_img)
                ->createImage(150, 150, $this->Usuario->user_thumb);
		}
		else{
			$this->errors->errorImagem = 'Imagem é um campo Obrigatório';
            SessionRegistry::setObject('error', $this->errors);
			return false;
		}
		$this->Usuario->descricao = $this->data['nome'];
        $this->Usuario->datecreated = date("Y-m-d H:i:s");
        $this->Usuario->dateupdated = date("Y-m-d H:i:s");

        if ($this->Usuario->update()) {
            return true;
        }
    }
	
    public function set_nome($nome) {

        if ($nome && $nome != '' && is_string($nome)) {
            $this->nome = $nome;
        } else {
            $this->errors->errorNome = 'Erro ao cadastrar um nome';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
    public function set_email($email) {
        if ($email != '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            $this->errors->errorEmail = 'Email informado inválido';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_telefone($telefone) {
        //$telefone = "(014) 3236-3810";
		
        if (is_string($telefone)) {
            $this->telefone = $telefone;
        } else {
            $this->errors->errorTelefone = 'O Campo Telefone deve ser informado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_logomarca($logomarca) {
        if (is_string($logomarca) && $logomarca != '') {
            $this->logomarca = $logomarca;
        } else {
            $this->errors->errorLogomarca = 'Uma logomarca deve ser enviada';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_senha($senha) {
        if (is_string($senha) && $senha != '' && strlen($senha) <= 8) {
            $this->senha = $senha;
        } else {
            $this->errors->errorSenha = 'Você deve prencher o campo senha,
                com até 8 caracteres';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_cep($cep) {
        if ($cep != '' && strlen($cep) == 9 && @eregi("^[0-9]{5}-[0-9]{3}$", $cep)) {
            $this->cep = $cep;
        } else {
            $this->errors->errorCep = 'O CEP Informado é inválido';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_cidade_id($uf) {
        if ($uf != '') {

            $expression = array('entity' => array('Cidades'),
                'attributes' => array('id'),
                'where' => array('nome', 'like', ':nome', "'%" . trim($uf) . "%'"),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
            );

            $_cidade = $this->finder()->find($expression);

            $this->cidade_id = "{$_cidade[0]->id}";
        } else {
            $this->errors->errorCep = 'Erro ao cadastrar cidade';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_estado_id($estado) {
        if ($estado != '') {
            $expression = array('entity' => array('Estados'),
                'attributes' => array('id'),
                'where' => array('sigla', 'like', ':sigla', "'%" . trim($estado) . "%'"),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
            );

            $_estado = $this->finder()->find($expression);
            $this->estado_id = "{$_estado[0]->id}";
        } else {
            $this->errors->errorCep = 'Erro ao cadastrar Estado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_nomeLogradouro($nomeLogradouro) {
        if ($nomeLogradouro != '') {
            $this->nomeLogradouro = $nomeLogradouro;
        } else {
            $this->errors->errorCep = 'O Logradouro deve ser Informado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_tipoLogradouro($tipoLogradouro) {
        if ($tipoLogradouro != '') {
            $this->tipoLogradouro = $tipoLogradouro;
        } else {
            $this->errors->errorCep = 'O tipo do Logradouro deve ser Informado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_bairro($bairro) {
        if ($bairro != '') {
            $this->bairro = $bairro;
        } else {
            $this->errors->errorCep = 'O Bairro deve ser Informado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_senha_confirm($senha_confirm) {
        if ($senha_confirm == $this->data['senha']) {
            return true;
        } else {
            $this->errors->errorCep = 'A senha informada não corresponde';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
	
}