<?php

/**
 * Description of Advogado
 *
 * @author oab
 */
class Advogado extends Pessoa {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function store() {
		
        $this->pessoa_tipo = parent::ADVOGADO;
        $this->ramo = $this->data['ramo'];
        $this->cpf = $this->data['cpf'];
        $this->inscricao_oab = $this->data['inscricao_oab'];
        $this->data_nasc = $this->data['data_nasc'];
      
        $_curr['area_atuacao'] = $this->data['ramo'];
        $_curr['tempo_inscricao'] = $this->data['tempo_inscricao'];
        $_curr['info_adicionais'] = $this->data['info_adicionais'];
        $_curr['formacao_academica'] = $this->data['formacao_academica'];
        $_curr['local_atuacao'] = $this->data['local_atuacao'];
        $_curr['exp_adicionais'] = $this->data['exp_adicionais'];

        unset($this->data['formacao_academica'], $this->data['info_adicionais'], $this->data['tempo_inscricao'], $this->data['area_atuacao'], $this->data['local_atuacao'],$this->data['exp_adicionais']);
     
		if(SessionRegistry::getValue('error'))
		{
			return false;
		}
		
        if(parent::store()) {

            $advogado = $this->finder()->find(array(
                'entity' => array('Pessoa'),
                'attributes' => array('id'),
                'order' => array('id' => 'desc'),
                'limit' => array(1))
            );

            $curriculo = new Curriculo;
            $curriculo->area_atuacao = $_curr['area_atuacao'];
            $curriculo->tempo_inscricao = $_curr['tempo_inscricao'];
            $curriculo->info_adicionais = $_curr['info_adicionais'] ;
            $curriculo->formacao_academica = $_curr['formacao_academica'] ;
            $curriculo->local_atuacao = $_curr['local_atuacao'] ;
            $curriculo->exp_adicionais = $_curr['exp_adicionais'] ;
            $curriculo->pessoa_id = "{$advogado[0]->id}";
            $curriculo->status = "1";	
			$curriculo->datecreated = date("Y-m-d H:i:s");
			$curriculo->dateupdated = date("Y-m-d H:i:s");
			
            return ($curriculo->store()) ? true : false; 
        } else {
            return false;
        }
    }
	
	public function update() {
		    
			$this->pessoa_tipo = parent::ADVOGADO;
			$this->id = $this->data['id'];
			$this->ramo = $this->data['ramo'];
			$this->data_nasc = $this->data['data_nasc'];
			if(SessionRegistry::getValue('error'))
			{
				return false;
			}
			
			return (parent::update())? true : false;
    }
	
    public function set_ramo($ramo) {
        if ($ramo != '') {
            $this->data['ramo'] = $ramo;
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar a ramo de atuação do advogado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
    public function set_cpf($cpf) {
        if ($cpf != '') {
			
			$advogado = $this->finder()->find(array('entity' => array('Advogado'),
                'attributes' => array('id'),
                'where' => array('cpf', 'like', ':cpf', "'%" . $cpf . "%'"),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
            ));
			
			if($advogado[0] instanceOf Advogado && $advogado[0]->id != '')
			{
				$this->data['cpf'] = $cpf;
			}
			else{
				$this->errors->errorOAB = 'Advogado não econtrado na nossa base de dados';
				SessionRegistry::setObject('error', $this->errors);
			}
			
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar cpf do Advogado';
            SessionRegistry::setObject('error', $this->errors);
        }
    }

    public function set_data_nasc($data_nasc) {
        if ($data_nasc != '') {
            $this->data['data_nasc'] = implode("-", array_reverse(explode("/", $data_nasc)));
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar data de nascimento';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
	public function cancelar(){
		
		$_user = $this->Usuario->finder()->find(array('entity' => array(null),
                'attributes' => array('id'),
                'where' => array('usuarios.user_fk_id', '=', ':user_fk_id', $this->data['id']),
                'order' => array('id' => 'desc'),
                'limit' => array(1)
        ));
		
		$this->Usuario->id = $_user[0]->id;
		$this->Usuario->status = '0';
		return ($this->Usuario->update()) ? true : false;
	}
}