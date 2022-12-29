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

    // Localizando campo inválido
    if($erro == true){
        $retorno = "O campo $erro está inválido. Verifique e tente novamente.";
        goto retornar;
    }

    try{
        $novo_nome = null;
        session_start();

        // Editando no banco de dados
        require('conectar.php');

        // Checar se há nova foto
        if($_FILES['arquivo']['size'] != 0 && $_FILES['arquivo']['error'] == 0){
            // Adicionando a imagem na pasta
            $arquivo = $_FILES['arquivo'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

            if($extensao != "jpg" && $extensao != "jpeg" && $extensao != "png"){
                $retorno = "Tipo de arquivo inválido. Utilize jpg, jpeg ou png.";
                goto retornar;
            }

            $novo_nome = md5(uniqid($arquivo['name'])) .'.'. $extensao;
            $diretorio = "../images/usuarios/";

            $_SESSION['foto'] = $novo_nome;
        
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

            // Removendo antiga imagem na pasta
            $comando = $conexao -> prepare("SELECT foto FROM estudante WHERE id_estudante = ?");

            $comando -> bindParam(1, $_SESSION['id_estudante']);
            
            $comando -> execute();
            
            if($comando -> rowCount() > 0){
                while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                    $foto_antiga = $linha->foto;
                    if($foto_antiga != ""){
                        unlink('../images/usuarios/'.$foto_antiga);
                    }
                }
            }
        }
        else{
            $novo_nome = $_SESSION['foto'];
        }

        $_SESSION['nome'] = $nome;

        $comando = $conexao->prepare("UPDATE estudante SET nome = ?, celular = ?, email = ?, foto = ?, serie = ?, estado = ?, cidade = ?, nascimento = ? WHERE id_estudante = ?");

        $comando -> bindParam(1, $nome);
        $comando -> bindParam(2, $celular);
        $comando -> bindParam(3, $email);
        $comando -> bindParam(4, $novo_nome);
        $comando -> bindParam(5, $serie);
        $comando -> bindParam(6, $estado);
        $comando -> bindParam(7, $cidade);
        $comando -> bindParam(8, $data_nascimento);
        $comando -> bindParam(9, $_SESSION['id_estudante']);

        $comando -> execute();

        if($comando -> rowCount() > 0){
            $retorno = true;
            goto retornar;
        }
        else{
            $retorno = 'Erro no processo de alteração do usuário!';
            goto retornar;
        }
    }
    catch(PDOException $erro){
        $retorno = 'Erro na conexão, entrar em contato com TI '.$erro->getMessage();
    }

    retornar:
        echo $retorno;

?>