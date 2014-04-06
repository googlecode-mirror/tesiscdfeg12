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
    var barrios_data = ["10 de junio","17 de Mayo","2 de Febrero","23 de Junio","23 de mayo","23 Mayo","4 de Octubre","6 de Diciembre","9 de Julio","Aeronáutico","Agua Clara","Aida León","Allpallacta","Alpallacta","Altos del Valle","Álvaro Pérez","Ana Luisa","Ana María Alto","Ana María Bajo","Andalucía","Argelia Alta","Argelia intermedia","Asistencia Social","Aviación Civil","Aymesa","Baker","Barrionuevo","Batán Alto","Batán Bajo","Batán","Beaterio Andinanet","Bella Aurora","Bellavista Alto","Bellavista del Sur","Bellavista","Betania","BEV","Billivaro","Blanqueado","Bonanza","Bosque","Buenos Aires","Cacharpaqui","California","Calle Ambato","Calzado","Campiña del Inca","Campo Alegre","Carapungo","Carcelén","Carlos Méndez","Carmen Bajo","Castillo de Amaguaña","Catzuquí de Moncayo","Caupicho I","Caupicho II","Caupicho III","CEDOC","Centro Médico Patronato San José","Cerebro","Chaupicruz","Chaupitena","Chillo Jijón","Chillogallo 1 etapa","Chillogallo Bajo","Chillogallo","Chimbacalle","Chinchín Loma","Chiriyacu","Cinco de Junio","Ciudad de Quito","Ciudad del Niño","Ciudad Futura","Ciudadela Ibarra","Ciudadela La Hospitalaria","Ciudadela México","Club Rancho San Francisco","Cochapamba Norte","Cochapamba Sur","Cofán","Cofavi","Colinas del Sur","Collaloma","Colmena Alta","Colmena Baja","Colvas","Comité del Pueblo","Comuna Chilibulo","Comuna Santa Clara de Millán","Comuna","Coop. Don Eloy","Coop. Mirasierra","Coop. San Gabriel","Cordillera","Cotocollao","Cristianía 1 y 2","Cuartel Mariscal Sucre","Cuatro Estacas","Cuendina","Curiquingue","Dammer I","Dammer II","Dammer","Dorado","Dos Puentes","Ecuatoriana","Ejército Nacional 2 Etapa","Ejército Nacional II","Ejército Nacional","El Bosque","El Carmen Bajo","El Condado","El Conde I","El Ejido","El Girón I","El Guangal","El Inca","El Laurel","El Pinar Bajo","El Pintado Atahualpa","El Placer","El Porvenir","El Rocío de Guamaní","El Rocío","El Rosario","El Tablón","El Tejar","El Tingo","El Tránsito","Escuela Rincón del Valle","Eternit","Félix Rivadeneira","Florida Alta","Franklin Tello","Frente Popular","Gabriel Marina","Germán Ávila","Girón","González Suárez","Granda Centeno","Guamaní Alto","Guamaní","Guangopolo","Guápulo","Hemisferio Sur","Hermano Miguel","Hierba Buena","Hogar Ancianos","Hormigonera Quito","Hospital Julio Endara","Hospital SOLCA","Huancavilca","Huangal","Huayrallacta","IESS-FUT","Iñaquito Bajo","Iñaquito","Inca","Intillacta","Jardines de El Inca","Jardines del Batán","Jardines del Inca","Jipijapa","Julio Matovelle","La Alameda","La Armenia 1 y 2","La Bretaña","La Chilena","La Cocha ","La Cocha","La Comuna","La Concepción","La Delicia","La Ecuatoriana","La Esperanza","La Estancia","La Floresta","La Gatazo","La Independencia","La Isla","La Kennedy","La Libertad Baja","La Libertad","La Loma Grande","La Luz","La Magdalena","La Merced","La Moya","La Ofelia","La Pampa","La Paz","La Perla","La Primavera","La Pulida","La Raya","La Ronda","La Toglla","La Tola","La Vicentina","La Victoria","Las Acacias","Las Bromelias","Las cuadras","Las Orquídeas","Libertad Baja","Libertadores","Life","Loma Hermosa","Los Arrayanes","Los Cipreses","Los Cóndores","Los Laureles","Los Pedestales","Los Tulipanes","Lotización Miravalle","Lotización Santa Isabel","Lucha de los Pobres","Lucía Albán","Maldonado","Manuela Cañizares","Manuelita Sáenz","Martha Bucaram","Matilde Álvarez","Mena del Hierro ","Mena del Hierro","Mercado de Cotocollao","Mexterior","Michelena","Mirador","Miraflores","Miranda","Monteserrín","Municipal","Músculos y Rieles","Nazaret","Nazareth","Ninallacta","Nuestra Madre de la Merced","Nueva Aurora","Nuevos Horizontes","Oasis","Omnibus Urbano","Ómnibus Urbano","Orquídeas","Osorio","Pablo Arturo Suárez","Pan de Azúcar","Panamericana Sur","Panecillo","Parroquia Amaguaña","Parroquia Calderón","Parroquia Conocoto","Parroquia Cotocollao","Parroquia Guangopolo","Parroquia La Merced","Parroquia Nayón","Parroquia Pifo","Parroquia Pomasqui","Patrimonio Familiar","Pedregal","Peluche Alto","Pichincha Bajo","Pinar Alto","Pinar Bajo","Placer","Plan Victoria","Policía Nacional","Polvorín","Ponciano Bajo","Porvenir","Prados del Valle","Profesores Municipales","Protección Turubamba","Protección","Pueblo Solo Pueblo","Pueblo Unido","Quintana","Quito Norte","Quito Tenis Club","Quito Tenis Golf Club","Rodríguez Aguirre","Rumiloma","Rumiñahui","Ruperto Marlon","Salvador Allende","San Alfonso","San Blas I","San Blas","San Carlos Multifamiliares","San Carlos Vencedor","San Carlos","San Cristóbal","San Diego","San Eduardo","San Felipe","San Fernando de Guamaní","San Fernando","San Francisco de Huarcay","San Francisco de Tanda","San Francisco del Sur","San Francisco","San Gregorio","San Isidro de El Inca","San Isidro","San José de El Inca","San José de Jarrín","San José del Condado","San José Obrero","San José","San Juan Alto","San Juan de Guamaní","San Juan de la Armenia","San Juan de Turubamba","San Juan Loma","San Juan","San Lorenzo","San Luis","San Marcelo","San Martín Porras","San Martin","San Martín","San Miguel de Amagasí","San Pedro Claver","San Pedro Inchapicho","San Roque","San Sebastián","San Vicente Cornejo","San Vicente de Tanda","San Vicente Florida","San Vicente","Santa Ana","Santa Anita del Sur","Santa Anita Dos","Santa Anita","Santa Inés 2","Santa Isabel","Santa Lucía Alta","Santa Lucía Baja","Santa Lucía","Santa Martha Alta","Santa Martha","Santa Rita","Santa Rosa del Valle","Santa Rosa","Santo Thomas I","Sesquicentenario","Sierra del Moral","Solanda","Sta. Anita Alta","Sta. Isabel","Sta. Lucia Alta","Tacuri","Tejar","Tenis Club","Terminal Terrestre","Terranova","Thomas","Toctiuco","Tréboles del Sur","Tres Cruces","Triunfo","Turubamba de Monjas 2","Turubamba de Monjas BEV","Turubamba de Monjas","Unión Nacional","Unión y Justicia","Unión y Progreso","Universidad Central","Urb. Altos del Valle","Urb. El Condado","Urb. La Esperanza","Urb. Las Marías","Urb. Mena del Hierro","Urb. Miravalle","Urb. San Rafael","Urb. Terrazas de Tanda","Valle de Nayón","Valle del Sur","Venecia I","Vertientes del Sur","Victoria Central","Villa Flora","Villas Aurora","Vista Grande","Voz de los Andes","Yahuachi","Yavirac","Zaldumbide","Zámbiza",];

    $('#sf_guard_user_sector_ciudad').autocomplete({
         source:barrios_data,
         autoFocus: true
    });
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
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $('#meta_fecha_cumplir').datepicker({ dateFormat: 'mm/dd/yy' });
    $('#celula_fecha').datepicker({ dateFormat: 'mm/dd/yy' });
    $('#evento_fecha_hora').datepicker({ dateFormat: 'mm/dd/yy' });
    $('#seguimiento_fecha').datepicker({ dateFormat: 'mm/dd/yy' });
    $('#escuela_fecha_ingreso').datepicker({ dateFormat: 'mm/dd/yy' });
    //    $('#sf_guard_user_fecha_nac').datepicker({ dateFormat: 'mm/dd/yy' });
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

