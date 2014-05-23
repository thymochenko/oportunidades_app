<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvogadoAction
 *
 * @author oab
 */
class AdvogadoAction extends ApplicationController {

    //put your code here
    public $filter = array(
        'afterFilter'=> array('joinPoints'=>null,'self'=>array('editar','index','cancelar'),
        'adviceMethods'=>array('verifyPermission'))
    );
    
    public function cadastro() {
        $this->render(array('collection' => array(null)));
    }

    public function store($context, $request) {
		session_start();
        if ($request) {
                $advogado = new Advogado;
                $advogado->fromArray($request->getValues('post'));
        }
            if ($advogado->store()) {
                Message::_get('Info', '<h2>Sucesso ao Cadastrar Advogado Efetue Login <a href="page.php?class=usuarios&method=login">Clique aqui</a></h2>');
            } else {
				if($_SESSION){
					$this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
				}
            }
    }
    
	public function update($context, $request) {
        session_start();
		if ($request) {
                $advogado = new Advogado;
                $advogado->fromArray($request->getValues('post'));
        }
            if ($advogado->update()) {
                Message::_get('Info', '<h2>Sucesso ao Atualizar dados de Advogado <a href="page.php?class=advogado&method=index">Voltar</a></h2>');
            } else {
				if($_SESSION){
					$this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
				}
            }
    }
	
	public function editar($request){
		if($request->getValues('get','stdClass')->id){
		
			$usuario = new Usuarios;
			$_user = $usuario->finder()->findById((int)$request->getValues('get','stdClass')->id);
			
			if($_user[0] instanceOf Usuarios){
				$advogado = new Advogado;
				$_advog = $advogado->finder()->find(array(
					'entity' => array('pessoa'),
					'attributes' => array(null),
					'where' => array('pessoa.id', '=', ':id', $_user[0]->user_fk_id),
					'order' => array('id' => 'desc'),
					'limit' => array(1))
				);
				
				if($_advog){
					$this->render(array('collection'=>$_advog));
				}
				else{
					Message::_get('Info', '<h2>Erro - id Inexistente</h2>');
				}
			}
		}
	}
	
    public function index() {
        
        if (isset($_SESSION['user_id'])) {

            $usuario = new Usuarios;
            $user = $usuario->finder()->find(array(
                'entity' => array(null),
                'attributes' => array(null),
                'where' => array('usuarios.id', '=', ':id', $_SESSION['user_id']),
                'order' => array('id' => 'desc'),
                'limit' => array(1))
            );

            $curriculo = new Curriculo;
            $curriculo = $curriculo->finder()->find(array(
                'entity' => array(null),
                'attributes' => array(null),
                'where' => array('curriculo.pessoa_id', '=', ':pessoa_id', $user[0]->user_fk_id),
				Expression::_AND() =>array('curriculo.status', '=', ':status', 1),
                'order' => array('id' => 'desc'),
                'limit' => array(100))
            );

            if ($curriculo and $user) {
                $collection = array('user' => $user, 'curriculo' => $curriculo);
                $this->render(array('collection' => $collection));
            } else {
                Message::_get('Info', 'Não há vagas cadastradas');
            }
        }
    }
	
    /**
     * @ajaxRequest 
    */
    public function consultWebServiceCorreios($request) {
        $correios = new CorreiosService($request->getValues('get', 'stdClass')->cep);
        echo json_encode($correios->getResourse());
    }
	
	public function cancelar($request){
		if($request->getValues('get','stdClass')->id){
			$advogado = new Advogado;
			$advogado->id = $request->getValues('get','stdClass')->id;
			if($advogado->cancelar()){		
                Message::_get('Info', '<h2>Usuário Cancelado no Sistema <a href="index.php">Voltar</a></h2>');
				SessionRegistry::freeSession();
			}
			else{
				Message::_get('Info', '<h2>Erro ao cancelar Usuário</h2>');
				SessionRegistry::freeSession();
			}
		}
	}
}