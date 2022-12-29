$('document').ready(function () {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    const qtdQuestoes = params["quantidade-questoes"];
    const timercheck = params["mostrar-tempo"];

    if (timercheck == "true") {
        inicia();
    } else {
        const span = $('.tempo');
        span.css('display', 'none');
    }

    var dados = "quantidade-questoes=" + qtdQuestoes;

    $.ajax({
        method: 'POST',
        url: 'php/simulado.php',
        data: dados,
    })

        .done(function (msg) {
            var questoes = JSON.parse(msg);
            
            $("#retorno-simulado").css("display", "block");

            for (i = 0; i < questoes.length; i++) {
                var divgeral = "<div class='questoes_geral'>";
                var div_questoes = "<div id='questoes'>" + (i + 1) + ") " + questoes[i].enunciado + "</div>";
                var div_alternativas = "<div id='alternativas'> ";
                for (j = 0; j < questoes[i].alternativas.length; j++) {
                    div_alternativas = div_alternativas + `<div class='box-alternativa'><input type='radio' id='${i}-${j + 1}' name='questao_` + (i + 1) + "' value=" + questoes[i].alternativas[j].id_alternativa + `> <label for='${i}-${j + 1}'>` + questoes[i].alternativas[j].texto + "</label></div>";
                }
                div_alternativas = div_alternativas + "</div>";

                divgeral = divgeral + div_questoes + div_alternativas + "</div>";
                $("#retorno-simulado").append(divgeral);
            }
        })

        .fail(function (err) {
            $("#retorno-simulado").css("display", "block");
            $("#retorno-simulado").html("Erro, tente novamente mais tarde.");
        });


    $('#finalizar').click(function () {
        var dados = $('#resultados').serialize();

        $.ajax({
            method: 'POST',
            url: 'php/simulado_resultado.php',
            data: dados,
        })

        .done(function (msg) {
            var table = JSON.parse(msg);
            $("#retorno-correcao").css("display", "block");
            var divtabela = "<div id='tabela_correcao'><table><tr><th>Questão</th><th>Correção</th><th>Conteúdo</th><th>Matéria</th></tr>";
            var row = "";
            for (i = 0; i < table.length; i++) {
                row = row + "<tr><td>" + table[i].questao_numero + "</td> <td>" + (table[i].esta_certa == true ? "Correto" : "Incorreto") + "</td><td>"+table[i].conteudo+"</td><td>"+table[i].materia+"</td></tr>";
            }
            divtabela = divtabela + row + "</div>";
            $("#retorno-correcao").html(divtabela);
        })

            .fail(function (err) {
                $("#retorno-simulado").css("display", "block");
                $("#retorno-simulado").html("Erro, tente novamente mais tarde.");
            });

        return false;
    });
});

var intervalo;
var segundos_ = 0; // começo do timer

function formatandotempo(segundos) {
    minutos = 0;
    horas = 0;

    while (segundos >= 60) {
        if (segundos >= 60) {
            segundos = segundos - 60;
            minutos = minutos + 1;
        }
    }

    while (minutos >= 60) {
        if (minutos >= 60) {
            minutos = minutos - 60;
            horas = horas + 1;
        }
    }

    if (horas < 10) {
        horas = "0" + horas
    }
    if (minutos < 10) {
        minutos = "0" + minutos
    }
    if (segundos < 10) {
        segundos = "0" + segundos
    }
    timer = horas + ":" + minutos + ":" + segundos
    return timer;
}

function conta() {
    segundos_++;
    document.getElementById("timer").innerHTML = formatandotempo(segundos_);
}

function inicia() {
    intervalo = setInterval("conta();", 1000);
}


function para() {
    if (intervalo) {
        clearInterval(intervalo);
    }
}
