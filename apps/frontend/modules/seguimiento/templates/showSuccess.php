<?php use_helper('I18N'); ?>
<h1 class="titulo"><?php echo $seguimiento->getAsignacion()->getDiscipuloNuevo() ?></h1>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'seguimiento/edit?id=' . $seguimiento->getId()); ?></li>
<li class="tool_item tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('List'), 'seguimiento/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>Descripcion:</th>
            <td><?php echo $seguimiento->getDescripcion() ?></td>
        </tr>
        <tr>
            <th>Fecha:</th>
            <td><?php echo $seguimiento->getFecha() ?></td>
        </tr>
        <tr>
            <th>Asignacion:</th>
            <td><?php echo $seguimiento->getAsignacion()->getDiscipuloNuevo() ?></td>
        </tr>
        <tr>
            <th>Actividad seguimiento:</th>
            <td><?php echo $seguimiento->getActividadSeguimiento() ?></td>
        </tr>
    </tbody>
</table>

<hr />
