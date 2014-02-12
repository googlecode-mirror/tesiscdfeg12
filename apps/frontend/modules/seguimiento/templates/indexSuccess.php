<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png').__('New'), 'seguimiento/new'); ?></li>
<?php end_slot(); ?>
<h1 class="titulo">Seguimiento</h1>

<table class="datatables">
    <thead>
        <tr>
            <th>Asignaci&oacute;n</th>
            <th>Descripci&oacute;n</th>
            <th>Fecha</th>
            <th>Actividad seguimiento</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($seguimientos as $seguimiento): ?>
            <tr>
                <td><a href="<?php echo url_for('seguimiento/show?id=' . $seguimiento->getId()) ?>"><?php echo $seguimiento->getAsignacion()->getDiscipuloNuevo() ?></a></td>
                <td><?php echo $seguimiento->getDescripcion() ?></td>
                <td><?php echo $seguimiento->getFecha() ?></td>
                <td><?php echo $seguimiento->getActividadSeguimiento() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
