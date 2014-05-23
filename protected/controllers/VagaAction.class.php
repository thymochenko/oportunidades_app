<?php

class VagaAction extends ApplicationController {

    //put your code here
    public $filter = array(
        'beforeFilter' => array('joinPoints' => null, 'self' => array('cadastrar', 'editar', 'excluir', 'cancelar'),
            'adviceMethods' => array('verifyPermission'))
    );

    public function cadastrar() {
        SessionRegistry::initialize();
        $usuario = new Usuarios;
        $user = $usuario->finder()->findById((int) $_SESSION['user_id']);
        $this->render(array('collection' => $user));
    }

    public function store($context, $request) {
        session_start();
        if ($request) {
            $vaga = new Vaga;
            $vaga->fromArray($request->getValues('post'));
            if($vaga->store()) {
                Message::_get('Info', 'Voltar para listagem de vagas - <a href="page.php?class=empresa&method=index">aqui</a>');
            } else {
                $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
            }
        }
    }
	
    public function update($context, $request) {
        session_start();
        if ($request) {
            $vaga = new Vaga;
            $vaga->fromArray($request->getValues('post'));
            if($vaga->update()) {
                Message::_get('Info', 'Voltar para listagem de vagas - <a href="page.php?class=empresa&method=index">aqui</a>');
            } else {
                $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
            }
        }
    }
	
    public function editar($request){
		$vaga = new Vaga;
		$this->render(array('collection'=>$vaga->findByVagasPorId((int)$request->getValues('get','stdClass')->id)));
    }

    public function excluir($request) {
        parent::sendActionById($template = 'excluir', $request);
    }

    public function destroy($context, $request) {
        $vaga = new Vaga;
        $vaga->id = $request->getValues('get', 'stdClass')->id;
        if ($vaga->destroy()) {
            Message::_get('Info', '<h2>Vaga - Excluida - Voltar para listagem de vagas - <a href="page.php?class=empresa&method=index">aqui</a></h2>');
        }
    }


    public function listarVagasPaginaInicial() {
        Transaction::open();
        $vaga = new Vaga;
        $collection = $vaga->findByVagas($limit = 6);
        if ($collection && count($collection) >= 3) {
            $path = ConfigPath::pathAppBase();
            $lz_tpl = $path . '/protected/views/views.' . 'index' . '/' . 'welcome.html';
            $tpl = new Template($lz_tpl);
            $tpl->set('collection', array(null));
            echo $tpl->fetch($lz_tpl);
            $this->render(array('collection' => $collection, 'template' => 'listarVagasPaginaInicial'));
        } else {
            $path = ConfigPath::pathAppBase();
            $lz_tpl = $path . '/protected/views/views.' . 'index' . '/' . 'welcome.html';
            $tpl = new Template($lz_tpl);
            $tpl->set('collection', array(null));
            echo $tpl->fetch($lz_tpl);
        }
        Transaction::close();
    }

    public function visualizar($request) {
        $vaga = new Vaga;
        $collection = $vaga->findByVagasPorId($request->getValues('get', 'stdClass')->id);
        if ($collection) {
            $this->render(array('collection' => $collection));
        } else {
            Message::_get('Info', 'Não Há Vagas Cadastradas Ainda no Sistema');
        }
    }

    public function buscarVaga($request) {
        $vaga = new Vaga;
        $collection = $vaga->findBybuscarVaga($request->getValues('get', 'stdClass')->busca);
        if ($collection) {
            $this->render(array('collection' => $collection, 'template' => 'listarVagaBusca'));
        } else {
            Message::_get('Info', 'Não Há Vagas Cadastradas Ainda no Sistema');
        }
    }

    public function todas($request) {
        $vaga = new Vaga;
        $collection = $vaga->findTodasAsVagas();
        if ($collection) {
            $this->render(array('collection' => $collection, 'template' => 'listarVagaBusca'));
        } else {
            Message::_get('Info', 'Não Há Vagas Cadastradas Ainda no Sistema');
        }
    }
}