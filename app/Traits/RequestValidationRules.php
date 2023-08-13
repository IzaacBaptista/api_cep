<?php

namespace App\Traits;

use Illuminate\Validation\Rule;

trait RequestValidationRules
{
    public function prohibitedIf($request, $array, $campo, $valor, $proibidoSeIgual = false)
    {
        if (isset($request->$array) && !empty($request->$array[$campo])) {
            if ($proibidoSeIgual) {
                $validacao = $request->$array[$campo] == $valor;
            } else {
                $validacao = $request->$array[$campo] != $valor;
            }
            return Rule::prohibitedIf($validacao);
        }

        return '';
    }

    public function regexDecimalRule($digitos, $casas)
    {
        return "nullable|numeric|regex:/^\d{1,$digitos}(\.\d{1,$casas})?$/";
    }
}
