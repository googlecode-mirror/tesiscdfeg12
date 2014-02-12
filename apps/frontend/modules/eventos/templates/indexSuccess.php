<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png').__('New'), 'eventos/new'); ?></li>
<?php end_slot(); ?>
<h1 class="titulo">Eventos</h1>

<table class="datatables">
  <thead>
    <tr>
      <th>Titulo</th>
      <th>Fecha hora</th>
      <th>Lugar</th>
      <th>Descripcion</th>
      <th>Discipulo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($eventos as $evento): ?>
    <tr>
      <td><a href="<?php echo url_for('eventos/show?id='.$evento->getId()) ?>"><?php echo $evento->getTitulo() ?></a></td>
      <td><?php echo $evento->getFechaHora() ?></td>
      <td><?php echo $evento->getLugar() ?></td>
      <td><?php echo $evento->getDescripcion() ?></td>
      <td><?php echo $evento->getDiscipulo() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
