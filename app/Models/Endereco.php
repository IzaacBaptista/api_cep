<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    protected $fillable = [
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //rules
    public function rules($request) 
    {    
        return [
            'cep' => 'required|string|max:12',
            'logradouro' => 'required|string|max:250',
            'bairro' => 'required|string|max:250',
            'cidade' => 'required|string|max:250',
            'uf' => 'required|string|max:2',
        ];
    }

    //messages
    public function messages($request)
    {
        return [
            'cep.required' => 'O campo CEP é obrigatório',
            'cep.string' => 'O campo CEP deve ser do tipo string',
            'cep.max' => 'O campo CEP deve ter no máximo 12 caracteres',
            'logradouro.required' => 'O campo Logradouro é obrigatório',
            'logradouro.string' => 'O campo Logradouro deve ser do tipo string',
            'logradouro.max' => 'O campo Logradouro deve ter no máximo 250 caracteres',
            'bairro.required' => 'O campo Bairro é obrigatório',
            'bairro.string' => 'O campo Bairro deve ser do tipo string',
            'bairro.max' => 'O campo Bairro deve ter no máximo 250 caracteres',
            'cidade.required' => 'O campo Cidade é obrigatório',
            'cidade.string' => 'O campo Cidade deve ser do tipo string',
            'cidade.max' => 'O campo Cidade deve ter no máximo 250 caracteres',
            'uf.required' => 'O campo UF é obrigatório',
            'uf.string' => 'O campo UF deve ser do tipo string',
            'uf.max' => 'O campo UF deve ter no máximo 2 caracteres'
        ];
    }
}
