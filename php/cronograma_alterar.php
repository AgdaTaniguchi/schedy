<?php
$err = false;
$retorno = null;

$evento = !empty($_POST['evento']) ? filter_var($_POST['evento'], FILTER_SANITIZE_STRING) : $retorno = 'Adicione um nome ao evento.';
$dias_semana = [];
$domingo = isset($_POST['domingo']) ? array_push($dias_semana, 'dom') : null;
$segunda = isset($_POST['segunda']) ? array_push($dias_semana, 'seg') : null;
$terca = isset($_POST['terca']) ? array_push($dias_semana, 'ter') : null;
$quarta = isset($_POST['quarta']) ? array_push($dias_semana, 'qua') : null;
$quinta = isset($_POST['quinta']) ? array_push($dias_semana, 'qui') : null;
$sexta = isset($_POST['sexta']) ? array_push($dias_semana, 'sex') : null;
$sabado = isset($_POST['sabado']) ? array_push($dias_semana, 'sab') : null;
$horario = !empty($_POST['horario']) ? filter_var($_POST['horario']) : $retorno = 'Adicione um horário ao evento';
$descricao = isset($_POST['descricao']) ? filter_var($_POST['descricao'], FILTER_SANITIZE_STRING) : null;
$notificar = $_POST['notificar'];
$cor = isset($_POST['cor']) ? $_POST['cor'] : null;

if(count($dias_semana) == 0){
    $retorno = 'Selecione pelo menos um dia da semana!';
}

if(!is_null($retorno)){
    $err = true;
}

if($err == false){
    try{
        require('conectar.php');
        require('cronograma_pegarEvento.php');
        require('cronograma_checkId.php');

        forEach($dias_semana as $dia_semana){
            $jaExiste = pegarEvento($conexao, $horario, $dia_semana);
            if(!$jaExiste){
                $retorno = "Verifique o(s) dia(s) da semana e o horário.";
                goto retornar;
            }
        }

        forEach($dias_semana as $dia_semana){
            // Adicionar por último depois o id_cronograma
            $comando = $conexao->prepare("UPDATE evento SET titulo = ?, descricao = ?, dia_semana = ?, horario = ?, receber_notificacao = ?, cor = ? WHERE horario = ? AND dia_semana = ? AND id_cronograma = ?");
            
            $comando -> bindParam(1, $evento);
            $comando -> bindParam(2, $descricao);
            $comando -> bindParam(3, $dia_semana);
            $comando -> bindParam(4, $horario);
            $comando -> bindParam(5, $notificar);
            $comando -> bindParam(6, $cor);
            $comando -> bindParam(7, $horario);
            $comando -> bindParam(8, $dia_semana);
            $comando -> bindParam(9, $id_cronograma);
            
            $comando -> execute();
        }
        
        if($comando -> rowCount() > 0){
            $retorno = true;
            goto retornar;
        }
        else{
            $retorno = 'Erro no processo de alteração do evento!';
            goto retornar;
        }
    }
    catch(PDOException $erro){
        $retorno = 'Erro na conexão, entrar em contato com TI '.$erro->getMessage();
    }
}

retornar:
echo $retorno;