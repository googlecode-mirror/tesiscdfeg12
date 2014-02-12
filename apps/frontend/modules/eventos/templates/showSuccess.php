<?php use_helper('I18N'); ?>
<h1 class="titulo"><?php echo $evento->getTitulo() ?></h1>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'eventos/edit?id=' . $evento->getId()); ?></li>
<li class="tool_item menu_agregar"><?php echo link_to(__('List'), 'eventos/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>Titulo:</th>
            <td><?php echo $evento->getTitulo() ?></td>
        </tr>
        <tr>
            <th>Fecha hora:</th>
            <td><?php echo $evento->getFechaHora() ?></td>
        </tr>
        <tr>
            <th>Lugar:</th>
            <td><?php echo $evento->getLugar() ?></td>
        </tr>
        <tr>
            <th>Descripcion:</th>
            <td><?php echo $evento->getDescripcion() ?></td>
        </tr>
        <tr>
            <th>Discipulo:</th>
            <td><?php echo $evento->getDiscipulo() ?></td>
        </tr>
    </tbody>
</table>

<hr />

&nbsp;

