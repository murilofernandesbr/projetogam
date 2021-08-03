<?php
use \App\Http\Controllers\TelefonesController;
use \App\Http\Controllers\TipoController;

?>

@extends('layout')

@section('titulo')

Lista de Clientes

@endsection

@section('conteudo')

    <td><a href = "/clientes/criar"> <button  type="button" class="btn btn-dark mb-2">Criar Cliente</button></a></td>
    <div class = "container">
        <form class = "col-6-md" method = "get" action = "{{ url('clientes') }}">

            <input id = "valorBusca" name="valorBusca" type = "text" class = "form-control">

              <div class="form-check">
              <input class="form-check-input" type="radio" name="tipoBusca" id="cpf" value="cpf" checked>
              <label class="form-check-label" for="cpf">
                        CPF
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoBusca" id="nome" value="nome">
                    <label class="form-check-label" for="nome">
                        Nome
                    </label>
                    </div>
                    
                 <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoBusca" id="email" value="email">
                    <label class="form-check-label" for="email">
                        E-mail
                    </label>
            </div>

            <button class = "mt-2 btn btn-primary">Buscar</button>

        </form>

        <a href = "{{ url('clientes') }}"> <button class = "mt-2 btn btn-primary">Ver todo os resultados</button> </a>

    </div>
    
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">CPF</th>
            <th scope="col">Telefones</th>
            <th scope="col">Criado em:</th>
            <th scope="col">Atualizado em:</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                    
                 if($clientes) :
            foreach ($clientes as $cliente):

                $clienteId = $cliente['id'];
                $clienteNome = $cliente['nome'];
                $clienteEmail = $cliente['email'];
                $clienteCPF = $cliente['cpf'];
                //2021-07-28T20:52:53.000000Z	
                $clienteDataCriacao = substr($cliente['created_at'],0,10) . ' ' .substr($cliente['created_at'],11,8);
                $clienteDataAtualizacao = substr($cliente['updated_at'],0,10) . ' ' .substr($cliente['updated_at'],11,8);
                $telefonesCliente = TelefonesController::consultaTelCliente($clienteId);

            ?>

            <tr>
            <th scope="row"><?php echo $clienteId; ?></th>
            <td><?php echo $clienteNome; ?></td>
            <td><?php echo $clienteEmail; ?></td>
            <td><?php echo $clienteCPF; ?></td>
            <td>
                
                <?php
                if($telefonesCliente):
                foreach ($telefonesCliente as $telefoneCliente) : 
                    $numeroTelefone = $telefoneCliente['numero'];
                    $idTipoTelefone = $telefoneCliente['telefone_tipo_id'];
                    $retornoTipoTelefone = TipoController::consultaTipotel($idTipoTelefone);
                    $tipoTelefone = ucfirst($retornoTipoTelefone['tipo']);
                    $telefoneWhatsapp = $retornoTipoTelefone['whatsapp'];
                    ?>

                    <?php echo $numeroTelefone . ' - ' . $tipoTelefone ;
                    
                    if( ($telefoneWhatsapp) ) :
                    
                    ?>

                        <i class="fa fa-whatsapp" aria-hidden="true"></i>


                    <?php endif; ?>


                    <br>
                    

                <?php endforeach; endif;?>
            
           </td>
            <td><?php echo date("d/m/Y h:m:s", strtotime($clienteDataCriacao)) ;  ?></td>
            <td><?php echo date("d/m/Y h:m:s", strtotime($clienteDataAtualizacao));  ?></td>
            <td><a href = "/clientes/{{$clienteId}}/editar"> <button type="button" class="btn btn-dark mb-2">Editar Cliente</button> </a>
            <button onclick="removeCliente({{$clienteId}})" type="button" class="btn btn-danger">Excluir Cliente</button>

            </td>
            
            
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

@endsection