$('document').ready(() => {
    $('#alterar-imagem').click(() => {
        $('#arquivo').trigger('click');
    });

    $('#arquivo').change(() => {
        previewFile("#img-user");
    });

    $('#btn_salvar').click(() => {
        $.ajax({
            url: 'php/usuario_alterar.php',
            type: 'POST',
            data: new FormData(document.querySelector("#informacoes-pessoais")),
            processData: false,
            contentType: false,
        })

        .done(function(msg){
            $('.retorno').css('display', 'block');
            if(msg == true){
                $('.retorno').html('Usuário atualizado com sucesso!');
                $('.retorno').css('background', 'green');

                if($("#nome").val().length != 0){
                    console.log("O nome mudou!");
                    $("span#user-nome").html($("#nome").val());
                }

                if(!$('#arquivo').get(0).files.length === 0) {
                    previewFile("img#user");
                }
            }
            else{
                $('.retorno').css('background', 'red');
                $('.retorno').html(msg);
            }
        })
        
        .fail(function(){
            $('.retorno').css('display', 'block');
            $('.retorno').html('Erro, tente novamente mais tarde.');
        });

        return false;
    });

    $('#spnHistorico').click(() => {
        $('#spnInfo').removeClass('selecionado');
        $('#spnHistorico').addClass('selecionado');

        $('.informacoes-pessoais').css('display', 'none');
        $('.historico').css('display', 'block');
    });
    
    $('#spnInfo').click(() => {
        $('#spnHistorico').removeClass('selecionado');
        $('#spnInfo').addClass('selecionado');

        $('.historico').css('display', 'none');
        $('.informacoes-pessoais').css('display', 'block');
    });
});

function previewFile(lugar_preview){
    var file = $("input[type=file]").get(0).files[0];

    if(file && (file.type == "image/png" || file.type == "image/jpg" || file.type == "image/jpeg")){
        var reader = new FileReader();

        reader.onload = function(){
            $(lugar_preview).attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
    else{
        alert("Tipo de arquivo inválido. Utilize jpg, jpeg ou png.");
        $("input[type=file").val("");
    }
}