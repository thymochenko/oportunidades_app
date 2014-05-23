<?php
class Vaga extends Model {
	protected $errors;
	
	
	public function __set($prop, $value){
		if($_POST){
			parent::__set($prop,$value);
		}
		else{
			$this->data[$prop] = $value;
		}
	}
	
	public function __construct(){
		$this->errors = new stdClass;
	}
	
	public function store(){
		
		unset($this->data['insert']);
		
		$this->titulo = $this->data['titulo'];
		$this->descricao = $this->data['descricao'];
		
		if(SessionRegistry::getValue('error'))
		{
			return false;
		}
		return (parent::store())? true : false;
	}
	
	public function update(){
		unset($this->data['update']);
		
		$this->id = $this->data['id'];
		$this->titulo = $this->data['titulo'];
		$this->descricao = $this->data['descricao'];
		$this->empresa_id = $this->data['empresa_id'];
		
		if(SessionRegistry::getValue('error'))
		{
			return false;
		}
		
		return (parent::update())? true : false;
	}
	
	public function set_titulo($titulo) {
        if ($titulo != '') {
            $this->data['titulo'] = $titulo;
        } else {
            $this->errors->titulo = 'O campo Titulo de chamada da Vaga deve ser preenchido';
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
	public function set_descricao($descricao) {
        if ($descricao != '') {
            $this->data['descricao'] = $descricao;
        } else {
            $this->errors->descricao = utf8_decode('O campo descrição da vaga deve ser preenchido');
            SessionRegistry::setObject('error', $this->errors);
        }
    }
	
    public function destroy() {
        $this->status = '0';

        if (parent::update()) {
            return true;
        }
    }
	
    /**
     * @indexContext
     */
    public function findByVagas($limit) {
        $criteria = new Criteria;
        $criteria->addJoin(array('usuarios as u' => 'u.user_fk_id = vaga.empresa_id'));
        $criteria->addJoin(array('pessoa as p' => 'p.id = u.user_fk_id'));
        $criteria->add(new Filter('vaga.status', '=', ':status', 1));
        $criteria->setProperty('limit', $limit);
        $criteria->setProperty('order', 'vaga.id desc');
        return $this->finder()->load(null, $criteria, array(
			'vaga.id as id',
			'p.nome as nome',
            'u.descricao AS user_desc',
            'u.user_img',
            'u.user_thumb',
            'vaga.descricao',
            'vaga.titulo')
        );
    }
	
    public function findByVagasPorId($id) {
        $criteria = new Criteria;
        $criteria->addJoin(array('usuarios as u' => 'u.user_fk_id = vaga.empresa_id'));
        $criteria->addJoin(array('pessoa as p' => 'p.id = u.user_fk_id'));
        $criteria->add(new Filter('vaga.status', '=', ':status', 1));
        $criteria->add(new Filter('vaga.id', '=', ':id', $id));
        $criteria->setProperty('limit', $limit=1);
        $criteria->setProperty('order', 'vaga.id desc');
        return $this->finder()->load(null, $criteria, array(
			'vaga.id as id',
			'p.nome as nome',
            'u.descricao AS user_desc',
            'u.user_img',
            'u.user_thumb',
            'vaga.descricao',
            'vaga.titulo',
			'vaga.empresa_id')
        );
    }

    
    public function findBybuscarVaga($request) {
        $criteria = new Criteria;

        $criteria->addJoin(array('usuarios as u' => 'u.user_fk_id = vaga.empresa_id'));
        $criteria->addJoin(array('pessoa as p' => 'p.id = u.user_fk_id'));
        $criteria->add(new Filter('vaga.status', '=', ':status', 1));

        $criteria->add(new Filter('titulo', 'like', ':titulo', "%" . $request . "%"));
        $criteria->add(new Filter('vaga.descricao', 'like', ':descricao', "%" . $request . "%"), Expression::OR_OPERATOR);

        return parent::finder()->load(null, $criteria, array(
                    'vaga.id as id',
                    'p.nome as nome',
                    'u.user_img',
                    'u.user_thumb',
                    'vaga.descricao',
                    'u.descricao AS _descricao',
                    'vaga.titulo')
        );
    }
    
    public function findTodasAsVagas() {
        $criteria = new Criteria;

        $criteria->addJoin(array('usuarios as u' => 'u.user_fk_id = vaga.empresa_id'));
        $criteria->addJoin(array('pessoa as p' => 'p.id = u.user_fk_id'));
        $criteria->add(new Filter('vaga.status', '=', ':status', 1));
        $criteria->setProperty('limit', $limit=100);
        $criteria->setProperty('order', 'vaga.id desc');
        return parent::finder()->load(null, $criteria, array(
                    'vaga.id as id',
                    'p.nome as nome',
                    'u.user_img',
                    'u.user_thumb',
                    'vaga.descricao',
                    'u.descricao AS _descricao',
                    'vaga.titulo')
        );
    }
}