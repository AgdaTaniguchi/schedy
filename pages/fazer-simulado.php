<script src="js/fazer-simulado.js"></script>
<section class="fazer-simulado">
    <div class="conteudo">
        <div class="container-desc">
            <h2>Simulados</h2>
            <p>Aqui você pode iniciar um simulado com a quantidade de questões que desejar e utilizar um cronômetro para ter controle do seu tempo. Além disso, você também pode acessar o seu histórico de simulados para verificar os resultados de cada tentativa.</p>
        </div>

        <section class="container-grande">
        <h2>Faça um simulado!</h2>
        <div class="container container-novo-simulado">
            <form action="simulado">
                <div class="box-left">
                    <div class="box-input">
                        <label for="quantidade-questoes">Quantidade de questões:</label>
                        <select name="quantidade-questoes" id="quantidade-questoes">
                            <option value="2">2</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="box-input">
                        <label for="mostrar-tempo">Mostrar tempo:</label>
                        <input type="checkbox" name="mostrar-tempo" id="mostrar-tempo" onchange="check();">
                    </div>
                </div>
                <div class="box-right">
                    <input type="submit" value="Iniciar simulado">
                </div>
            </form>
        </div>
        </section>

        <section class="container-grande">
            <h2>Histórico de simulados</h2>
            <?php
                require 'php/conectar.php';

                if(! isset($_SESSION['id_estudante'])) {
                    echo "<div class='container container-historico'>
                    <div class='box-left'>
                        <p>Crie uma conta ou faça login para salvar seu histórico de simulados!</p>
                    </div>
                    <div class='box-right'>
                        <a href='login-cadastro' style='margin-top: 0;'>Criar conta ou logar</a>
                    </div>
                    </div>";
                }
                else{
                    $comando = $conexao -> prepare("SELECT id_simulado, tempo, data FROM simulado WHERE id_estudante = ".$_SESSION['id_estudante']." ORDER BY id_simulado DESC LIMIT 3");

                    if(strlen($comando -> execute()) > 0 && $comando -> rowCount() > 0){
                        while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
                            $id_simulado = $linha -> id_simulado; 
                            $tempo = $linha -> tempo;
                            $data = new DateTime($linha -> data);

                            $comando2 = $conexao -> prepare("SELECT count(*) AS quantidade_total FROM questao_simulado WHERE id_simulado = $id_simulado");

                            if(strlen($comando2 -> execute()) > 0 && $comando -> rowCount() > 0){
                                while($linha = $comando2 -> fetch(PDO::FETCH_OBJ)){
                                    $total = $linha->quantidade_total;
                                }
                            }
                            
                            $comando2 = $conexao -> prepare("SELECT count(*) AS quantidade_acertos FROM questao_simulado WHERE id_simulado = $id_simulado AND usuario_acertou = 1");
                            if(strlen($comando2 -> execute()) > 0 && $comando -> rowCount() > 0){
                                while($linha = $comando2 -> fetch(PDO::FETCH_OBJ)){
                                    $acertos = $linha->quantidade_acertos;
                                }
                            }

                            echo "<div class='container container-historico'>
                                <div class='box-left'>
                                    <p>Questões acertadas:<span>$acertos/$total</span></p>
                                    <p>Data:<span>".$data->format('d/m/Y')."</span></p>
                                    <p>Tempo:<span>$tempo</span></p>
                                </div>
                                <div class='box-right'>
                                    <a href='simulado-resultado'>Analisar resultados</a>
                                </div>
                            </div>";
                        }
                    }
                    else{
                        echo "<div class='container container-historico'>
                            <div class='box-left'>
                                <p>Você ainda não realizou nenhum simulado por enquanto!</p>
                            </div>
                        </div>";
                    }
                }
            ?>
        </section>
    </div>
</section>
