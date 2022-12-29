<?php
    class Usuario{
        public static function verificar_login(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function criar_cadastro(){
        }

        public static function fazer_login(){
            if(empty($_POST['email-login']) || empty($_POST['senha-login'])){
                header('Logcation: login-cadastro');
                exit();
            }

            $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
            $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

            $comando = "SELECT * FROM estudante WHERE nome = '{$usuario}' AND senha = md5('{$senha}')";

            $resultado = mysqli_query($conexao, $query, $comando);
            $row = mysqli_num_rows($result);
        }
    }
?>