<?php

class UsuariosAction extends ApplicationController {

    public function add() {
        $this->render(array(
            'collection' => array(null), 'template' => 'add')
        );
    }

    public function store() {
        if ($_POST['insert']) {
            $usuario = new Usuarios;
            $usuario->fromArray($this->request()->post());
            if ($usuario->store()) {
                Message::_get('Info', "<h2> Cadastro realizada com sucesso</h2>");
                $this->redirect(array(
                    'class' => 'usuarios',
                    'method' => 'listar',
                    'type' => array('timeRedirect' => 1000))
                );
            } else {
                $errorMessage = utf8_encode('<h2>' . SessionRegistry::getValue('error') . '</h2>');
                Message::_get('Error', $errorMessage);
            }
        }
    }

    public function login() {
        $this->render(array('collection' => array(null)));
    }
    
    public function passNew() {
        $this->render(array(
            'collection' => array(null), 'template' => 'passNew')
        );
    }

    public function autenticacaoFilter() {
        SessionRegistry::initialize();

        if ($_SESSION['user_type'] == '1') {
            $this->redirect(array(
                'absolute' => 'true',
                'url' => 'page.php?class=empresa&method=index'
            ));
        } elseif($_SESSION['user_type'] == '2') {
            $this->redirect(array(
                'absolute' => 'true',
                'url' => 'page.php?class=advogado&method=index'
            ));
        }elseif($_SESSION['user_type'] == '3') {
            $this->redirect(array(
                'absolute' => 'true',
                'url' => 'page.php?class=candidato&method=index'
            ));
        }elseif($_SESSION['user_type'] == '4') {
            $this->redirect(array(
                'absolute' => 'true',
                'url' => 'page.php?class=estagiario&method=index'
            ));
        }
    }

    public function defineBlockContext() {
        if (isset($_SESSION)) {
            true;
        } else {
            session_start();
        }
        if (isset($_SESSION['user_type']) and $_SESSION['user_type'] == '1') {
            $this->render(array('collection' => array(null), 'template' => 'empresaPrivateBlockRight'));
        } elseif (isset($_SESSION['user_type']) and $_SESSION['user_type'] == '2') {
            $this->render(array('collection' => array(null), 'template' => 'advogadoPrivateBlockRight'));
        } elseif (isset($_SESSION['user_type']) and $_SESSION['user_type'] == '3') {
            $this->render(array('collection' => array(null), 'template' => 'candidatoPrivateBlockRight'));
        } elseif (isset($_SESSION['user_type']) and $_SESSION['user_type'] == '4') {
            $this->render(array('collection' => array(null), 'template' => 'estagiarioPrivateBlockRight'));
        } else {
            $this->render(array('collection' => array(null), 'template' => 'userPlublicBlockRight'));
        }
    }
    
    public function logout($request){
        if($request->getValues('get','stdClass')->doLogout == 'true'){
            $user = new authUsers();
            $user->authStart();
            $user->sessionClose();
        }
    }
	
	public function createNewPass($request){
		if($request->getValues('post','stdClass')->email){
			$entity = new Usuarios;
			$entity->email = $request->getValues('post','stdClass')->email;
			if($entity->recoveryPass()){
				Message::_get('Info', "<h2>Sua nova senha foi enviada para seu email</h2>");
			}
			else{
				Message::_get('Info', utf8_decode("<h1>Seu Email não foi encontrado no sistema</h1>"));
			}
		}
	}
}