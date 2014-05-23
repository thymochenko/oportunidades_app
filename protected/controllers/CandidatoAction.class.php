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
class CandidatoAction extends ApplicationController {

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

            $canditado = new Candidato();

            $canditado->fromArray($request->getValues('post'));
        }
        if ($canditado->store()) {
            Message::_get('Info', '<h2>Sucesso ao Cadastrar Canditado Efetue Login <a href="page.php?class=usuarios&method=login">Clique aqui</a></h2>');
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

    /**
     * @ajaxRequest 
     */
    public function consultWebServiceCorreios($request) {
        $correios = new CorreiosService($request->getValues('get', 'stdClass')->cep);
        echo json_encode($correios->getResourse());
    }

    public function editar($request) {
        if ($request->getValues('get', 'stdClass')->id) {

            $usuario = new Usuarios;
            $_user = $usuario->finder()->findById((int) $request->getValues('get', 'stdClass')->id);

            if ($_user[0] instanceOf Usuarios) {
                $candidato = new Candidato;
                $_cand = $candidato->finder()->find(array(
                    'entity' => array('pessoa'),
                    'attributes' => array(null),
                    'where' => array('pessoa.id', '=', ':id', $_user[0]->user_fk_id),
                    'order' => array('id' => 'desc'),
                    'limit' => array(1))
                );

                if ($_cand) {
                    $this->render(array('collection' => $_cand));
                } else {
                    Message::_get('Info', '<h2>Erro - id Inexistente</h2>');
                }
            }
        }
    }

    public function update($context, $request) {
        session_start();
		if ($request) {
            $candidato = new Candidato;
            $candidato->fromArray($request->getValues('post'));
        }
        if ($candidato->update()) {
            Message::_get('Info', '<h2>Sucesso ao Atualizar dados de Candidato <a href="page.php?class=candidato&method=index">Voltar</a></h2>');
        } else {
            $this->render(array('template' => 'errors', 'collection' => SessionRegistry::getValue('error')));
        }
    }

    public function cancelar($request) {
        if ($request->getValues('get', 'stdClass')->id) {
            $candidato = new Candidato;
            $candidato->id = $request->getValues('get', 'stdClass')->id;
            if ($candidato->cancelar()) {
                Message::_get('Info', utf8_decode('<h2>Usuário Cancelado no Sistema <a href="index.php">Voltar</a></h2>'));
				SessionRegistry::freeSession();
            } else {
                Message::_get('Info', utf8_decode('<h2>Erro ao cancelar Usuário</h2>'));
				SessionRegistry::freeSession();
            }
        }
    }
}