<?php
    include('conectar.php');

    filter_var($_POST['email-login'], FILTER_VALIDATE_EMAIL) == true ? $email = $_POST['email-login'] : $erro = "email";

    if(empty($email) || empty($senha)){
        $retorno = "Os campos de e-mail e o de senha não podem ser vazios.";
    }

    $comando = $conexao -> prepare('SELECT id_estudante, nome, foto FROM estudante WHERE email = ? AND senha = md5(?)');

    $comando -> bindParam(1, $email);
    $comando -> bindParam(2, $_POST['senha-login']);

    $comando -> execute();

    if($comando -> rowCount() > 0){
        $retorno = true;
        
        session_start();
        while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
            $_SESSION['id_estudante'] = $linha->id_estudante;
            $_SESSION['nome'] = $linha->nome;
            $_SESSION['foto'] = "sem-foto.png";
            if($linha->foto != ""){
                $_SESSION['foto'] = $linha->foto;
            }
        }
    }
    else{
        $retorno = "Verifique se o e-mail e a senha estão corretos!";
    }

    echo $retorno;
    