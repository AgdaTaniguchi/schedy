<?php
    $erro = false;

    filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS) == true ? $nome = $_POST['nome'] : $erro = "nome";
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true ? $email = $_POST['email'] : $erro = "email";
    filter_var($_POST['celular'], FILTER_SANITIZE_NUMBER_INT) == true ? $celular = $_POST['celular'] : $erro = "celular";
    $data_nascimento = $_POST['data-nascimento'];
    $estado = $_POST['estado'];
    if(! empty($_POST['cidade'])){
        filter_var($_POST['cidade'], FILTER_SANITIZE_STRING) == true ? $cidade = $_POST['cidade'] : $erro = "cidade";
    }
    $serie = $_POST['serie'];

    if($erro == false){
        require('conectar.php');

        $comando = $conexao -> prepare('SELECT (EXISTS(SELECT nome FROM estudante WHERE celular = ? OR email = ?)) AS existe');

        $comando -> bindParam(1, $celular);
        $comando -> bindParam(2, $email);

        $comando -> execute();
        
        if($comando -> rowCount() > 0){
            while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                if($linha->existe == 1){
                    $retorno = "Já existe um cadastro com esse e-mail ou número de celular!";
                    goto retornar;
                }
            }
        }

        try{
            $comando = $conexao -> prepare('INSERT INTO estudante (nome, senha, email, celular, nascimento, estado, cidade, serie) VALUES (?, md5(?), ?, ?, ?, ?, ?, ?)');
            $comando -> bindParam(1, $nome);
            $comando -> bindParam(2, $_POST['senha']);
            $comando -> bindParam(3, $email);
            $comando -> bindParam(4, $celular);
            $comando -> bindParam(5, $data_nascimento);
            $comando -> bindParam(6, $estado);
            $comando -> bindParam(7, $cidade);
            $comando -> bindParam(8, $serie);

            $comando -> execute();

            if($comando -> rowCount() > 0){
                session_start();
                $retorno = true;

                $comando2 = $conexao->prepare('SELECT id_estudante, nome FROM estudante WHERE email = ? AND celular = ?');

                $comando2 -> bindParam(1, $email);
                $comando2 -> bindParam(2, $celular);

                $comando2 -> execute();

                if($comando -> rowCount() > 0){
                    while($linha = $comando2 -> fetch(PDO::FETCH_OBJ)){
                        $_SESSION['id_estudante'] = $linha->id_estudante;
                        $_SESSION['nome'] = $linha->nome;
                        $_SESSION['foto'] = "sem-foto.png";
                    }
                }

                goto retornar;
            }
            else{
                $retorno = 'Erro no processo de cadastro! Tente novamente mais tarde.';
                goto retornar;
            }
        }
        catch(PDOException $erro){
            $retorno = 'Erro na conexão, entrar em contato com TI '.$erro->getMessage();
        }
    }
    else{
        $retorno = "O campo $erro está inválido. Verifique e tente novamente.";
    }

    retornar:
    echo $retorno;