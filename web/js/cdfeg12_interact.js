/*****************************************************************************
 *                 CONTENIDO
 * datePicker()                        --> Generación de datepicker
 * appConfirma(mensaje, url)           --> mensaje animado de confirmación
 * menuPrincipal()                     --> genera el estilo y efecto del menú
 * flashMessage()                      --> efecto especial para mensaje Flash
 * crearVentana(id_ventana,url,titulo) --> Crea ventanas tipo MAC
 * marcarTodos(id_padre,class_lista)   --> marcar los checks de la pantalla
 * overlay()                           --> Ventana modal
 * filterList()                        --> Flitro de listas UL
 *****************************************************************************/
var windowCounter = 1;

function appConfirma(mensaje, url){
    apprise(mensaje, {
        confirm: true, 
        animate: true, 
        textOk: "Aceptar", 
        textCancel: "Cancelar"
    }, function(r){
        if(r){
            window.location=url;
        } else {
            return false;
        }
    });
}

function menuPrincipal() {
    $('#tool_bar li').prepend("<span></span>")
    $('#tool_bar li').each(function(){
        var linkText = $(this).find("a").html();
        $(this).find("span").show().html(linkText);
    });
    $('#tool_bar li').hover(function(){
        $(this).find("span").stop().animate({
            marginTop: "-40"
        }, 250);
    },function(){
        $(this).find("span").stop().animate({
            marginTop: "0"
        }, 250);
    });
}

function flashMessage(){
    $('.flash').slideDown('slow');
    setTimeout(function(){
        $('.flash').slideUp('slow', function(){
            $('.flash').remove();
        });
    },4000);
}

function crearVentana(id_ventana,url,titulo){
    function TamVentana() {  
        var Tamanyo = [0, 0];  
        if (typeof window.innerWidth != 'undefined')  
        {  
            Tamanyo = [  
            window.innerWidth,  
            window.innerHeight  
            ];  
        }  
        else if (typeof document.documentElement != 'undefined'  
            && typeof document.documentElement.clientWidth !=  
            'undefined' && document.documentElement.clientWidth != 0)  
            {  
            Tamanyo = [  
            document.documentElement.clientWidth,  
            document.documentElement.clientHeight  
            ];  
        }  
        else   {  
            Tamanyo = [  
            document.getElementsByTagName('body')[0].clientWidth,  
            document.getElementsByTagName('body')[0].clientHeight  
            ];  
        }  
        return Tamanyo;  
    }  
    var Tam = TamVentana();  
    var win_width = Tam[0] - 230;
    var win_height = Tam[1] - 50;
    $.closeWindow(id_ventana);
    $('.window-closeButton').each(function(){
    	$(this).click();
    });
//    console.log(id_ventana);
    $.newWindow({
        id: id_ventana,
        title: titulo,
        statusBar: false,
        width: win_width,
        height: win_height,
        posx: 210,
        posy: 5,
        resizeable: false
    });
    $.updateWindowContent(id_ventana,'<iframe src="http://cdfeg12.com/'+url+'" frameborder="0" width="' +(win_width - 2) + '" height="' + (win_height - 2)+ '" />');
}

function marcarTodos(id_padre,class_lista){
    $(id_padre).live('click',function(){
        var opcion = $(id_padre).attr('checked');
        $(class_lista).each(function(){
            if(opcion) {
                $(this).attr('checked', opcion);
            } else {
                $(this).removeAttr('checked');
            }
        });
    });
}
/**
 * Fulcion Filtro de listas adjunto para jquery
 */
(function(a){
    a.fn.filterList=function(){
        jQuery.expr[":"].Contains=function(a,b,c){
            return(a.textContent||a.innerText||"").toUpperCase().indexOf(c[3].toUpperCase())>=0
        };
            
        a(this).keyup(function(){
            var b=a(this).val();
            if(b){
                a(this).next("ul").find("li:not(:Contains("+b+"))").slideUp();
                a(this).next("ul").find("li:Contains("+b+")").slideDown()
            }else{
                a(this).next("ul").children("li").slideDown()
            }
            return false
        });
        return this
    }
})(jQuery)

$(document).ready(function() {
    var filtro = $('.sf_admin_filter').html();
    filtro = '<h2 style="background: #E7EEF6; padding: 5px; margin: 0px; text-align: center;">Filtro</h2>' + filtro;
    $('.sf_admin_filter').html(filtro);
    /**
     * Mensaje de alertas flash
     */
    flashMessage();
    /**
     * Generación del menú principal
     */
    //    menuPrincipal();    
    /**
     * Genearación de estilos de títulos
     */
    //    $(".jquery h1").prepend("<span></span>");
    /**
     * Generación de mensaje tooltip animado
     */
    $('.j_tooltip').tooltip({
        effect: 'slide'
    });
    /**
     *Generación de datepicker
     */
    $('#meta_fecha_cumplir').datepicker();
    $('#celula_fecha').datepicker();
    $('#evento_fecha_hora').datepicker();
    $('#seguimiento_fecha').datepicker();
    $('#escuela_fecha_ingreso').datepicker();
    $('#reunion_fecha').datepicker();
    //    $('#sf_guard_user_fecha_nac').datepicker();
    /**
     *Generación de link confirmar
     */
    $('.lnk_confirmar').live('click',function(){
        var url = $(this).attr('href');
        appConfirma('¿Desea Continuar?', url);
        return false;
    });
    /**
     * Generación de DataTables
     */
    
    oTable = $('.datatables').dataTable(
    {
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sProcessing":   "Procesando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "No se encontraron resultados",
            "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primero",
                "sPrevious": "Anterior",
                "sNext":     "Siguiente",
                "sLast":     "Último"
            }
        }
    }
    );
    
    marcarTodos('#chbox_todos_nuevo','.chbox_elemento');
    
    /**
     * Ventana modal
     */
    $("input[rel]").overlay(); 
    
    /**
     * Llamada a función de filtro
     */
    $(function() {
        $('.filtro_listas').filterList();
    });
});