<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'escuela/index'); ?></li>
<?php if (!$form->getObject()->isNew()): ?>
    <li class="tool_item menu_borrar"><?php echo link_to(image_tag('/images/toolbar/t_del.png') . __('Delete'), 'escuela/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))); ?></li>
<?php endif; ?>
<?php end_slot() ?>
<form action="<?php echo url_for('escuela/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        <th>Discipulo</th>
        <td>
            <input type="button" id="btn_lista_seguidores" value="Examinar..." rel="#lista_seguidores" />
            <span class="li_seleccionado">&nbsp;</span>
        </td>  
        <?php echo $form ?>
        </tbody>
    </table>
</form>
<div id="lista_seguidores" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" >
        <?php foreach ($seguidores as $seguidor): ?>
            <li><input type="radio" name="seguidor_id" value="<?php echo $seguidor->getDiscipuloId(); ?>" class="seguidor_id" /><?php echo $seguidor; ?></li>
            <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".seguidor_id").live('click',function(){
            var asignado_id = $(this).val();
            var asignado_nombre = $(this).parent('li').text();
            $('#escuela_discipulo_id').val(asignado_id);
            $('.li_seleccionado').text(asignado_nombre);
            $('a.close').click();
        });
    });
</script>