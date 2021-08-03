<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\ClienteTelefone;

class TelefonesController extends Controller
{

////ROTAS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = ClienteTelefone::all();
        return \response($clientes);
        
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

                'cliente_id' => 'required',
                'telefone_tipo_id' => 'required',
                'numero' => 'required|max:11'
                

            ]
        );

        $telefone = ClienteTelefone::create($request->all());
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
        $cliente = ClienteTelefone::find($id);
       
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

        $telefone = ClienteTelefone::findOrFail($id)->update($request->all());
        return \response($telefone);
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


    //// FUNÇÕES PARA EXIBIÇÃO

    public static function consultaTelCliente($idcliente)
    {
        //
        $request = Request::create('/api/telefones/cliente/'.$idcliente, 'GET');
        $response = Route::dispatch($request);
        $telefones = json_decode($response->getContent(), true);

        return $telefones;
    }

}
