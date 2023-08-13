<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

class EnderecoController extends Controller
{

    public function index()
    {
        $enderecos = Endereco::all();
        return $enderecos;
        
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->fill($request->all());
        $endereco->save();

        return $endereco;
    }

    public function show(Endereco $endereco)
    {
        $endereco = Endereco::find($endereco->id);
        return $endereco;
    }

    public function update(Endereco $endereco, Request $request)
    {
        $endereco = Endereco::find($endereco->id);
        $endereco->fill($request->all());
        $endereco->save();

        return $endereco;
    }

    public function destroy(Endereco $endereco)
    {
        $endereco = Endereco::find($endereco->id);
        $endereco->delete();
    }
}
