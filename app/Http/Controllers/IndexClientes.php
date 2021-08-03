<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use App\Models\Cliente;




class IndexClientes extends Controller
{
    //

    public function index(Request $request){

        $tipoBusca = $request['tipoBusca'];
        $valorBusca = $request['valorBusca'];

        

        if(!isset($tipoBusca) || empty($tipoBusca)) :

            $url = '/api/clientes';

            elseif ($tipoBusca == 'cpf') :

            $url = '/api/clientes/cpf/'.$valorBusca;
            
            elseif ($tipoBusca == 'nome') :

            $url = '/api/clientes/nome/'.$valorBusca;
            
            elseif ($tipoBusca == 'email') :

            $url = '/api/clientes/email/'.$valorBusca;

        endif;

        

        $request = Request::create($url, 'GET');
        $response = Route::dispatch($request);
        $clientes = json_decode($response->getContent(), true);
       
        
        

        return view('index', compact('clientes'));

    }

    public function create(Request $request) {
        $erro = $request->session()->get('erro');
        $sucesso = $request->session()->get('sucesso');
        

        return view('formulariocliente', compact('erro','sucesso'));

    }
    
    public function editar(Request $request,  $id) {
        $erro = $request->session()->get('erro');
        $sucesso = $request->session()->get('sucesso');
        $cliente = Cliente::find($id);
        
              

        return view('formulariocliente', compact('sucesso','erro','cliente'));

    }

    

    public function updateCliente(Request $request, $id)
    {
        //
        $nome = $request->nome;
        $cpf = $request->cpf;
        $email = $request->email;
        $requisicao = Request::create('/api/clientes/'.$id, 'PUT', array(
            "nome"     => $nome,
            "cpf"    => $cpf,
            "email"    =>  $email
           
        ));           
        $responseInicial = Route::dispatch($requisicao);

        
        

        $response = json_decode($responseInicial->getContent(),true);

        $status = json_decode($responseInicial->status(),true);

        if ($status !== 200) :

            $request->session()
            ->flash(
            'erro',
            "Erro ao editar o cliente"
            );

        else:

            $request->session()
            ->flash(
            'sucesso',
            "Cliente editado com sucesso"
            );

        

        endif;

        
        return redirect('clientes/'.$id.'/editar');
        //$cliente = Cliente::findOrFail($id)->update($request->all());
        //return \response($cliente);
    }

    
    public function store(Request $request) {

        $nome = $request->nome;
        $cpf = $request->cpf;
        $email = $request->email;
        $numerosTelefone = $request->telefone;
        $tiposTelefone = $request->tipoTelefone;

        $requisicao = Request::create('/api/clientes', 'POST', array(
            "nome"     => $nome,
            "cpf"    => $cpf,
            "email"    =>  $email
           
        ));           
        $responseInicial = Route::dispatch($requisicao);

        
        

        $response = json_decode($responseInicial->getContent(),true);

        $status = json_decode($responseInicial->status(),true);

        if ($status !== 200) :

            $request->session()
            ->flash(
            'erro',
            "Erro ao criar o cliente"
            );


        return redirect('clientes/criar');

        endif;



        $idCliente = $response['id'];

        if(!empty($numerosTelefone) ) :

        

            $i = 0;

            foreach ($numerosTelefone as $numeroTelefone) :

                $tipoTelefone = (int)$tiposTelefone[$i];
                $numeroTelefone = (int)$numeroTelefone;

                  
                if(!empty($tipoTelefone) && !empty($numeroTelefone) ) :

                    
                    self::insereTelefone($idCliente, $tipoTelefone, $numeroTelefone);
                    

                endif;
                
                $i++;


            endforeach;

            

        endif;

        
        if ($status == 200) :

            $request->session()
            ->flash(
            'sucesso',
            "O cliente foi cadastrado com sucesso"
            );


        return redirect('http://127.0.0.1:8000/clientes/'. $idCliente .'/editar');

        endif;
        

    }

    public function insereTelefone($idCliente, $tipoTelefone, $numTelefone) {
        

        $array = array(
            "cliente_id"     => $idCliente,
            "telefone_tipo_id"    => $tipoTelefone,
            "numero"    =>  $numTelefone
        
        );

       
        
        $request_telefone = Request::create('api/telefones', 'POST', $array ); 

         
        $responseInicial = app()->handle($request_telefone);
        
        $status = json_decode($responseInicial->status(),true);

        

        return $status;

        

    }
}


