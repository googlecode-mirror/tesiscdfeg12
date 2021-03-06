<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'seguidores/index'); ?></li>
<?php if (!$form->getObject()->isNew()): ?>
    <li class="tool_item menu_borrar"><?php echo link_to(image_tag('/images/toolbar/t_del.png') . __('Delete'), 'seguidores/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))); ?></li>
<?php endif; ?>
<?php end_slot() ?>
<form action="<?php echo url_for('seguidores/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
            <tr><th>Discipulo</th>
                <td>
                    <input type="button" id="btn_lista_asignacion" value="Examinar..." rel="#lista_asignados" />
                    <span class="li_seleccionado">&nbsp;</span>
                </td>
            </tr>
            <tr><th>Celula</th>
                <td>
                    <input type="button" id="btn_lista_asignacion" value="Examinar..." rel="#lista_celulas" />
                    <span class="li_seleccionado2">&nbsp;</span>
                </td>
            </tr>
            <?php echo $form ?>
        </tbody>
    </table>
</form>

<div id="lista_asignados" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" >
        <?php foreach ($asignados as $asignado): ?>
            <li><input type="radio" name="asignado_id" value="<?php echo $asignado->getDiscipuloNuevoId(); ?>" class="asignado_id" /><?php echo $asignado ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".asignado_id").live('click',function(){
            var asignado_id = $(this).val();
            var asignado_nombre = $(this).parent('li').text();
            $('#miembro_celula_discipulo_id').val(asignado_id);
            $('.li_seleccionado').text(asignado_nombre);
            $('a.close').click();
        });
    });
</script>

<div id="lista_celulas" class="overlay" style="width: 300px; height: 230px;">
    Buscar: <input type="text" class="filtro_listas" />
    <ul class="lista_elementos" >
        <?php foreach ($lideres as $lider): ?>
            <li><input type="radio" name="celula_id" value="<?php echo $lider->getId(); ?>" class="celula_id" /><?php echo $lider ?></li>
            <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".celula_id").live('click',function(){
            var asignado_id = $(this).val();
            var celula_nombre = $(this).parent('li').text();
            $('#miembro_celula_celula_id').val(asignado_id);
            $('.li_seleccionado2').text(celula_nombre);
            $('a.close').click();
        });
    });
</script>