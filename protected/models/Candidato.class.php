<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Candidato
 *
 * @author oab
 */
class Candidato extends Pessoa {

    //put your code here
    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function store() {
        $this->pessoa_tipo = parent::CANDIDATO;
        $this->cpf = $this->data['cpf'];
        $this->data_nasc = $this->data['data_nasc'];
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
    
    public function set_cpf($cpf) {
        if ($cpf != '') {
			
		$candidato = $this->finder()->find(array('entity' => array('Pessoa'),
                'attributes' => array('id'),
                'where' => array('cpf', '=', ':cpf', "'%" . $cpf . "%'"),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
            ));
		
			if(!$candidato[0]){
				$this->data['cpf'] = $cpf;
			}
			else{
				$this->errors->errorOAB = 'Candidato já candastrado na nossa base de dados';
				SessionRegistry::setObject('error', $this->errors);
			}
			
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar cpf do Candidato';
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
	
	public function update() {
			
			$this->pessoa_tipo = parent::CANDIDATO;
			$this->id = $this->data['id'];
			$this->ramo = $this->data['ramo'];
			$this->data_nasc = $this->data['data_nasc'];
			
			if(SessionRegistry::getValue('error'))
			{
				return false;
			}
			
			return (parent::update())? true : false;
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
