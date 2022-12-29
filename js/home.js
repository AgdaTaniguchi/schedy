$(document).ready(() => {
    var quantidadeImagens = $('.banner img').length;
    var indexBanner = 0;

    $('#setaVolta').click(() => {
        $('.banner img').eq(indexBanner).css('display', 'none');
        
    if(indexBanner == 0){
        indexBanner = quantidadeImagens - 1;
        $('.banner img').eq(indexBanner).css('display', 'block');
    }
    else{
        indexBanner -= 1;
        $('.banner img').eq(indexBanner).css('display', 'block');
    }
    });

    $('#setaAvanca').click(() => {
        $('.banner img').eq(indexBanner).css('display', 'none');
        
        if(indexBanner == quantidadeImagens - 1){
            indexBanner = 0;
            $('.banner img').eq(indexBanner).css('display', 'block');
        }
        else{
            indexBanner += 1;
            $('.banner img').eq(indexBanner).css('display', 'block');
        }
    });

    setInterval(function(){
        $('.banner img').eq(indexBanner).css('display', 'none');
        
        if(indexBanner == quantidadeImagens - 1){
            indexBanner = 0;
            $('.banner img').eq(indexBanner).css('display', 'block');
        }
        else{
            indexBanner += 1;
            $('.banner img').eq(indexBanner).css('display', 'block');
        }
    }, 7000);
});
