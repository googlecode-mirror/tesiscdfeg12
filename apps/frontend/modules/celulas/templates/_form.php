<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'celulas/index'); ?></li>
<?php if (!$form->getObject()->isNew()): ?>
    <li class="tool_item menu_borrar"><?php echo link_to(image_tag('/images/toolbar/t_del.png') . __('Delete'), 'celulas/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))); ?></li>
<?php endif; ?>
<?php end_slot() ?>
<form action="<?php echo url_for('celulas/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="<?php echo __('Save'); ?>" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr><th>L&iacute;der</th>
                <td>
                    <input type="button" id="btn_lista_lideres" value="Examinar..." rel="#lista_lideres" />
                    <span class="li_seleccionado">&nbsp;</span>
                </td>
            </tr>
            <?php echo $form ?>
        </tbody>
    </table>
</form>
<div id="lista_lideres" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" >
        <li><input type="radio" name="lider_id" id="lider_<?php echo $mi_id; ?>" value="<?php echo $mi_id; ?>" class="lider_id" /><?php echo $mi_nombre; ?></li>
        <?php foreach ($lideres as $lider): ?>
            <?php if ($mi_id != $lider->getDiscipuloId()): ?>
                <li><input type="radio" name="lider_id" id="lider_<?php echo $lider->getDiscipuloId(); ?>" value="<?php echo $lider->getDiscipuloId(); ?>" class="lider_id" /><?php echo $lider ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var id_lider = $('#celula_discipulo_lider_id').val();
        $('#lider_' + id_lider).attr('checked', 'checked');
        $(".lider_id").live('click', function() {
            var lider_id = $(this).val();
            var lider_nombre = $(this).parent('li').text();
            $('#celula_discipulo_lider_id').val(lider_id);
            $('.li_seleccionado').text(lider_nombre);
            $('a.close').click();
        });
    });
</script>