<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'escuela/edit?id='.$escuela->getId()); ?></li>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'escuela/index'); ?></li>
<?php end_slot(); ?>
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $escuela->getId() ?></td>
    </tr>
    <tr>
      <th>Fecha ingreso:</th>
      <td><?php echo $escuela->getFechaIngreso() ?></td>
    </tr>
    <tr>
      <th>Nivel:</th>
      <td><?php echo $escuela->getNivel() ?></td>
    </tr>
    <tr>
      <th>Discipulo:</th>
      <td><?php echo $escuela->getDiscipuloId() ?></td>
    </tr>
    <tr>
      <th>Nivel:</th>
      <td><?php echo $escuela->getNivelId() ?></td>
    </tr>
  </tbody>
</table>

<hr />
