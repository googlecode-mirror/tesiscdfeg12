<?php use_helper('I18N'); ?>
<h1 class="titulo">Metas</h1>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png').__('New'), 'metas/new'); ?></li>
<?php end_slot(); ?>
<table class="datatables">
    <thead>
        <tr>
            <th>T&iacute;tulo</th>
            <th>Fecha l&iacute;mite</th>
            <th>Alerta</th>
            <th>Descripci&oacute;n</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($metas as $meta): ?>
            <tr>
                <td><a href="<?php echo url_for('metas/show?id=' . $meta->getId()) ?>"><?php echo $meta->getTitulo() ?></a></td>
                <td><?php echo $meta->getFechaCumplir() ?></td>
                <td>
                    <a href="<?php echo url_for('@completar_meta?id=' . $meta->getId() . '&modulo=' . $modulo) ?>" class="lnk_confirmar" >
                        <?php echo image_tag('jui/' . $meta->getNombreImgAlerta($meta->getFechaCumplir()), array('hspace' => '15', 'alt' => $meta->getEstado(), 'class' => 'j_tooltip', 'title' => 'Clic aquí para Completar la meta y quitar de la lista. Una vez completada la meta no se puede re-abrir')); ?>
                    </a>
                </td>
                <td><?php echo $meta->getDescripcion() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

