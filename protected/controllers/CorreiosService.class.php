<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorreiosService
 *
 * @author oab
 */
class CorreiosService {

    private $cep;

    public function __construct($cep) {
        $this->cep = $cep;
    }

    public function getResourse() {
        $action = "http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do";
        $ch = curl_init($action);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "CEP=" . $this->cep . "&Metodo=listaLogradouro&TipoConsulta=cep&StartRow=1&EndRow=10");

        $resourse = curl_exec($ch);
        curl_close($ch);

        if ($pos = strpos($resourse, '<table border="0" cellspacing="1" cellpadding="5" bgcolor="gray">')) {
            $table = substr($resourse, $pos, 500);
            //print $table;
            list($logradouro, $bairro, $uf, $cep) = @split("    ", trim(strip_tags($table)));
            list($tipoLogr, $nomeLogr) = @split(" ", $logradouro, 2);
            

            $collection = array('tipoLogradouro'=>$tipoLogr,
                'nomeLogradouro'=>  utf8_encode($nomeLogr),
                '_bairro'=>utf8_encode($bairro),
                '_uf'=>$uf,
                'estado'=>$cep
            );
            
            return $collection;
        } else {
            print "CEP Nao encontrado";
        }
    }
}