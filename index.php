<?php
    include('config.php');
?>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/contato.css">
        <title>Schedy</title>
        <link rel="icon" href="images/logo.png">
        <script src="bibliotecas/jquery.js"></script>
        <script src="js/script.js"></script>
        <link href="bibliotecas/fontawesome/css/all.css" rel="stylesheet">
    </head>
    <body>
        <?php
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        ?>    
        <header>
            <nav>
                <ul>
                    <li><i id="menu-hamburguer" class="fas fa-bars"></i></li>
                    <li><a href="home"><img id="logo" src="images/logo_2.png"></a></li>
                    <div class="links">
                        <li><a class="link" href="home">Página inicial</a></li>
                        <li><a class="link" href="metodos-de-estudo">Métodos de estudo</a></li>
                        <li><a class="link" href="vestibulares">Vestibulares</a></li>
                        <li><a class="link" href="fazer-simulado">Simulados</a></li>
                        <li><a class="link" href="contato">Contato</a></li>
                    </div>
                    <?php
                        // Não tem session
                        if(!isset($_SESSION['id_estudante'])) {
                            echo '<li><a href="login-cadastro"><i class="far fa-user-circle"></i></a></li>';
                        }
                        // Tem session
                        else{
                            echo '<li><a id="user" href="perfil"><img id="user" src="images/usuarios/'.$_SESSION['foto'].'"><span id="user-nome">'.$_SESSION['nome'].'</span></a></li>';
                        }
                    ?>
                </ul>
            </nav>
        </header>
        <div class="header2"></div>
        <main>
            <div class="fundo-menu none"></div>
            <?php
                if(file_exists('pages/'.$url.'.php')){
                    include('pages/'.$url.'.php');
                }
                else if(file_exists('pages/'.$url.'.html')){
                    include('pages/'.$url.'.html');
                }
                else{
                    include('pages/erro404.html');
                }
            ?>

        </main>
        <footer>
            <div class="conteudo">
                <div class="container">
                    <a href="home"><img id="logo" src="images/logo_2.png"></a>
                </div>
                <div class="container">
                    <ul>
                        <li>Redes sociais</li>
                        <li><a href="https://www.instagram.com/schedyinc/" target="_blank"><i class="fab fa-instagram"></i>Schedy</a></li>
                        <li><a href="https://www.facebook.com/schedyinc" target="_blank"><i class="fab fa-facebook"></i>Schedy</a></li>
                        <li><a href="https://www.youtube.com/channel/UC-NWoeRnDovGTdByHSzjW3Q" target="_blank"><i class="fab fa-youtube"></i>Schedy</a></li>
                    </ul>
                </div>
                <div class="container">
                    <ul>
                        <li>Contato</li>
                        <li><a href="contato"><i class="far fa-envelope"></i>contato.schedy@gmail.com</a></li>
                        <li><a href="#"><i class="fas fa-phone-alt"></i></i>(11) 96532-9799</a></li>
                    </ul>
                </div>
                <div class="container">
                    <div class="frase">
                        <i class="fas fa-quote-left"></i>
                        <p>Sucesso não é a chave para a felicidade; felicidade é a chave para o sucesso. Se você ama o que faz, você será bem sucedido.</p>
                        <i class="fas fa-quote-right"></i>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>