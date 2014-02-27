<?php use_helper('I18N'); ?>
<h1 class="titulo">Escuela de l&iacute;deres</h1>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png') . __('New'), 'escuela/new'); ?></li>
<?php end_slot(); ?>
<table class="datatables">
    <thead>
        <tr>
            <th>Fecha ingreso</th>
            <th style="min-width: 100px;">Discipulo</th>
            <th>Nivel</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($escuelas as $escuela): ?>
            <tr>
                <td><a href="<?php echo url_for('escuela/show?id=' . $escuela->getId()) ?>"><?php echo $escuela->getFechaIngreso('mm/dd/YYY') ?></a></td>
                <td><?php echo $escuela->getDiscipulo() ?></td>
                <td><?php echo $escuela->getNivel() ?></td>
                <td>
                    <?php echo link_to(image_tag('jui/edit.png', array('title' => 'Editar', 'alt' => 'Editar')), 'escuela/edit?id=' . $escuela->getId()); ?>
                    <?php echo link_to(image_tag('jui/delete.png', array('title' => 'Eliminar', 'alt' => 'Eliminar')), 'escuela/delete?id=' . $escuela->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>