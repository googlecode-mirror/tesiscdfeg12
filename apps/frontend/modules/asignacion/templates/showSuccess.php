<table>
  <tbody>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $discipulo->getFirstName() . " " . $discipulo->getLastName()?></td>
    </tr>
    <tr>
      <th>Fecha nac:</th>
      <td><?php echo $discipulo->getFechaNac() ?></td>
    </tr>
    <tr>
      <th>Est civil:</th>
      <td><?php echo $discipulo->getEstCivil() ?></td>
    </tr>
    <tr>
      <th>Tipo discipulo:</th>
      <td><?php echo Utilitarios::getTipoDiscipulo($discipulo->getTipoDiscipulo()) ?></td>
    </tr>
    <tr>
      <th>Direccion:</th>
      <td><?php echo $discipulo->getDireccion() ?></td>
    </tr>
    <tr>
      <th>Telefono:</th>
      <td><?php echo $discipulo->getTelefono() ?></td>
    </tr>
    <tr>
      <th>Movil:</th>
      <td><?php echo $discipulo->getMovil() ?></td>
    </tr>
    <tr>
      <th>Sector ciudad:</th>
      <td><?php echo $discipulo->getSectorCiudad() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('asignacion/edit?id='.$discipulo->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('asignacion/index') ?>">List</a>
