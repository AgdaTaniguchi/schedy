<?php

$nomeBanco = 'schedy';
$user = '';
$senhaBanco = '';

try{
    $conexao = new PDO("mysql:host=localhost; dbname=$nomeBanco", "$user", "$senhaBanco");
}
catch(PDOException $erro){
    echo 'Erro na conexão, entrar em contato com TI '.$erro->getMessage();
}
