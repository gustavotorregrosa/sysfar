<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicamento;

class MedicamentoController extends Controller
{


    function __construct()
    {
        $this->middleware('jwt');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $itens = Medicamento::all();
        return respostaCors($itens, 200);
    }

    public function salvar(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            return $this->update($request, $id);
        } else {
            return $this->create($request);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        $medicamento = new Medicamento;
        $medicamento->nome = $request->input('nome');
        $medicamento->descricao = $request->input('descricao');
        $medicamento->valor = $request->input('valorSanitizado');
        $medicamento->quantidade = $request->input('quantidade');

        try {
            $medicamento->save();
            return respostaCors("Medicamento " . $medicamento->nome . " criado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::find($id);
        $medicamento->nome = $request->input('nome');
        $medicamento->descricao = $request->input('descricao');
        $medicamento->valor = $request->input('valorSanitizado');
        $medicamento->quantidade = $request->input('quantidade');

        try {
            $medicamento->save();
            return respostaCors("Medicamento " . $medicamento->nome . " modificado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $medicamento = Medicamento::find($id);
            $nome = $medicamento->nome;
            $medicamento->delete();
            return respostaCors("Medicamento " . $nome . " deletado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
    }
}
