document.querySelector('#pesquisar').addEventListener('input', function(){
    filtrarPesquisa(document.querySelector('#pesquisa-vestibular'), document.querySelectorAll('.box'));
});

function filtrarPesquisa(barraDePesquisa, containers){
    valorDaBarra = removerAcento(barraDePesquisa.value);

    containers.forEach(element => {
        vestibular_nome = removerAcento((element.querySelector('.titulo p:eq(1)').innerHTML));

        console.log(vestibular_nome);

        if(resumo.titulo.includes(valorDaBarra) || resumo.data.includes(valorDaBarra) || resumo.professor.includes(valorDaBarra) || resumo.materia.includes(valorDaBarra)){
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