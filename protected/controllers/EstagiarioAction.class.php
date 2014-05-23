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
class EstagiarioAction extends ApplicationController {

    //put your code here
    public $filter = array(
        'afterFilter' => array('joinPoints' => null, 'self' => array('editar', 'index', 'cancelar'),
            'adviceMethods' => array('verifyPermission'))
    );

    //put your code here
    public function cadastro() {
        $this->render(array('collection' => array(null)));
    }

    public function store($context, $request) {
		session_start();
        if ($request) {

            $canditado = new Estagiario();
            $canditado->fromArray($request->getValues('post'));
        }
        if ($canditado->store()) {
            Message::_get('Info', utf8_decode('<h2>Sucesso ao Cadastrar Estágiario <br> Efetue Login <a href="page.php?class=usuarios&method=login">Clique aqui</a></h2>'));
        } else {
            $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
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

    public function editar($request) {
        if ($request->getValues('get', 'stdClass')->id) {

            $usuario = new Usuarios;
            $_user = $usuario->finder()->findById((int) $request->getValues('get', 'stdClass')->id);

            if ($_user[0] instanceOf Usuarios) {
                $estagiario = new Estagiario;
                $_estag = $estagiario->finder()->find(array(
                    'entity' => array('pessoa'),
                    'attributes' => array(null),
                    'where' => array('pessoa.id', '=', ':id', $_user[0]->user_fk_id),
                    'order' => array('id' => 'desc'),
                    'limit' => array(1))
                );

                if ($_estag) {
                    $this->render(array('collection' => $_estag));
                } else {
                    Message::_get('Info', '<h2>Erro - id Inexistente</h2>');
                }
            }
        }
    }

    public function update($context, $request) {
        session_start();
		if ($request) {
            $estagiario = new Estagiario;
            $estagiario->fromArray($request->getValues('post'));
        }
        if ($estagiario->update()) {
            Message::_get('Info', '<h2>Sucesso ao Atualizar dados de Estagiario <a href="page.php?class=estagiario&method=index">Voltar</a></h2>');
        } else {
            $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
        }
    }

    /**
     * @ajaxRequest 
     */
    public function consultWebServiceCorreios($request) {
        $correios = new CorreiosService($request->getValues('get', 'stdClass')->cep);
        echo json_encode($correios->getResourse());
    }

    public function cancelar($request) {
        if ($request->getValues('get', 'stdClass')->id) {
            $estagiario = new Estagiario;
            $estagiario->id = $request->getValues('get', 'stdClass')->id;
            if ($estagiario->cancelar()) {
				SessionRegistry::freeSession();
                Message::_get('Info', '<h2>Usuário Cancelado no Sistema <a href="index.php">Voltar</a></h2>');
            } else {
				SessionRegistry::freeSession();
                Message::_get('Info', '<h2>Erro ao cancelar Usuário</h2>');
            }
        }
    }

}