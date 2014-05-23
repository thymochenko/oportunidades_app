<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurriculoAction
 *
 * @author oab
 */
class CurriculoAction extends ApplicationController {

    //put your code here
    public $filter = array(
        'afterFilter'=> array('joinPoints'=>null,'self'=>array('alterar',
            'visualizar','cancelar','excluir','exibir'),
        'adviceMethods'=>array('verifyPermission'))
    );
	
    //put your code here
    public function alterar($request) {
        $entity = new Usuarios;
          /** @Usuarios */  $u = $entity->finder()->find(array(
            'entity' => array(null),
            'attributes' => array('user_fk_id'),
            'where' => array('usuarios.id', '=', ':id', $request->getValues('get', 'stdClass')->id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );
		
		$entity = new Pessoa;
		 /** @Pessoa */  $p = $entity->finder()->find(array('entity' => array(null),
            'attributes' => array('pessoa_tipo'),
            'where' => array('pessoa.id', '=', ':id', $u[0]->user_fk_id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
		);
		
        $entity = new Curriculo;
         /** @Curriculo */  $c = $entity->finder()->find(array(
            'entity' => array(null),
            'attributes' => array(null),
            'where' => array('curriculo.pessoa_id', '=', ':pessoa_id', $u[0]->user_fk_id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
		);

		if($p[0] instanceOf Pessoa && $p[0]->pessoa_tipo == Pessoa::CANDIDATO ){
			$this->render(array('template'=>'alterar_curr_candid', 'collection'=>$c));
		}
		else{
			$this->render(array('collection'=>$_curriculo));
		}
    }
	
	public function visualizar($request){
		
		$entity = new Usuarios;
        /** @Usuarios */  $u = $entity->finder()->find(array(
            'entity' => array(null),
            'attributes' => array(null),
            'where' => array('id', '=', ':id',$request->getValues('get','stdClass')->id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
		);

		$entity = new Pessoa;
        /** @Pessoa */  $p = $entity->finder()->find(array(
            'entity' => array('Pessoa'),
            'attributes' => array(null),
            'where' => array('pessoa.id', '=', ':id',$u[0]->user_fk_id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
		);
			
		$entity = new Curriculo;
        /** @Curriculo */ $c = $entity->finder()->find(array(
            'entity' => array(null),
            'attributes' => array(null),
            'where' => array('curriculo.pessoa_id', '=', ':pessoa_id', $p[0]->id),
            'order' => array('id' => 'desc'),
            'limit' => array(1)));
		
		if($p[0] instanceOf Pessoa && $p[0]->pessoa_tipo == Pessoa::CANDIDATO ){
			$this->render(array('template'=>'visualizar_curr_candid', 'collection'=>array('curriculo'=>$c, 'pessoa'=>$p, 'user_attr'=>$u)));
		}
		else{
			$this->render(array('collection'=>array('curriculo'=>$c, 'pessoa'=>$p, 'user_attr'=>$u)));
		}

	}
	
	public function excluir($request){
		parent::sendActionById(__FUNCTION__,$request);
	}
	
	public function destroy($request){
		$curriculo = new Curriculo;
        $curriculo->id = $request->getValues('get', 'stdClass')->id;
         //string global que vem do form que serve para decisao de qual metodo executar. não vai pra query
        unset($curriculo->delete);
		
        if($curriculo->destroy()){
			Message::_get('Info', "<h2>Curriculo Excluido com sucesso"   . '<a href="page.php?class=advogado&method=index"> Voltar</h2>');
		}
	}
	
	public function exibir($request){
		$curriculo = new Curriculo;
		$collection = $curriculo->finder()->findById((int)$request->getValues('get','stdClass')->id);
		
		if($collection){
			$this->render(array('collection'=>$collection));
		}
	}
}