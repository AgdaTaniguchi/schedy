$('document').ready(function(){
    $('#btn_cadastrar').click(function(){
        var dados = $('#formCadastrar').serialize();
        
        $.ajax({
            method: 'POST',
            url: 'php/usuario_cadastro.php',
            data: dados,
        })

        .done(function(msg){
            if(msg == true){
                window.location.href="perfil";
            }
            else{
                $(".retorno-cadastro").css("display", "block");
                $(".retorno-cadastro").html(msg);
            }
        })

        .fail(function(){
            $(".retorno-cadastro").css("display", "block");
            $(".retorno-cadastro").html("Erro, tente novamente mais tarde.");
        });

        return false;
    });

    $('#btn_entrar').click(function(){
        var dados = $('#formLogin').serialize();

        $.ajax({
            method: 'POST',
            url: 'php/usuario_login.php',
            data: dados,
        })

        .done(function(msg){
            if(msg == true){
                window.location.href="perfil";
            }
            else{
                $(".retorno-login").css("display", "block");
                $(".retorno-login").html(msg);
            }
        })

        .fail(function(){
            $(".retorno-login").css("display", "block");
            $(".retorno-login").html("Erro, tente novamente mais tarde.");
        });

        return false;
    });
});