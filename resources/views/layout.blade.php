<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefone Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3a7eb9fc06.js" crossorigin="anonymous"></script>

    
</head>
<body>

<div class="container">

    <div class = "jumbontron">

        <h1> @yield('titulo') </h1>

    </div>

    @yield('conteudo')

    

</div>

<script>

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

            function removeCliente(i) {

            //preventDefault();
            $(this).closest('form').remove();

            var url = "/api/telefones/cliente/"+i;
            console.log(url);


            $.ajax({
            method: "DELETE",
            url: "/api/telefones/cliente/"+i,

            })
            
            $.ajax({
            method: "DELETE",
            url: "/api/clientes/"+i,

            })

            location.reload();

            $("#msg").append('<div class="alert alert-danger"> Cliente apagado</div>');

            }



            var i = 
            
            <?php
            
            if(isset($l)) :
            
                if($l>0) :
                  echo $l - 1;
                  

                else:

                  echo 0;

                endif;

              else:

                echo 0;

              endif;
            
            ?>;

            
            var listaIndice = [];
            //https://api.jquery.com/click/
            $("#add-campo").click(function () {
              i++;
              var estado = new Boolean(false);
				//https://api.jquery.com/append/
                $("#telefones").append('<div id ="telefonePosicao'+i+'"class="form-group">'+
                '<label">Telefone: ' + i + '</label>'+
                '<select required class = "form-control" name = tipoTelefone[] id = "tipoTelefone'+ i +'"></select>' +
                '<div id="campoNumTelefone'+ i +'"></div>' +
                '<a href="#" class="removerCampoTelefone">Remover</a></div>');

                  $.getJSON('/api/tipostelefone', function (data) {

                  
                  var options = '<option value="">Escolha um tipo de telefone</option>';	
                      
                  $.each(data, function (key, val) {

                    if( val.whatsapp ) 

                     var whatsapp =   " (com Whatsapp)";

                     else 

                      var whatsapp =   "";

                     

                        

                    options += '<option value="' + val.id + '">' + capitalizeFirstLetter(val.tipo) + 
                    
                    whatsapp
                    
                    + '</option>';

                        });

                        $("#tipoTelefone"+i).html(options);

                        

                  });

                  
                  $("#telefones").on("change","#tipoTelefone"+i, function () {

                    
                    var existeIndice = listaIndice.includes(i);

                    if(!existeIndice) {

                      $("#campoNumTelefone"+i).append(' <input required class = "form-control" type="text" name="telefone[]" placeholder="Número de Telefone">')

                      listaIndice.push(i) ;
                    };


                    

                    });
                              });

           

           

            $("#telefones").on("click", ".removerCampoTelefone", function(e) {
            e.preventDefault();
            $(this).closest('form').remove();

            for(var j = 1; j<=i; j++) {

            }

            

            
            
              

          })
          
         

          function editarTelefone(i) {

            var tipoTelefone = document.getElementById("tipoTelefone"+i).value;
            var telefone = document.getElementById("telefone"+i).value;
            var idTelefone = document.getElementById("idTelefone"+i).value;

                          $.ajax({
                  url : "/api/telefones/"+i,
                  type : 'PUT',
                  data : {
                        telefone_tipo_id : tipoTelefone ,
                        numero : telefone
                  },
                  // beforeSend : function(){
                  //       $("#resultado").html("ENVIANDO...");
                  // }
              })
              .done(function(msg){
                $("#msg"+i).append('<div class="alert alert-success"> O registro foi alterado com sucesso</div>');
                
              })
              .fail(function(jqXHR, textStatus, msg){
                $("#msg"+i).append('<div class="alert alert-danger"> O registro não foi alterado</div>');
              });

          }

          function removerTelefone(i) {

            //preventDefault();
            $(this).closest('form').remove();

            $.ajax({
            method: "DELETE",
            url: "/api/telefones/"+i,
            
            })

            $("#msg"+i).append('<div class="alert alert-danger"> Registro apagado</div>');

          }

          function novoCampoTelefone(idCliente) {

            i++;
              var estado = new Boolean(false);
				//https://api.jquery.com/append/
                $("#telefones").append('<div id ="telefonePosicao'+i+'"class="form-group">'+
                '<label">Telefone: ' + i + '</label>'+
                '<div id = "msg'+ i + '"></div>' +
                '<select required class = "form-control" name = tipoTelefone[] id = "tipoTelefone'+ i +'"></select>' +
                '<div id="campoNumTelefone'+ i +'"></div>' +
                '<a href="#" class="removerCampoTelefone">Remover</a></div>');

                  $.getJSON('/api/tipostelefone', function (data) {

                  
                  var options = '<option value="">Escolha um tipo de telefone</option>';	
                      
                  $.each(data, function (key, val) {

                    if( val.whatsapp ) 

                      var whatsapp =   " (com Whatsapp)";

                      else 

                      var whatsapp =   "";

                    options += '<option value="' + val.id + '">' + capitalizeFirstLetter(val.tipo) + 

                    whatsapp
                    
                    + '</option>';

                        });

                        $("#tipoTelefone"+i).html(options);

                        

                  });

                  
                  $("#telefones").on("change","#tipoTelefone"+i, function () {

                    
                    var existeIndice = listaIndice.includes(i);

                    if(!existeIndice) {

                      $("#campoNumTelefone"+i).append(' <input required id = "numTelefone'+ i + '"class = "form-control" type="text" name="telefone[]" placeholder="Número de Telefone">')
                      $("#campoNumTelefone"+i).append(' <input type = hidden id = "idCliente'+ i + '" value = "'+ idCliente +'">')
                      $("#campoNumTelefone"+i).append(' <button onclick="salvarTelefone('+ i +')"; class = "mt-2 btn btn-primary" type="button" id="add-campo-editar"> Salvar Telefone </button>')

                      listaIndice.push(i) ;
                    };


                    

                    });


          }

          function salvarTelefone(i) {

                var tipoTelefone = document.getElementById("tipoTelefone"+i).value;
                var telefone = document.getElementById("numTelefone"+i).value;
                var idCliente = document.getElementById("idCliente"+i).value;

                console.log(tipoTelefone);

                console.log(telefone);

                console.log(idCliente);
                

                      $.ajax({
                      url : "/api/telefones",
                      type : 'POST',
                      data : {
                            cliente_id  : idCliente,
                            telefone_tipo_id : tipoTelefone ,
                            numero : telefone
                      },
                      // beforeSend : function(){
                      //       $("#resultado").html("ENVIANDO...");
                      // }
                  })
                  .done(function(msg){
                    $("#msg"+i).append('<div class="alert alert-success"> O telefone foi salvo com sucesso</div>');
                    
                  })
                  .fail(function(jqXHR, textStatus, msg){
                    $("#msg"+i).append('<div class="alert alert-danger"> O telefone não foi salvo</div>');
                  });

                }



          

          


        </script>
    
</body>
</html>