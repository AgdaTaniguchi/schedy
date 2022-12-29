function aparece_span(evento, mensagem){
    $(evento.target).next("span.aviso").css('display', 'block');
    $(evento.target).next("span.aviso").html(mensagem);
}

function some_span(evento){
    $(evento.target).next("span.aviso").css('display', 'none');
}

$('document').ready(() => {
    $('#senha').on('change keyup past keydown', (e) => {
        if($('#confirmar-senha').next("span.aviso").css('display') == "block" && e.target.value == $('#confirmar-senha')[0].value){
            $('#confirmar-senha').next("span.aviso").css('display', 'none');
        }
    });
    $('#confirmar-senha').on('focusout', (e) => {
        if(e.target.value != $('#senha')[0].value){
            aparece_span(e, `A confirmação de senha está diferente da senha.`);
        }
        else{
            some_span(e);
        }
    });
    $('#confirmar-senha').on('change keyup past keydown', (e) => {
        if($(e.target).next("span.aviso").css('display') == "block" && e.target.value == $('#senha')[0].value){
            some_span(e);
        }
    });
});