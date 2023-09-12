<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mercado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class MercadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosMercado = Mercado::All();

        return 'Mercadorias Encontradas' .$dadosMercado;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosMercado = $request -> All();
        $valida = Validator::make($dadosMercado,[
            'produto' => 'required',
            'validade' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistroMercado = Mercado::create($dadosMercado);
        if($RegistroMercado){
            return 'Dados cadastrado com sucesso.';
        }else{
            return 'Dados não cadastrados no banco de dados.';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dadosMercado = Mercado::find($id);
        $contador = $dadosMercado->count();
        if($dadosMercado){
            return 'Mercadoria Encontrado'.$contador.' - ' .$dadosMercado.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Mercadoria não localizada.'.response()->json([],Response::HTTP_NO_CONTENT);
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosMercado = $request->all();
        $valida = validator::make($dadosMercado,[
            'produto' => 'required',
            'validade' => 'required'
        ]);

        if($valida->fails()){
            return 'Erro Validação!!'.$valida->errors();
        }
        $dadosMercadoBanco = Mercado::find($id);
        $dadosMercadoBanco->produto = $dadosMercado['produto'];
        $dadosMercadoBanco->validade = $dadosMercado['validade'];

        $envioNoticias = $dadosMercadoBanco->save();
        
        if($envioNoticias){
            return 'A Mercadoria foi alterada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'A Mercadoria não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosMercado = Mercado::find($id);
        if($dadosMercado){
           $dadosMercado->delete();
            return 'O item foi deletado com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'O item não foi deletado com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }
}
