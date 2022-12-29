<?php
    if(isset($_SESSION['id_estudante'])){
        header('Location: perfil');
    }
?>

<section class="login-cadastro">
    <div class="conteudo">
        <div class="container">
            <h2>Não possui uma conta? Registre-se agora!</h2>
            <form action="" id="formCadastrar" method="POST">
                <label for="nome" class="obg">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="50" placeholder="Digite seu nome aqui" required>
                <span class="aviso"></span>
                <label for="senha" class="obg">Senha:</label>
                <input type="password" name="senha" id="senha" minlength="6" maxlength="60" placeholder="Digite sua senha aqui" required>
                <span class="aviso"></span>
                <label for="confirmar-senha" class="obg">Confirme sua senha:</label>
                <input type="password" name="confirmar-senha" id="confirmar-senha" minlength="6" maxlength="60" placeholder="Digite sua senha novamente aqui" required>
                <span class="aviso"></span>
                <label for="email" class="obg">E-mail:</label>
                <input type="email" name="email" id="email" maxlength="50" placeholder="Digite seu e-mail aqui" required>
                <div class="mesma-linha">
                    <div class="w50">
                        <label for="celular" class="obg">Celular:</label>
                        <input type="text" name="celular" id="celular" minlength="8" maxlength="16" placeholder="Digite seu celular aqui" required>
                    </div>
                    <div class="w50">
                        <label for="data-nascimento">Data de nascimento:</label>
                        <input type="date" name="data-nascimento" id="data-nascimento">
                    </div>
                </div>
                <div class="mesma-linha">
                    <div class="w25">
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado">
                            <option value=""></option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RR">RR</option>
                            <option value="RO">RO</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                    <div class="w75">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade que você mora aqui">
                    </div>
                </div>
                <label for="serie">Série escolar:</label>
                <select name="serie" id="serie">
                    <option value=""></option>
                    <option value="NON">Não estou cursando no momento</option>
                    <option value="EJA">EJA</option>
                    <option value="3EM">3º ano do Ensino Médio</option>
                    <option value="2EM">2º ano do Ensino Médio</option>
                    <option value="1EM">1º ano do Ensino Médio</option>
                    <option value="9EF">9º ano do Ensino Fundamental</option>
                    <option value="8EF">8º ano do Ensino Fundamental</option>
                    <option value="7EF">7º ano do Ensino Fundamental</option>
                    <option value="6EF">6º ano do Ensino Fundamental</option>
                    <option value="5EF">5º ano do Ensino Fundamental</option>
                </select>
                <input type="submit" value="Cadastrar" name="cadastrar" id="btn_cadastrar">
                <div class="retorno retorno-cadastro"></div>
            </form>
        </div>
        <hr>
        <div class="container">
            <h2>Já possui uma conta? Faça o login!</h2>
            <form action="" method="POST" id="formLogin">
                <label for="email-login" class="obg">E-mail:</label>
                <input type="email" name="email-login" id="email-login" placeholder="Digite o e-mail cadastrado aqui">
                <label for="senha-login" class="obg">Senha:</label>
                <input type="password" name="senha-login" id="senha-login" placeholder="Digite sua senha cadastrada aqui">
                <input type="submit" value="Entrar" name="entrar" id="btn_entrar">
            </form>
            <div class="retorno retorno-login"></div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/login-cadastro-ajax.js"></script>
<script src="js/login-cadastro.js"></script>