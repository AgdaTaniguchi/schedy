<?php
    require 'conectar.php';

    session_start();

    $questoes = [];
    $id_simulado = 0;

    if(isset($_SESSION['id_estudante'])){
        // Inserindo o simulado
        $comando = $conexao->prepare('INSERT INTO simulado (tipo, data, id_estudante) VALUES ("ENEM", now(), '.$_SESSION['id_estudante'].')');
        $comando->execute();
    
        // Pegando o id do simulado
        $comando = $conexao->prepare("SELECT id_simulado FROM simulado WHERE id_estudante = ".$_SESSION['id_estudante']." ORDER BY id_simulado DESC LIMIT 1");
    
        if(strlen($comando -> execute()) > 0){
            if($comando -> rowCount() > 0){
                while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                    $id_simulado = $linha->id_simulado;
                }
            }
        }
    }

    foreach ($_POST as $key => $valor) {
        $sql_alternativas = $conexao->prepare('SELECT alternativa.id_alternativa, alternativa.texto, alternativa.esta_certa, alternativa.id_questao, conteudo.nome AS conteudo, materia.nome AS materia
        FROM alternativa
        INNER JOIN questao
        ON questao.id_questao = alternativa.id_questao
        INNER JOIN conteudo
        ON conteudo.id_conteudo = questao.id_conteudo
        INNER JOIN materia
        ON materia.id_materia = conteudo.id_materia
        WHERE alternativa.id_alternativa = ?');
        $sql_alternativas->BindParam(1, $valor);
        $sql_alternativas->execute();

        while ($linha = $sql_alternativas->fetch(PDO::FETCH_OBJ)) {
            $questao = new stdClass();
            $questao->questao_numero = substr($key, 8);
            $questao->esta_certa = $linha->esta_certa == 1 ? true : false;
            $questao->conteudo = $linha->conteudo;
            $questao->materia = $linha->materia;
            array_push($questoes, $questao);

            if($id_simulado != 0){
                $comando = $conexao->prepare('INSERT INTO questao_simulado VALUES (NULL, ?, ?, ?)');
    
                $comando->BindParam(1, $questao->esta_certa);
                $comando->BindParam(2, $questao->questao_numero);
                $comando->BindParam(3, $id_simulado);
                $comando->execute();
            }
        }
    }
    
    $retornojson = json_encode($questoes);

    echo $retornojson;
?>