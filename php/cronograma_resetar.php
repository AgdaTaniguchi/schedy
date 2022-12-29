<?php
    session_start();

    require('conectar.php');
    require('cronograma_checkId.php');

    $comando = $conexao->prepare("SELECT (EXISTS(SELECT id_evento FROM evento WHERE id_cronograma = ? LIMIT 1)) AS existe");

    $comando -> bindParam(1, $id_cronograma);

    $comando -> execute();

    if($comando -> rowCount() > 0){
        while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
            if($linha->existe == 1){
                $comando = $conexao->prepare("DELETE FROM evento WHERE id_cronograma = ?");
                
                $comando -> bindParam(1, $id_cronograma);

                $comando -> execute();

                if($comando -> rowCount() > 0){
                    $retorno = true;
                }
            }
            else{
                $retorno = "Não há nenhum evento no cronograma.";
                goto retornar;
            }
        }
    }
    else{
        $retorno = "Não há nenhum evento no cronograma.";
        goto retornar;
    }

    retornar:
    echo $retorno;
?>