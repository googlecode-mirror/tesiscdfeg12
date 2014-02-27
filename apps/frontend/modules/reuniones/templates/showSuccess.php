<form action="<?php echo url_for('reuniones/update?id=' . $reunion->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="editar_reunion">
    <div id="oculto" style="display: none;">
        <?php echo $form['_csrf_token']->render(); ?>
        <?php echo $form['celula_id']->render(); ?>
        <?php echo $form['asistencias']->render(); ?>
        <input type="hidden" name="sf_method" value="put" />
    </div>
    <div class="reunion asistencias">
        <h2 class="titulo">Fecha</h2>
        <div class="clear">&nbsp;</div>
        <?php echo $form['fecha']->render(); ?>
        <div class="clear">&nbsp;</div>
        <h2 class="titulo">Asistencias</h2>
        <input type="button" value="+" rel="#lista_miembros" id="add_miembros"/>
        <div class="clear">&nbsp;</div>
        <ul id="lista_asistentes" style="display: block;">
            <?php foreach ($reunion->getAsistencias() as $asistencia) : ?>
                <li><?php echo $asistencia->getMiembro(); ?></li>
            <?php endforeach; ?>
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

<script type="text/javascript">
    $('.reunion.contenedor').slideDown(300);
    $('input[rel="#lista_miembros"]').overlay();
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $('#reunion_fecha').datepicker({dateFormat: 'mm/dd/yy'});
<?php foreach ($reunion->getAsistencias() as $asistencia): ?>
        $('#miembro_<?php echo $asistencia->getMiembroCelulaId() ?>').attr('checked', true);
<?php endforeach; ?>
</script>