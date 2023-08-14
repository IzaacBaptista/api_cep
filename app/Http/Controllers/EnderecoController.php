<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;

class EnderecoController extends Controller
{

    public function __construct(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }
    public function index()
    {
        $enderecos = Endereco::all();
        return response()->json($enderecos, 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->endereco->rules(), $this->endereco->messages());
        $endereco = $this->endereco->create($request->all());
        return response()->json($endereco, 201);
    }

    public function show(Endereco $endereco)
    {
        $endereco = Endereco::find($endereco->id);
        return response()->json($endereco, 200);
    }

    public function update(Endereco $endereco, Request $request)
    {
        $request->validate($this->endereco->rules(), $this->endereco->messages());
        $endereco = Endereco::find($endereco->id);
        $endereco->update($request->all());
        return response()->json($endereco, 200);
    }

    public function destroy(Endereco $endereco)
    {
        $endereco = Endereco::find($endereco->id);
        $endereco->delete();
        return response()->json(null, 204);
    }
}
