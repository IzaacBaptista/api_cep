<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

class CepController extends Controller
{

    public function index($cep)
    {
        $cep = (string) $cep;
        $endereco = Endereco::where('cep', $cep)->first();
        return $endereco;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        dd($request->all());
    }

    public function update(Endereco $endereco, Request $request)
    {
        //
    }

    public function destroy(Endereco $endereco)
    {
        //
    }
}
