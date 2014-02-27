<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'celulas/edit?id=' . $celula->getId()); ?></li>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'celulas/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>L&iacute;der:</th>
            <td><?php echo $celula->getLider() ?></td>
        </tr>
        <tr>
            <th>D&iacute;as c&eacute;lula:</th>
            <td><?php echo $celula->getDiasCelula() ?></td>
        </tr>
        <tr>
            <th>Horario c&eacute;lula:</th>
            <td><?php echo $celula->getHorarioCelula() ?></td>
        </tr>
    </tbody>
</table>

<hr />

<div class="reunion historial">
    <h2 class="titulo">Historial</h2>
    <input type="button" value="+" id="add_reunion" />
    <div class="clear"></div>
    <ul id="historial">
        <?php foreach ($historial as $reunion) : ?>
            <li>
                <span><?php echo $reunion->getFecha(); ?></span>
                <?php echo link_to(image_tag('jui/edit.png', array('title' => 'Editar', 'alt' => 'Editar')), 'reuniones/show?id=' . $reunion->getId(), array('class' => 'btn_ver_reunion')); ?>
                <?php echo link_to(image_tag('jui/delete.png', array('title' => 'Eliminar', 'alt' => 'Eliminar')), 'reuniones/delete?id=' . $reunion->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="reunion contenedor" style="display: none;">
    <form action="<?php echo url_for('reuniones/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="crear_reunion">
        <div id="oculto" style="display: none;">
            <?php echo $form['_csrf_token']->render(); ?>
            <?php echo $form['celula_id']->render(); ?>
            <?php echo $form['asistencias']->render(); ?>
            <?php if (!$form->getObject()->isNew()): ?>
                <input type="hidden" name="sf_method" value="put" />
            <?php endif; ?>
        </div>
        <div class="reunion asistencias">
            <h2 class="titulo">Fecha</h2>
            <div class="clear">&nbsp;</div>
            <?php echo $form['fecha']->render(); ?>
            <div class="clear">&nbsp;</div>
            <h2 class="titulo">Asistencias</h2>
            <input type="button" value="+" rel="#lista_miembros" id="add_miembros"/>
            <div class="clear">&nbsp;</div>
            <ul id="lista_asistentes">
            </ul>
        </div>
        <div class="reunion palabra">
            <h2 class="titulo">Palabra</h2>
            <?php echo $form['palabra']->render() ?>
        </div>
        <div class="reunion observaciones">
            <h2 class="titulo">Observaciones</h2>
            <?php echo $form['observaciones']->render() ?>
        </div>
        <div class="clear">&nbsp;</div>
        <input type="submit" value="<?php echo __('Save'); ?>" />&nbsp;<a href="#" id="cancelar_reunion">Cancelar</a>
    </form>
</div>

<div id="lista_miembros" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" style="height: 180px;">
        <?php foreach ($miembros as $key => $miembro): ?>
            <li>
                <input type="checkbox" name="miembro_id" id="miembro_<?php echo $miembro->getDiscipuloId(); ?>" value="<?php echo $miembro->getDiscipuloId(); ?>" class="miembro_id" checked="checked" />
                <label for="<?php echo $key ?>"><?php echo $miembro ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
    <input type="button" value="Agregar" id="btn_agregar" />
</div>
<?php slot('menu') ?>
<script type="text/javascript">
    $(document).ready(function() {
        var lista_id = new Array();
        var lista_nombres = '';
        var new_content = '';
        var contador = 0;

        new_content = $('.reunion.contenedor').html();
        $(document).delegate('input[rel="#lista_miembros"]', 'click', function(event) {
            event.preventDefault(); //prevent default link action
            event.stopPropagation();
            $('input[rel="#lista_miembros"]').overlay();
        });

        $('#btn_agregar').live('click', function() {
            $(".miembro_id").each(function() {
                var miembro = $(this);
                if (miembro.attr('checked')) {
                    lista_id[contador] = miembro.val();
                    lista_nombres += '<li>' + miembro.next("label").text() + '</li>';
                    contador++;
                }
            });
            $('#reunion_asistencias').val(lista_id.join(','))
            $('#lista_asistentes').html(lista_nombres);
            $('#lista_asistentes').slideDown(300);
            contador = 0;
            lista_nombres = '';
            $('a.close').click();
        });
        $('#add_reunion').click(function(event) {
            event.preventDefault();
            if (new_content !== '') {
                $('.reunion.contenedor').html(new_content);
                $('input[rel="#lista_miembros"]').overlay();
            }
            $('.reunion.contenedor').slideDown(300);
        });
        $(document).delegate('#cancelar_reunion', 'click', function(event) {
            event.preventDefault();
            $('#crear_reunion').find('input[type="text"]').val('');
            $('#crear_reunion').find('textarea').val('');
            $('.reunion.contenedor').slideUp(300);
        });
        $('.btn_ver_reunion').click(function(event) {
            event.preventDefault();
            $('#historial').find('li').css('background', 'transparent');
            $(this).parent('li').css('background', '#9EC156')
            $.ajax({
                url: $(this).attr("href"),
                type: 'get',
                success: function(response) {
                    $('.reunion.contenedor').html(response);
//                    $('.reunion.contenedor').slideDown(300);
                }
            });
        });
    });
</script>
<?php end_slot(); ?>