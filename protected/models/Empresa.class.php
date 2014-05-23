<?php

class Empresa extends Pessoa {

    protected static $condition = array('fk.nomecurriculo' => array('curriculo as c' => 'c.pessoa_id = pessoa.id'),
		'fk.usuario'=>array('usuarios as u'=> 'u.user_fk_id = pessoa.id')
	);
    
    public function __construct(){
        parent::__construct();
    }
    
    public function store() {
        $this->pessoa_tipo = parent::EMPRESA;
        $this->ramo = $this->data['ramo'];
        $this->cnpj = $this->data['cnpj'];
        unset($this->data['enviar'], $this->data['insert']);
        if(parent::store()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function set_ramo($ramo) {
        if ($ramo != '') {
            $this->data['ramo'] = $ramo;
        } else {
            $this->errors->errorRamo = 'Erro ao cadastrar a atividade da empresa';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
	 public function set_data_nasc($data_nasc) {
        if ($data_nasc != '') {
            $this->data['data_nasc'] = $data_nasc;
        } else {
			$this->data['data_nasc'] = ' ';
        }
    }

    public function set_cnpj($cnpj) {
        if ($cnpj != '' && strlen($cnpj) == 18 && Validations::isCnpjValid($cnpj) == true) {
            $this->data['cnpj'] = $cnpj;
        } else {

            $this->errors->errorCnpj = 'Cnpj Inválido';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
    
	public function update() {
			
			$this->pessoa_tipo = parent::EMPRESA;
			$this->id = $this->data['id'];
			$this->ramo = $this->data['ramo'];

			unset($this->data['enviar'], $this->data['update']);
			
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
	
    /*
     * metodo contexto area administratica empresa
    */
    public function findPessoasECurriculos(){
        $criteria = new Criteria;
        $criteria->addJoin(self::$condition['fk.usuario']);
		$criteria->add(new Filter('pessoa.pessoa_tipo','>',':pessoa_tipo', parent::EMPRESA));
		$criteria->add(new Filter('u.status','=',':status', Usuarios::ATIVO));
		$criteria->setProperty('limit',500);
		$criteria->setProperty('order','pessoa.id asc');
		
		$repository = new Repository('pessoa');        
        $collection = $repository->load($criteria, array(
			'pessoa.nome as pnome',
			'pessoa.id',
			'pessoa.ramo',
			'u.user_thumb as thumb',
			'u.id as uid'
		));
		
		if($collection){
			return $collection;
		}
    }   
}