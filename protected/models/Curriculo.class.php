<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curriculo
 *
 * @author oab
 */
class Curriculo extends Model{
    //put your code here   
	protected $errors;
	
	public function __construct(){
		$this->errors = new stdClass;
	}
	
	public function __set($prop, $value){
		if($_POST){
			parent::__set($prop,$value);
		}
		else
		{
			$this->data[$prop] = $value;
		}
	}
	
	public function destroy(){
		$this->id = $this->id;
		$this->status = '0';
		return(parent::update()) ? true : false;
	}
	
	public function set_area_atuacao($area_atuacao){
		 if ($area_atuacao != '') {
            $this->data['area_atuacao'] = $area_atuacao;
        } else {
            $this->errors->area_atuacao = 'O campo área de atuação deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
	
	public function set_tempo_inscricao($tempo_inscricao){
		 if ($tempo_inscricao != '') {
            $this->data['tempo_inscricao'] = $tempo_inscricao;
        } else {
            $this->errors->tempo_inscricao = 'O campo  tempo de inscrição deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
	
	public function set_info_adicionais($info_adicionais){
		 if ($info_adicionais != '') {
            $this->data['info_adicionais'] = $info_adicionais;
        } else {
            $this->errors->info_adicionais = 'O campo informações adicionais deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
	
	public function set_formacao_academica($formacao_academica){
		if ($formacao_academica != '') {
            $this->data['formacao_academica'] = $formacao_academica;
        } else {
            $this->errors->formacao_academica = 'O campo formação acadêmica deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
	
	public function set_local_atuacao($local_atuacao){
		 if ($local_atuacao != '') {
            $this->data['local_atuacao'] = $local_atuacao;
        } else {
            $this->errors->local_atuacao = 'O campo local de atuação deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
	
	public function exp_adicionais($exp_adicionais){
		 if ($exp_adicionais != '') {
            $this->data['exp_adicionais'] = $exp_adicionais;
        } else {
            $this->errors->exp_adicionais = 'O campo experiências adicionais deve ser preenchido ';
            SessionRegistry::setObject('error', $this->errors);
        }
	}
}