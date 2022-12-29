<?php
$comando = $conexao->prepare("SELECT id_cronograma FROM cronograma WHERE id_estudante = ?");
$comando -> bindParam(1, $_SESSION['id_estudante']);
$comando -> execute();

if($comando -> rowCount() > 0){
    while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
        $id_cronograma = $linha->id_cronograma;
    }
}
else{
    $comando = $conexao->prepare("INSERT INTO cronograma (id_estudante) VALUES (?)");
    $comando -> bindParam(1, $_SESSION['id_estudante']);
    $comando -> execute();
    
    $comando = $conexao->prepare("SELECT id_cronograma FROM cronograma WHERE id_estudante = ?");
    $comando -> bindParam(1, $_SESSION['id_estudante']);
    $comando -> execute();
    if($comando -> rowCount() > 0){
        while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
            $id_cronograma = $linha->id_cronograma;
        }
    }
}