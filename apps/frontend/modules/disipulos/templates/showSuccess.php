<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<?php if ($sf_user->hasCredential('Administrador') || $sf_guard_user->getId() == $sf_user->getUserId()): ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'disipulos/edit?id=' . $sf_guard_user->getId()); ?></li>
<?php endif; ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png') . __('Back to list'), 'disipulos/index'); ?></li>
<?php end_slot(); ?>
<table>
    <tbody>
        <tr>
            <th>Id:</th>
            <td><?php echo $sf_guard_user->getId() ?></td>
        </tr>
        <tr>
            <th>Nombre:</th>
            <td><?php echo $sf_guard_user->getFirstName() . " " . $sf_guard_user->getLastName() ?></td>
        </tr>
        <tr>
            <th>E-mail:</th>
            <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
        </tr>
        <tr>
            <th>Fecha de nacimiento:</th>
            <td><?php echo $sf_guard_user->getFechaNac() ?></td>
        </tr>
        <tr>
            <th>Estado civil:</th>
            <td><?php echo $sf_guard_user->getEstCivil() ?></td>
        </tr>
        <tr>
            <th>Fotograf&iacute;a:</th>
            <td><?php echo image_tag('/uploads/discipulos/' . $sf_guard_user->getFotografia()) ?></td>
        </tr>
        <tr>
            <th>Genero:</th>
            <td><?php echo $sf_guard_user->getGenero() ?></td>
        </tr>
        <tr>
            <th>Tipo disc&iacute;pulo:</th>
            <td><?php echo $sf_guard_user->getTipoDiscipulo() ?></td>
        </tr>
        <tr>
            <th>C&oacute;digo l&iacute;der cdfe:</th>
            <td><?php echo $sf_guard_user->getCodigoLiderCdfe() ?></td>
        </tr>
        <tr>
            <th>Direcci&oacute;n:</th>
            <td><?php echo $sf_guard_user->getDireccion() ?></td>
        </tr>
        <tr>
            <th>Tel&eacute;fono:</th>
            <td><?php echo $sf_guard_user->getTelefono() ?></td>
        </tr>
        <tr>
            <th>Movil:</th>
            <td><?php echo $sf_guard_user->getMovil() ?></td>
        </tr>
        <tr>
            <th>Sector ciudad:</th>
            <td><?php echo $sf_guard_user->getSectorCiudad() ?></td>
        </tr>
        <tr>
            <th>Username:</th>
            <td><?php echo $sf_guard_user->getUsername() ?></td>
        </tr>
        <tr>
            <th>Activo:</th>
            <td><?php echo $sf_guard_user->getIsActive() ?></td>
        </tr>
        <tr>
            <th>Super usuario:</th>
            <td><?php echo $sf_guard_user->getIsSuperAdmin() ?></td>
        </tr>
        <tr>
            <th>&Uacute;ltimo acceso:</th>
            <td><?php echo $sf_guard_user->getLastLogin() ?></td>
        </tr>
        <tr>
            <th>Registro:</th>
            <td><?php echo $sf_guard_user->getCreatedAt() ?></td>
        </tr>
        <tr>
            <th>Actualizaci&oacute;n:</th>
            <td><?php echo $sf_guard_user->getUpdatedAt() ?></td>
        </tr>
    </tbody>
</table>

<hr />