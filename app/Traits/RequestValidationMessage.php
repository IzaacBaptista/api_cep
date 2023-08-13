<?php

namespace App\Traits;

trait RequestValidationMessage
{
    public static function regexDecimal($digitos, $casas)
    {
        return __('validation.invalid_regex_decimal', ['digitos' => $digitos, 'casas' => $casas]);
    }

    public function retornarProhibited($valor, $campoValidador, $campoValidado, $mensagem)
    {
        return  __("validation.$mensagem", [
            'value' => $valor,
            'other' => $campoValidador,
            'attribute' => $campoValidado
        ]);
    }
}
