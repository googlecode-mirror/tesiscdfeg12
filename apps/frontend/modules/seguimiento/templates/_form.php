<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'seguimiento/index'); ?></li>
<?php if (!$form->getObject()->isNew()): ?>
    <li class="tool_item menu_borrar"><?php echo link_to(image_tag('/images/toolbar/t_del.png') . __('Delete'), 'seguimiento/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')); ?></li>
<?php endif; ?>
<?php end_slot(); ?>
<form action="<?php echo url_for('seguimiento/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="<?php echo __('Save') ?>" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr><th>Discipulo</th>
                <td>
                    <input type="button" id="btn_lista_asignacion" value="Examinar..." rel="#lista_asignados" />
                    <span class="li_seleccionado">&nbsp;</span>
                </td>
            </tr>
            <?php echo $form; ?>
        </tbody>
    </table>
</form>
<div id="lista_asignados" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" >
        <?php foreach ($asignados as $asignado): ?>
            <li><input type="radio" name="asignado_id" value="<?php echo $asignado->getId(); ?>" class="asignado_id" /><?php echo $asignado ?></li>
            <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".asignado_id").live('click',function(){
            var asignado_id = $(this).val();
            var asignado_nombre = $(this).parent('li').text();
            $('#seguimiento_asignacion_id').val(asignado_id);
            $('.li_seleccionado').text(asignado_nombre);
            $('a.close').click();
        });
    });
</script>