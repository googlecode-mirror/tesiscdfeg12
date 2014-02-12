<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'metas/edit?id=' . $meta->getId()); ?></li>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'metas/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>Titulo:</th>
            <td><?php echo $meta->getTitulo() ?></td>
        </tr>
        <tr>
            <th>Fecha cumplir:</th>
            <td><?php echo $meta->getFechaCumplir() ?></td>
        </tr>
        <tr>
            <th>Estado:</th>
            <td><?php echo $meta->getEstado() ?></td>
        </tr>
        <tr>
            <th>Descripcion:</th>
            <td><?php echo $meta->getDescripcion() ?></td>
        </tr>
    </tbody>
</table>

<hr />


