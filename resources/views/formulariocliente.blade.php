<?php
use \App\Http\Controllers\TelefonesController;
use \App\Http\Controllers\TipoController;

?>
@extends('layout')

@section('titulo')

@if (empty($cliente->id) )

Cadastrar Cliente

@else

Editar Cliente

@endif


@endsection

@section('conteudo')


     

    @if(!empty($sucesso))
        <div class="alert alert-success">
            {{ $sucesso }}
        </div>
    @endif
    
    @if(!empty($erro))
        <div class="alert alert-danger">
            {{ $erro }}
        </div>
    @endif

    @if(isset($cliente) )

    @endif
    <?php if (empty($cliente->id) ) : ?>

        <form method = "post">

    <?php else : ?>

        <form method = "post" action = "{{ route('alterarCliente', $cliente->id) }}">

    <?php endif; ?>
    @csrf
        <div class = "form-group">

            <label for ="nome">Nome</label>
            <input type ="text" class = "form-control" name = "nome" id = "nome" value = "<?php if (!empty($cliente->nome) ) : echo $cliente->nome; else : ""; endif; ?>">
            
            <label for ="cpf">CPF</label>
            <input type ="text" class = "form-control" name = "cpf" id = "cpf" value = "<?php if (!empty($cliente->cpf) ) : echo $cliente->cpf; else : ""; endif; ?>">
            
            <label for ="cpf">E-mail</label>
            <input type ="text" class = "form-control" name = "email" id = "email" value = "<?php if (!empty($cliente->email) ) : echo $cliente->email; else : ""; endif; ?>">
            <?php if (empty($cliente->id) ) : ?>
                <div id="telefones" class = "mt-2">
                    <div class="form-group">
                    <label>Adicionar Telefone: </label>
                    <button class = "mt-2 btn btn-primary" type="button" id="add-campo"> + </button>
                    </div>
                </div>

            <?php endif; ?>
            
                    
                
          </div>

        

          <?php if (empty($cliente->id) ) : ?>

                <button class = "mt-2 btn btn-primary">Criar</button>

             <?php else: ?>

                <button class = "mt-2 btn btn-primary">Editar</button>

          <?php endif; ?>

          </form>

          <?php if (!empty($cliente->id) ): ?>
                <div id="telefones" class = "mt-2">
                    <div class="form-group">
                        <label>Telefones: </label>

                        <button onclick="novoCampoTelefone({{$cliente->id}})"; class = "mt-2 btn btn-primary" type="button" id="add-campo-editar"> + </button>

                        <?php 
                        $i = 1;
                        $telefonesCliente = TelefonesController::consultaTelCliente($cliente->id); 
                        $tiposTelefone = TipoController::listaTipoTel();
                        
                        if($telefonesCliente) :
                        foreach ($telefonesCliente as $telefoneCliente) : 
                        
                            

                            $telefoneId = $telefoneCliente['id'];
                            $numero = $telefoneCliente['numero'];
                            $telefoneTipoId = $telefoneCliente['telefone_tipo_id'];
                        
                        ?>

                        <form id = "telefone{{$telefoneId}}" action = "">
                        <div id = "msg{{$telefoneId}}">
                         </div>
                         
                        
                            <div class="group"><label id = "telefonePosicao" >Telefone {{$i}}:</label>
                                
                                <select required="" class="form-control" name="tipoTelefone[]" id="tipoTelefone{{$telefoneId}}">
                            
                                <?php
                                    foreach ($tiposTelefone as $arrayTelefone => $tipoTelefone) :
                                        $idTipoTelefone = $tipoTelefone['id'];
                                        $tipoTelefone = $tipoTelefone['tipo'];
                                       
                                ?>

                                        <option value="{{$idTipoTelefone}}"
                                        
                                            <?php

                                                if($telefoneTipoId == $idTipoTelefone) :

                                                        echo 'selected';

                                                endif;

                                            ?>

                                        ><?php echo ucfirst($tipoTelefone); ?>
                                    
                                    
                                    </option>

                                <?php endforeach; ?>
                            
                                </select>
                            <div id="campoNumTelefone{{$i}}"> 
                                <input required="" class="form-control" type="text" id = "telefone{{$telefoneId}}" name="telefone[]" placeholder="Número de Telefone" value = "{{$numero}}">
                                <input type = "hidden" id = "idTelefone{{$telefoneId}}" class = "idTelefone" value = "{{$telefoneId}}" >
                            </div>
                            <a onclick="removerTelefone({{$telefoneId}}); return false" class="removerCampoTelefone">Remover</a>
                            <button onclick="editarTelefone({{$telefoneId}}); return false" id = "editarTel" class = "mt-2 btn btn-primary">Editar</button>
                            </div>
                        </form>                         
                        <?php $i++; endforeach; endif; ?>
                        
                        
                    </div>
                </div>

            <?php endif; ?>

            <?php 
                    $l = 0;
                    
                    if(isset($cliente) ) :
                        $l = $i;
                    endif; 
                    
           ?>

        </div>

        

    

    

@endsection