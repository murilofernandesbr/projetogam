<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\cliente_telefone;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $clientes = Cliente::all();
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

                'cpf' => 'required|max:11',
                'email' => 'required|max:100',
                'nome' => 'required|max:60'

            ]
        );

        $cliente = Cliente::create($request->all());
        return \response($cliente);
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
        $cliente = Cliente::find($id);
       
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
        $cliente = Cliente::findOrFail($id)->update($request->all());
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
        Cliente::destroy($id);
        return \response( "O registro foi apagado");
    }

    
}
