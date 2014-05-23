<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estagiaio
 *
 * @author oab
 */
class Estagiario extends Pessoa {

    //put your code here
    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function store() {
        $this->pessoa_tipo = parent::ESTAGIARIO;
        $this->cpf = $this->data['cpf'];
        $this->data_nasc = $this->data['data_nasc'];
		$this->ramo = $this->data['ramo'];
		//curriculo
		$_curr['area_atuacao'] = $this->data['ramo'];
        $_curr['info_adicionais'] = $this->data['info_adicionais'];
        $_curr['formacao_academica'] = $this->data['formacao_academica'];
        $_curr['exp_adicionais'] = $this->data['exp_adicionais'];

        unset($this->data['formacao_academica'], $this->data['info_adicionais'], $this->data['exp_adicionais']);
        
        if (parent::store()) {
            $candidato = $this->finder()->find(array(
                'entity' => array('Pessoa'),
                'attributes' => array('id'),
                'order' => array('id' => 'desc'),
                'limit' => array(1))
            );
			
            $curriculo = new Curriculo;
            $curriculo->info_adicionais = $_curr['info_adicionais'];
            $curriculo->formacao_academica = $_curr['formacao_academica'];
            $curriculo->exp_adicionais = $_curr['exp_adicionais'];
            $curriculo->pessoa_id = "{$candidato[0]->id}";

            if ($curriculo->store()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	public function update() {	
		$this->pessoa_tipo = parent::ESTAGIARIO;
		$this->id = $this->data['id'];
		$this->ramo = $this->data['ramo'];
		$this->data_nasc = $this->data['data_nasc'];
			
		if(SessionRegistry::getValue('error'))
		{
			return false;
		}
			
		return (parent::update())? true : false;
    }
	
	
    public function set_cpf($cpf) {
        if ($cpf != '') {
			
			$estagiario = $this->finder()->find(array('entity' => array('Advogado'),
                'attributes' => array('id'),
                'where' => array('cpf', 'like', ':cpf', "'%" . $cpf . "%'"),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
            ));
			
			if(isset($estagiario[0]) && $estagiario[0]->id != '')
			{
				$this->data['cpf'] = $cpf;
			}
			else{
				$this->errors->errorOAB = 'Advogado não econtrado na nossa base de dados';
				SessionRegistry::setObject('error', $this->errors);
			}
			
        } else {
            $this->errors->errorCpf = 'Erro ao cadastrar cpf do Advogado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_ramo($ramo) {
        if ($ramo != '') {
            $this->data['ramo'] = $ramo;
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar a ramo de atuação do advogado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
    public function set_data_nasc($data_nasc) {

        if ($data_nasc != '') {
            $this->data['data_nasc'] = implode("-", array_reverse(explode("/", $data_nasc)));
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar data de nascimento do Candidato';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
	
	public function cancelar(){
		
		$_user = $this->Usuario->finder()->find(array('entity' => array(null),
                'attributes' => array('id'),
                'where' => array('usuarios.id', '=', ':id', $this->data['id']),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
        ));
		
		$this->Usuario->id = $_user[0]->id;
		$this->Usuario->status = '0';
		return ($this->Usuario->update()) ? true : false;
	}
}