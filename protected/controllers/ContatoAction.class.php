<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContatoAction
 *
 * @author oab
 */
class ContatoAction extends ApplicationController {

    //put your code here
    public function send($request) {
        if ($request->getValues('post', 'stdClass')->name != '' &&
                $request->getValues('post', 'stdClass')->email != '' &&
                $request->getValues('post', 'stdClass')->comments != '') {
            new MailerComponent(array(
                'nome' => $request->getValues('post', 'stdClass')->name,
                'email' => $request->getValues('post', 'stdClass')->email,
                'mensagem' => $request->getValues('post', 'stdClass')->comments));
        } else {
            Message::_get('Error', 'Erro ao Enviar Mensagem, tente novamente');
        }
    }
}
