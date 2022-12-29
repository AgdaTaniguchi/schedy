function timeout(ms){
    return new Promise(res => setTimeout(res, ms));
}

$('document').ready(function(){
    $('#menu-hamburguer').on("click", function(){
        // Menu fechado -> abrir
        if($('.links').hasClass('none')){
            abreMenu();
        }
        // Menu aberto -> fechar
        else{
            fechaMenu();
        }
    });

    $('.fundo-menu').click(() => {
        fechaMenu();
    });

    if(window.innerWidth < 1100){
        $('.links').addClass('none');
    }

    $(window).resize(() => {
        if(window.innerWidth < 1100){
            $('.links').addClass('none');
        }
        else{
            $('.links').removeClass('none');
        }
        $('.fundo-menu').addClass('none');
    });
});

async function abreMenu(){
    await $('.links').css('animation', 'esq-dir 0.5s ease-in-out');
    await $('.links').removeClass('none');
    await setTimeout(function(){
        $('.fundo-menu').removeClass('none');
    }, 400);
}

async function fechaMenu(){
    await $('.links').css('animation', 'dir-esq 0.5s ease-in-out')
    $('.fundo-menu').addClass('none');
    await setTimeout(function(){
        $('.links').addClass('none');
    }, 400);
}