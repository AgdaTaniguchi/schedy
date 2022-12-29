function filtrarPesquisa(barraDePesquisa, containers){

    valorDaBarra = removerAcento(barraDePesquisa.value);

    containers.forEach(element => {
        vestibular_nome = removerAcento((element.querySelector('.titulo h3').innerHTML));

        if(vestibular_nome.includes(valorDaBarra)){
            element.style.animation = 'dir_aparece 0.5s';
            setTimeout(function(){
                element.style.display = 'block';
            }, 300);
        }
        else{
            element.style.animation = 'esq_some 0.5s';
            setTimeout(function(){
                element.style.display = 'none';
            }, 300);
        }
    });
}

function removerAcento(texto){
    texto = texto.toLowerCase();
    texto = texto.replace(/[àáâãäå]/,"a");
    texto = texto.replace(/[èéêë]/,"e");
    texto = texto.replace(/[íìî]/,"i");
    texto = texto.replace(/[óôòõ]/,"o");
    texto = texto.replace(/[úùû]/,"u");
    texto = texto.replace(/[ç]/,"c");
    return texto; 
}

var containers = document.querySelectorAll('.box');

containers.forEach(container => {
    var titulo = container.querySelector('.titulo');
    titulo.addEventListener('click', function(){
        var desc = container.querySelector('.desc');
        // Fechado
        if(container.querySelector('i').style.top == "" || container.querySelector('i').style.top == "-3px"){
            desc.style.animation = "desce 0.4s";
            setTimeout(function(){
                desc.style.display = "block";
                container.querySelector('.titulo').style.borderRadius = "30px 30px 0 0";
                container.querySelector('i').style.transform = "rotate(-180deg)";
                container.querySelector('i').style.top = "4px";
            }, 200);
        }
        // Aberto
        else{
            desc.style.animation = "sobe 0.4s";
            setTimeout(function(){
                desc.style.display = "none";
                container.querySelector('.titulo').style.borderRadius = "30px";
                container.querySelector('i').style.transform = "rotate(0deg)";
                container.querySelector('i').style.top = "-3px";
            }, 200);
            
        }
    });
});

document.querySelector('#pesquisa-vestibular').addEventListener('input', function(){
    filtrarPesquisa(document.querySelector('#pesquisa-vestibular'), document.querySelectorAll('.box'));
});

$('.principais-materias').click((e) => {
    var vestibular = $(e.target).attr("id");
    $('.fundo-modal').removeClass("none");
    $('.modal[id="'+vestibular+'"]').removeClass('none');
});

$('.fundo-modal').click(() => {
    $('.fundo-modal').addClass("none");
    $('.modal').addClass("none");
});