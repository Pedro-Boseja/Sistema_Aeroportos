<?php

function valida_CNPJ($cnpj) {
    // Remove caracteres especiais do CNPJ
    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

    // Verifica se o CNPJ possui 14 caracteres
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Verifica se todos os caracteres do CNPJ são iguais
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
        $soma += ($cnpj[$i] * (($i < 4) ? 5 - $i : 13 - $i));
    }
    $dv1 = 11 - ($soma % 11);
    if ($dv1 > 9) {
        $dv1 = 0;
    }

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
        $soma += ($cnpj[$i] * (($i < 5) ? 6 - $i : 14 - $i));
    }
    $dv2 = 11 - ($soma % 11);
    if ($dv2 > 9) {
        $dv2 = 0;
    }

    // Verifica se os dígitos verificadores estão corretos
    if (($cnpj[12] == $dv1) && ($cnpj[13] == $dv2)) {
        return true;
    } else {
        return false;
    }
}

function verifica_SiglaCompanhia($string) {
    if (strlen($string) == 2) {
        return true; // a string tem tamanho 2
    } else {
        return false; // a string não tem tamanho 2
    }
}

function verifica_ModeloAeronave($string){
    $fragments = explode('-', $string);
    if($fragments[0] == "PT" || $fragments[0] == "PR" || $fragments[0] == "PP"|| 
       $fragments[0] == "PS"){
        return true;
    }
    else{
        return false;
    }
}

function verifica_SiglaAeroporto($string){
    if (strlen($string) == 3) {
        return true; // a string tem tamanho 3
    } else {
        return false; // a string não tem tamanho 3
    }
}


function valida_Rg(string $n_identificacao){
        // Remove possíveis pontos e traços do número do RG
        $n_identificacao = preg_replace('/[^0-9]/', '', $n_identificacao);

        // Verifica se o RG possui 9 dígitos
        if (strlen($n_identificacao) != 8) {
            echo 'Nome: ';
            return false;
        }

        // // Verifica se o primeiro dígito é válido
        // $d1 = $n_identificacao[0];
        // if ($d1 < 1 || $d1 > 9) {
        //     return false;
        // }

        // // Verifica se o segundo dígito é válido
        // $d2 = $n_identificacao[1];
        // if ($d2 < 0 || $d2 > 9) {
        //     return false;
        // }

        // // Verifica se os próximos 6 dígitos são válidos
        // $d3 = $n_identificacao[2];
        // $d4 = $n_identificacao[3];
        // $d5 = $n_identificacao[4];
        // $d6 = $n_identificacao[5];
        // $d7 = $n_identificacao[6];
        // $d8 = $n_identificacao[7];
        // $soma = ($d3 * 2) + ($d4 * 3) + ($d5 * 4) + ($d6 * 5) + ($d7 * 6) + ($d8 * 7);
        // $resto = $soma % 11;
        // $digito = ($resto == 0 || $resto == 1) ? 0 : (11 - $resto);
        // if ($n_identificacao[7] != $digito) {
        //     return false;
        // }

        // Se passar em todas as verificações, o RG é válido
        return true;
    }

function valida_Passaporte(string $n_identificacao){
        // Verifica se o número de passaporte tem o tamanho correto
        if (strlen($n_identificacao) != 7) {
            return false;
        }
        
        // Verifica se os dois primeiros caracteres são letras maiúsculas
        if (!ctype_upper(substr($n_identificacao, 0, 2))) {
                return false;
        }
        
        // Verifica se os quatro últimos caracteres são dígitos
        if (!ctype_digit(substr($n_identificacao, 2, 6))) {
            return false;
        }
    
        // Caso tenha passado por todas as verificações, o número de passaporte é válido
        return true;
    }

function valida_Email($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
}

function valida_CPF($cpf) {
    // Elimina possivel formatação do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/^(\d)\1+$/', $cpf)) {
        return false;
    }
    
    // Verifica o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (10 - $i);
    }
    $resto = $soma % 11;
    if ($resto < 2) {
        $dv1 = 0;
    } else {
        $dv1 = 11 - $resto;
    }
    
    // Verifica o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (11 - $i);
    }
    $soma += $dv1 * 2;
    $resto = $soma % 11;
    if ($resto < 2) {
        $dv2 = 0;
    } else {
        $dv2 = 11 - $resto;
    }
    
    // Verifica se os dígitos verificadores estão corretos
    if ($cpf[9] == $dv1 && $cpf[10] == $dv2) {
        return true;
    } else {
        return false;
    }
}


//O código deve ser composto de duas letras seguidas de
//quatro números; As duas letras iniciais devem coincidir com a sigla da
//companhia responsável por executar o vôo.
function verifica_CodigoVoo(string $codigo, string $sigla){
//é tudo culpa dos enzos
}