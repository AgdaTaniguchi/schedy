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
var segundos_ = 0; // começo do timer

function conta() {
    segundos_++;
    document.getElementById("timer").innerHTML = formatandotempo(segundos_);
}

$(document).ready(function () {
    inicia();
});

function inicia() {
    intervalo = setInterval("conta();", 1000);
}


function para() {
    clearInterval(intervalo);
}
