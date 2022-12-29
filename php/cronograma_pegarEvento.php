<?php

session_start();

function pegarEvento($conexao, $horario, $dia_semana){
    require('cronograma_checkId.php');
    
    $comando = $conexao->prepare("SELECT titulo, descricao, dia_semana, horario, receber_notificacao, cor FROM evento WHERE dia_semana = ? AND horario = ? AND id_cronograma = ?");
    
    $comando -> bindParam(1, $dia_semana);
    $comando -> bindParam(2, $horario);
    $comando -> bindParam(3, $id_cronograma);

    if(strlen($comando -> execute()) > 0){
        if($comando -> rowCount() > 0){
            $dados = $comando -> fetchAll();
           return json_encode($dados);
        }
        else{
            return false;
        }
    }
}