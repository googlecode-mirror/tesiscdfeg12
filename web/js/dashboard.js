/**
 * Genera la animaci{on de la botonera Stack
 */
function generaStack(nombreStack){
    $('#stack1 li img').each(function(){
        $(this).css('opacity', '0');
    });
    $('.'+nombreStack+'>img').toggle(function(){
        var vertical = 0;
        var horizontal = 0;
        $('~ul>li', this).each(function(){
            $(this).animate({
                top: '-' +vertical + 'px',
                left: horizontal + 'px'
            }, 300);
            vertical = vertical + 50;
            horizontal = (horizontal+1)*2;
            $(this).click(function(){
                $(this).parent('~ul>li').parent('.'+nombreStack+'>img').toggle();
            });
        });
        $('~ul', this).animate({
            top: '-50px',
            left: '10px'
        }, 300).addClass('openStack');
        $('~ul>li>img', this).animate({
            width: '50px',
            marginLeft: '9px',
            opacity: 1
        }, 300);
        $('~ul>li>img', this).click(function(){
            $('.'+nombreStack+'>img').click();
            $(this).death();
        });
    }, function(){
        //reverse above
        $('~ul',this).removeClass('openStack').children('li').animate({
            top: '40px',
            left: '-10px'
        }, 300);
        $('~ul>li>img',this).animate({
            width: '45px',
            marginLeft: '0',
            opacity: 0
        }, 300);
    //width: 50px;
    });
}
$(document).ready(function(){
    $('body').css({
        overflow: "hidden"
    });
	
    generaStack('stk_usuarios');
    generaStack('stk_utilitarios');
    generaStack('stk_lider');
});