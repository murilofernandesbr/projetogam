<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TipoTelefone;
use Illuminate\Support\Facades\Route;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipo = TipoTelefone::all();
        return \response($tipo);
        
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
        $request->validate( 

            [

                'tipo' => 'required|max:40',
                'whatsapp' => 'required',
                
                

            ]
        );

        $telefone = TipoTelefone::create($request->all());
        return \response($telefone);
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
        $cliente = TipoTelefone::find($id);
       
        // If user not found
        if(!$cliente) {

            return \response('NAO ENCONTRADO');

        } else 
        {
          return \response($cliente);
        }
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
        //
        $cliente = ClienteTelefone::findOrFail($id)->update($request->all());
        return \response($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        ClienteTelefone::destroy($id);
        return \response( "O registro foi apagado");
    }

    //// FUNÇÕES PARA EXIBIR

    public static function consultaTipotel($idTipo)
    {
        //
        $request = Request::create('/api/tipostelefone/'.$idTipo, 'GET');
        $response = Route::dispatch($request);
        $telefones = json_decode($response->getContent(), true);

        return $telefones;
    }
    
    public static function listaTipotel()
    {
        //
        $request = Request::create('/api/tipostelefone', 'GET');
        $response = Route::dispatch($request);
        $tipostel = json_decode($response->getContent(), true);

        return $tipostel;
    }
}
