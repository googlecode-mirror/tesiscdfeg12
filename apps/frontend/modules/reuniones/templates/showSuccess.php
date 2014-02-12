<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $reunion->getId() ?></td>
    </tr>
    <tr>
      <th>Fecha:</th>
      <td><?php echo $reunion->getFecha() ?></td>
    </tr>
    <tr>
      <th>Palabra:</th>
      <td><?php echo $reunion->getPalabra() ?></td>
    </tr>
    <tr>
      <th>Observaciones:</th>
      <td><?php echo $reunion->getObservaciones() ?></td>
    </tr>
    <tr>
      <th>Celula:</th>
      <td><?php echo $reunion->getCelulaId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('reuniones/edit?id='.$reunion->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('reuniones/index') ?>">List</a>
