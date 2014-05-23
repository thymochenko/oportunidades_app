<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validations
 *
 * @author oab
 */
class Validations {

    //put your code here
    function validCPF($cpf) {
        // determina um valor inicial para o digito $d1 e $d2
        // pra manter o respeito ;)
        $d1 = 0;
        $d2 = 0;
        // remove tudo que n�o seja n�mero
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf inv�lidos que ser�o ignorados
        $ignore_list = array(
            '00000000000',
            '01234567890',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        );
        // se o tamanho da string for dirente de 11 ou estiver
        // na lista de cpf ignorados j� retorna false
        if (strlen($cpf) != 11 || in_array($cpf, $ignore_list)) {
            return false;
        } else {
            // inicia o processo para achar o primeiro
            // n�mero verificador usando os primeiros 9 d�gitos
            for ($i = 0; $i < 9; $i++) {
                // inicialmente $d1 vale zero e � somando.
                // O loop passa por todos os 9 d�gitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }
            // acha o resto da divis�o da soma acima por 11
            $r1 = $d1 % 11;
            // se $r1 maior que 1 retorna 11 menos $r1 se n�o
            // retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            // inicia o processo para achar o segundo
            // n�mero verificador usando os primeiros 9 d�gitos
            for ($i = 0; $i < 9; $i++) {
                // inicialmente $d2 vale zero e � somando.
                // O loop passa por todos os 9 d�gitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }
            // $r2 ser� o resto da soma do cpf mais $d1 vezes 2
            // dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;
            // se $r2 mair que 1 retorna 11 menos $r2 se n�o
            // retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;
            // retona true se os dois �ltimos d�gitos do cpf
            // forem igual a concatena��o de $d1 e $d2 e se n�o
            // deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
    }

    function isCnpjValid($cnpj) {
        //Etapa 1: Cria um array com apenas os digitos num�ricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
       
        $j = 0;
        for ($i = 0; $i < (strlen($cnpj)); $i++) {
            if (is_numeric($cnpj[$i])) {
                $num[$j] = $cnpj[$i];
                $j++;
            }
        }
        //Etapa 2: Conta os d�gitos, um Cnpj v�lido possui 14 d�gitos num�ricos.
        if (count($num) != 14) {
            $isCnpjValid = false;
        }
        //Etapa 3: O n�mero 00000000000 embora n�o seja um cnpj real resultaria um cnpj v�lido ap�s o calculo dos d�gitos verificares e por isso precisa ser filtradas nesta etapa.
        if ($num[0] == 0 && $num[1] == 0 && $num[2] == 0 && $num[3] == 0 && $num[4] == 0 && $num[5] == 0 && $num[6] == 0 && $num[7] == 0 && $num[8] == 0 && $num[9] == 0 && $num[10] == 0 && $num[11] == 0) {
            $isCnpjValid = false;
        }
        //Etapa 4: Calcula e compara o primeiro d�gito verificador.
        else {
            $j = 5;
            for ($i = 0; $i < 4; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $j = 9;
            for ($i = 4; $i < 12; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[12]) {
                $isCnpjValid = false;
            }
        }
        //Etapa 5: Calcula e compara o segundo d�gito verificador.
        if (!isset($isCnpjValid)) {
            $j = 6;
            for ($i = 0; $i < 5; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $j = 9;
            for ($i = 5; $i < 13; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }
            $soma = array_sum($multiplica);
            $resto = $soma % 11;
            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }
            if ($dg != $num[13]) {
                $isCnpjValid = false;
            } else {
                $isCnpjValid = true;
            }
        }
       
        return $isCnpjValid;
    }

}

?>
