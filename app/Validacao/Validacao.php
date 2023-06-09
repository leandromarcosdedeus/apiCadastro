<?php
namespace App\Validacao;

class Validacao{
    public function validarClient($request) {
        $teste = new Validacao;
        if(!$teste->validarNome($request->nome) ||
           !$teste->validarCPF($request->CPF) ||
           !$teste->validarApelido($request->apelido) ||
           
           !$teste->validarTime($request->time) ||
           !$teste->validarHobbie($request->hobbie)) {
            return false;
        }
    
        return true;
    }
    
    public function validarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
        if (strlen($cpf) != 11) {
            return false;
        }
    
        $digito1 = 0;
        $digito2 = 0;
    
        for ($i = 0; $i < 9; $i++) {
            $digito1 += $cpf[$i] * (10 - $i);
            $digito2 += $cpf[$i] * (11 - $i);
        }
    
        $resto1 = ($digito1 % 11) < 2 ? 0 : 11 - ($digito1 % 11);
        $resto2 = ($digito2 + ($resto1 * 2)) % 11 < 2 ? 0 : 11 - (($digito2 + ($resto1 * 2)) % 11);
    
        if ($cpf[9] != $resto1 || $cpf[10] != $resto2) {
            return false;
        } 
        return true;
    }
    
    public static function validarNome($nome) {
        $pattern = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
        $patternNumber = '0123456789';

        if(preg_match($pattern, $nome) || $nome == null){
            return false;
        }
        return true;
    }
    public static function validarApelido($apelido){
        if(is_null($apelido)){
            return false;   
        }
        return true;
    }
    public static function validarHobbie($hobbie){
        if(is_null($hobbie)){
            return false;   
        }
        return true; 
    }
    public static function validarTime($time){
        if(is_null($time)){
            return false;   
        }
        return true; 
    }
    
}
