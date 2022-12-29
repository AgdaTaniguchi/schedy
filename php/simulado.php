<?php
require 'conectar.php';

$qtde_questoes = $_POST['quantidade-questoes'];
$sql_questoes = $conexao->prepare('SELECT id_questao, enunciado, numero_questao FROM questao ORDER BY RAND () LIMIT ?');
$sql_questoes->bindParam(1, $qtde_questoes, PDO::PARAM_INT);
$sql_questoes->execute();
$questoes = $sql_questoes->fetchAll(PDO::FETCH_ASSOC);

foreach ($questoes as $key => $questao) {
    $sql_alternativas = $conexao->prepare('SELECT id_alternativa, texto FROM alternativa WHERE id_questao = ? ORDER BY RAND ()');
    $sql_alternativas->bindParam(1, $questao["id_questao"]);

    $sql_alternativas->execute();

    $alternativas = $sql_alternativas->fetchAll(PDO::FETCH_ASSOC);

    $questoes[$key]["alternativas"] = $alternativas;
}

$retornojson = json_encode($questoes);

echo $retornojson;
?>
