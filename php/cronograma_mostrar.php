<?php
    require('conectar.php');
    require('cronograma_checkId.php');

    $diasSemanas = ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab'];
                
    $comando = $conexao->prepare('SELECT horario, cor, count(*) as quantidade FROM evento WHERE id_cronograma = ? GROUP BY horario');
    $comando -> bindParam(1, $id_cronograma);

    if(strlen($comando -> execute()) > 0){
        if($comando -> rowCount() > 0){
            while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                echo "<tr>";
                echo "<td class='td-horario'>".date('H:i', strtotime($linha->horario))."</td>";

                foreach ($diasSemanas as $diaSemana) {
                    if(checkEvento($conexao, $linha->horario, $diaSemana)){
                        colocaTD($conexao, $diaSemana, $linha->horario);
                    }
                    else{
                        echo "<td>-</td>";
                    }
                }
            }
        }
        else{
            echo "<td colspan='8' id='nenhum-evento' style='border-radius: 0 0 30px 30px'>Nenhum evento por enquanto!</td>";
        }
    }

    function checkEvento($conexao, $horario, $diaSemana){
        require('cronograma_checkId.php');

        $comando = $conexao->prepare("SELECT horario, dia_semana FROM evento WHERE horario = '$horario' AND dia_semana = '$diaSemana' AND id_cronograma = '$id_cronograma'");

        if(strlen($comando -> execute()) > 0){
            if($comando -> rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }        
    }

    function colocaTD($conexao, $diaSemana, $horario){
        require('cronograma_checkId.php');
        
        $comando = $conexao->prepare("SELECT titulo, descricao, cor FROM evento WHERE dia_semana = '$diaSemana' AND horario = '$horario' AND id_cronograma = '$id_cronograma'");

        if(strlen($comando -> execute()) > 0){
            if($comando -> rowCount() > 0){
                while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                    if($linha->cor == ''){
                        echo "<td><div class='evento'>".ucfirst(($linha->titulo))."</div></td>";
                    }
                    else{
                        echo "<td><div class='evento' style='background-color: #$linha->cor'>".ucfirst(($linha->titulo))."</div></td>";
                    }
                }
            }
        }
    }
?>