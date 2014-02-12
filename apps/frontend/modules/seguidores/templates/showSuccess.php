<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'seguidores/edit?id=' . $miembro_celula->getId()); ?></li>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'seguidores/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>Id:</th>
            <td><?php echo $miembro_celula->getId() ?></td>
        </tr>
        <tr>
            <th>Celula:</th>
            <td><?php echo $miembro_celula->getCelula() ?></td>
        </tr>
        <tr>
            <th>Discipulo:</th>
            <td><?php echo $miembro_celula->getDiscipulo() ?></td>
        </tr>
    </tbody>
</table>

<hr />
