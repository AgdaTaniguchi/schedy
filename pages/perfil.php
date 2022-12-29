<?php
    if(! isset($_SESSION['id_estudante'])){
        header('Location: login-cadastro');
    }

    include('php/conectar.php');

    $comando = $conexao -> prepare('SELECT * FROM estudante WHERE id_estudante = ?');

    $comando -> bindParam(1, $_SESSION['id_estudante']);
    
    $comando -> execute();
    
    if($comando -> rowCount() > 0){
        $retorno = true;
        
        while($linha = $comando -> fetch(PDO::FETCH_OBJ)){
?>

<section class="perfil">
    <div class="conteudo">
        <div class="box-menu">
            <div class="img-perfil">
                <div class="altere-sua-foto">
                    <img id="alterar-imagem" src="images/usuarios/altere-sua-foto.png">
                </div>
                <?php
                    if(!empty($_SESSION['foto'])){
                        echo '<img id="img-user" src="images/usuarios/'.$_SESSION['foto'].'">';
                    }
                    else{
                        echo '<img id="img-user" src="images/usuarios/sem-foto.png">';
                    }
                ?>
            </div>
            <div class="itens">
                <span id="spnInfo" class="selecionado">Informações pessoais</span>
                <span id="spnHistorico">Histórico</span>
                <a href="cronograma">Cronograma <i class="fas fa-external-link-alt"></i></a>
                <a href="php/usuario_sair.php">Sair</a>
            </div>
        </div>
        <div class="box-principal informacoes-pessoais">
            <form action="php/usuario_alterar.php" method="POST" id="informacoes-pessoais">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome aqui" value="<?php echo $linha->nome; ?>">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail aqui" value="<?php echo $linha->email; ?>">
                <div class="mesma-linha">
                    <div class="w50">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" id="celular" placeholder="Digite seu celular aqui" value="<?php echo $linha->celular; ?>">
                    </div>
                    <div class="w50">
                        <label for="data-nascimento">Data de nascimento:</label>
                        <input type="date" name="data-nascimento" id="data-nascimento" value="<?php echo $linha->nascimento; ?>">
                    </div>
                </div>
                <div class="mesma-linha">
                    <div class="w25">
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado">
                            <option value=""></option>
                            <option value="AC" <?php echo ($linha->estado == "AC") ? "selected" : ""; ?>>AC</option>
                            <option value="AL" <?php echo ($linha->estado == "AL") ? "selected" : ""; ?>>AL</option>
                            <option value="AP" <?php echo ($linha->estado == "AP") ? "selected" : ""; ?>>AP</option>
                            <option value="AM" <?php echo ($linha->estado == "AM") ? "selected" : ""; ?>>AM</option>
                            <option value="BA" <?php echo ($linha->estado == "BA") ? "selected" : ""; ?>>BA</option>
                            <option value="CE" <?php echo ($linha->estado == "CE") ? "selected" : ""; ?>>CE</option>
                            <option value="ES" <?php echo ($linha->estado == "ES") ? "selected" : ""; ?>>ES</option>
                            <option value="GO" <?php echo ($linha->estado == "GO") ? "selected" : ""; ?>>GO</option>
                            <option value="MA" <?php echo ($linha->estado == "MA") ? "selected" : ""; ?>>MA</option>
                            <option value="MT" <?php echo ($linha->estado == "MT") ? "selected" : ""; ?>>MT</option>
                            <option value="MS" <?php echo ($linha->estado == "MS") ? "selected" : ""; ?>>MS</option>
                            <option value="MG" <?php echo ($linha->estado == "MG") ? "selected" : ""; ?>>MG</option>
                            <option value="PA" <?php echo ($linha->estado == "PA") ? "selected" : ""; ?>>PA</option>
                            <option value="PB" <?php echo ($linha->estado == "PB") ? "selected" : ""; ?>>PB</option>
                            <option value="PR" <?php echo ($linha->estado == "PR") ? "selected" : ""; ?>>PR</option>
                            <option value="PE" <?php echo ($linha->estado == "PE") ? "selected" : ""; ?>>PE</option>
                            <option value="PI" <?php echo ($linha->estado == "PI") ? "selected" : ""; ?>>PI</option>
                            <option value="RR" <?php echo ($linha->estado == "RR") ? "selected" : ""; ?>>RR</option>
                            <option value="RO" <?php echo ($linha->estado == "RO") ? "selected" : ""; ?>>RO</option>
                            <option value="RJ" <?php echo ($linha->estado == "RJ") ? "selected" : ""; ?>>RJ</option>
                            <option value="RN" <?php echo ($linha->estado == "RN") ? "selected" : ""; ?>>RN</option>
                            <option value="RS" <?php echo ($linha->estado == "RS") ? "selected" : ""; ?>>RS</option>
                            <option value="SC" <?php echo ($linha->estado == "SC") ? "selected" : ""; ?>>SC</option>
                            <option value="SP" <?php echo ($linha->estado == "SP") ? "selected" : ""; ?>>SP</option>
                            <option value="SE" <?php echo ($linha->estado == "SE") ? "selected" : ""; ?>>SE</option>
                            <option value="TO" <?php echo ($linha->estado == "TO") ? "selected" : ""; ?>>TO</option>
                        </select>
                    </div>
                    <div class="w75">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade que você mora aqui" value="<?php echo $linha->cidade; ?>">
                    </div>
                </div>
                <label for="serie">Série escolar:</label>
                <select name="serie" id="serie">
                    <option value=""></option>
                    <option value="NON" <?php echo ($linha->serie == "NON") ? "selected" : ""; ?>>Não estou cursando no momento</option>
                    <option value="EJA" <?php echo ($linha->serie == "EJA") ? "selected" : ""; ?>>EJA</option>
                    <option value="3EM" <?php echo ($linha->serie == "3EM") ? "selected" : ""; ?>>3º ano do Ensino Médio</option>
                    <option value="2EM" <?php echo ($linha->serie == "2EM") ? "selected" : ""; ?>>2º ano do Ensino Médio</option>
                    <option value="1EM" <?php echo ($linha->serie == "1EM") ? "selected" : ""; ?>>1º ano do Ensino Médio</option>
                    <option value="9EF" <?php echo ($linha->serie == "9EF") ? "selected" : ""; ?>>9º ano do Ensino Fundamental</option>
                    <option value="8EF" <?php echo ($linha->serie == "8EF") ? "selected" : ""; ?>>8º ano do Ensino Fundamental</option>
                    <option value="7EF" <?php echo ($linha->serie == "7EF") ? "selected" : ""; ?>>7º ano do Ensino Fundamental</option>
                    <option value="6EF" <?php echo ($linha->serie == "6EF") ? "selected" : ""; ?>>6º ano do Ensino Fundamental</option>
                    <option value="5EF" <?php echo ($linha->serie == "5EF") ? "selected" : ""; ?>>5º ano do Ensino Fundamental</option>
                </select>
                <input type="file" name="arquivo" id="arquivo" accept="image/png, image/jpg, image/jpeg" style="display: none;">
                <input type="submit" value="Salvar" name="salvar" id="btn_salvar">
                <div class="retorno"></div>
            </form>
        </div>
        <div class="box-principal historico" style="display: none;">
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
                    $comando = $conexao -> prepare("SELECT id_simulado, tempo, data FROM simulado WHERE id_estudante = ".$_SESSION['id_estudante']." ORDER BY id_simulado DESC LIMIT 5");

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
        </div>
    </div>
</section>

<?php
        }
    }
    else{
        session_destroy();
        header('Location: login-cadastro');
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/perfil.js"></script>