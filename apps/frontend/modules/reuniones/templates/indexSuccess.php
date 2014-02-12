<h1>Reunions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Fecha</th>
      <th>Palabra</th>
      <th>Observaciones</th>
      <th>Celula</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($reunions as $reunion): ?>
    <tr>
      <td><a href="<?php echo url_for('reuniones/show?id='.$reunion->getId()) ?>"><?php echo $reunion->getId() ?></a></td>
      <td><?php echo $reunion->getFecha() ?></td>
      <td><?php echo $reunion->getPalabra() ?></td>
      <td><?php echo $reunion->getObservaciones() ?></td>
      <td><?php echo $reunion->getCelulaId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('reuniones/new') ?>">New</a>
