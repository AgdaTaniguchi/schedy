<section class="home">
    <div class="banner">
        <div class="controles">
            <i id="setaVolta" class="fas fa-angle-left"></i>
            <i id="setaAvanca" class="fas fa-angle-right"></i>
        </div>
        <?php
            $pasta = 'images/banners/';
            $arquivos = glob("$pasta{*.jpg,*.JPG,*.png}", GLOB_BRACE);
            
            $cont = 1;
            foreach($arquivos as $img){
                if($cont == 1){
                    echo "<img src=".$img.">";
                }
                else{
                    echo "<img src=".$img." style='display: none;'>";
                }
                $cont++;
            }
        ?>
        
    </div>
    <div class="sobre-nos">
        <div class="conteudo">
            <img src="images/logo.png">
            <div class="texto">
                <h1>Sobre Nós</h1>
                <p>O Schedy é um site que visa ajudar os estudantes, em especial os que irão prestar vestibular em breve. 
                    Disponibilizamos um cronograma para que você possa personalizá-lo com sua rotina. Com clareza, 
                    divulgamos datas e requisitos sobre os vestibulares. Também reunimos informações sobre vários métodos de estudo 
                    eficazes para o aprendizado, além de indicarmos outros sites com conteúdos confiáveis. É possível ainda fazer 
                    simulados com questões de vários vestibulares, podendo ver o seu desempenho nas matérias.</p>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1630529250">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
    <div class="cards">
        <div class="container-cards">
            <a href="login-cadastro" class="card">
                <div class="conteudo">
                    <img src="images/icones/calendario.png">
                    <span>Defina sua rotina com um cronograma personalizável!</span>
                </div>
            </a>
            <a href="metodos-de-estudo" class="card">
                <div class="conteudo">
                    <img src="images/icones/estudo.png">
                    <span>Veja quais formas de estudar são as mais eficazes!</span>
                </div>
            </a>
            <a href="fazer-simulado" class="card">
                <div class="conteudo">
                    <img src="images/icones/simulados.png">
                    <span>Realize simulados com questões oficiais, e veja seu desempenho!</span>
                </div>
            </a>
        </div>
        <div class="custom-shape-divider-bottom-1630529250">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
    <div class="equipe">
        <div class="conteudo">
            <h2>Equipe</h2>
            <div class="row">
                <div class="membro">
                    <img src="images/equipe/agda.png">
                    <h3>Agda Taniguchi</h3>
                </div>
                <div class="membro">
                    <img src="images/equipe/bia.png">
                    <h3>Beatriz Fregoneze</h3>
                </div>
                <div class="membro">
                    <img src="images/equipe/dani.png">
                    <h3>Daniela Sanomia</h3>
                </div>
            </div>
            <div class="row">
                <div class="membro">
                    <img src="images/equipe/araujo.png">
                    <h3>Lucas Gomes</h3>
                </div>
                <div class="membro">
                    <img src="images/equipe/veronica.png">
                    <h3>Verônica Zibordi</h3>
                </div>
                <div class="membro">
                    <img src="images/equipe/kenzo.png">
                    <h3>Vitor Kenzo</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/home.js"></script>