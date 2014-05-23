<?php

class EmpresaAction extends ApplicationController {

    /**
     * @Aspect
     */
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
            $empresa = new Empresa;
            $empresa->fromArray($request->getValues('post'));
            if ($empresa->store()) {
                Message::_get('Info', '<h2>Sucesso ao Cadastrar Empresa Efetue Login <a href="page.php?class=usuarios&method=login">Clique aqui</a></h2>');
            } else {
                $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
            }
        }
    }

    public function update($context, $request) {
		session_start();
        if ($request) {
            $empresa = new Empresa;
            $empresa->fromArray($request->getValues('post'));
            if ($empresa->update()){
                Message::_get('Info', '<h2>Sucesso ao Atualizar dados cadastrais da Empresa - Voltar página de gerencimento da empresa <a href="page.php?class=empresa&method=index">Clique aqui</a></h2>');
            } else {
                Message::_get('Error', '<h2>Erro ao cadastrar Empresa <a href="page.php?class=empresa&method=index">Voltar</a></h2>');
            }
        }
    }

    public function editar($request) {
        $usuario = new Usuarios;
		
        $user = $usuario->finder()->find(array(
            'entity' => array(null),
            'attributes' => array(null),
            'where' => array('usuarios.id', '=', ':id', $request->getValues('get', 'stdClass')->id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );
		
        $empresa = new Empresa;
        $_empresa = $empresa->finder()->find(array(
            'entity' => array('Pessoa'),
            'attributes' => array(null),
            'where' => array('id', '=', ':id', $user[0]->user_fk_id),
            'order' => array('id' => 'desc'),
            'limit' => array(1))
        );

		$this->render(array('collection' => $_empresa));
    }
	
    public function listar($request) {
        $empresa = new Empresa;
        $collection = $empresa->findPessoasECurriculos();
		
        $this->render(array('collection' => $collection));		
    }
    
    public function listarNome($request) {
        $curriculo = new Empresa;
        $collection = $curriculo->visualizarNomePessoaCurriculo();	
        $this->render(array('collection' => $collection));
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

            $vaga = new Vaga;
            $vagas = $vaga->finder()->find(array(
                'entity' => array(null),
                'attributes' => array(null),
                'where' => array('status', '=', ':status', 1),
                Expression::_AND() => array('vaga.empresa_id', '=', ':empresa', $user[0]->user_fk_id),
                'order' => array('id' => 'desc'),
                'limit' => array(100))
            );
            if ($vagas and $user) {
                $collection = array('user' => $user, 'vagas' => $vagas);
                $this->render(array('collection' => $collection));
            } else {
                Message::_get('Info', 'Não há vagas cadastradas');
            }
        }
    }
	
	
	public function cancelar($request){
		if($request->getValues('get','stdClass')->id){
			$empresa = new Empresa;
			$empresa->id = $request->getValues('get','stdClass')->id;
			if($empresa->cancelar()){
				SessionRegistry::freeSession();
                Message::_get('Info', '<h2>Usuário Cancelado no Sistema <a href="index.php">Voltar</a></h2>');
			}
			else{
				SessionRegistry::freeSession();
				Message::_get('Info', '<h2>Erro ao cancelar Usuário</h2>');
			}
		}
	}
	
    /**
     *@ajaxRequest 
     */
    public function consultWebServiceCorreios($request) {
        $correios = new CorreiosService($request->getValues('get','stdClass')->cep);
        echo json_encode($correios->getResourse());
    }
}