<?php use_helper('I18N'); ?>
<h1 class="titulo">Disc&iacute;pulos</h1>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png') . __('New'), 'sf_guard_register'); ?></li>
<?php end_slot(); ?>
<table class="datatables">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>E-mail</th>
            <th style="min-width: 45px;">Edad</th>
            <th style="min-width: 80px;">Estado civil</th>
            <th style="min-width: 60px;">G&eacute;nero</th>
            <th style="min-width: 45px;">Tipo</th>
            <th>Direcci&oacute;n</th>
            <th style="min-width: 70px;">Tel&eacute;fono</th>
            <th style="min-width: 70px;">Movil</th>
            <th style="min-width: 55px;">Sector</th>
            <th style="min-width: 55px;">Estado</th>
            <th style="min-width: 70px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sf_guard_users as $sf_guard_user): ?>
            <tr>
                <td><a href="<?php echo url_for('@monitor?id_discipulo=' . $sf_guard_user->getId()) ?>"><?php echo $sf_guard_user->getFirstName() . " " . $sf_guard_user->getLastName() ?></a></td>
                <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
                <td style="text-align: center;"><?php echo $sf_guard_user->getEdad() ?></td>
                <td style="text-align: center;"><?php echo $sf_guard_user->getEstCivil() ?></td>
                <td style="text-align: center;"><?php echo $genero_id[$sf_guard_user->getGenero()] ?></td>
                <td style="text-align: center;"><?php echo $tipos_id[$sf_guard_user->getTipoDiscipulo()] ?></td>
                <td><?php echo $sf_guard_user->getDireccion() ?></td>
                <td><?php echo $sf_guard_user->getTelefono() ?></td>
                <td><?php echo $sf_guard_user->getMovil() ?></td>
                <td style="text-align: center;"><?php echo $sf_guard_user->getSectorCiudad() ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo url_for('@cambiar_estado_discipulo?id=' . $sf_guard_user->getId()) ?>" class="lnk_confirmar" >
                        <?php echo image_tag("jui/" . $sf_guard_user->getActivo(), array('hspace' => '15', 'alt' => 'Estado', 'class' => 'j_tooltip', 'title' => 'Clic aquí para cambiar el estado del discípulo, cada vez que sea presionado este botón se cambiará el estado')) ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo url_for('disipulos/show?id=' . $sf_guard_user->getId()) ?>">
                        <?php echo image_tag('jui/detalles.png', array('title' => 'Ver', 'alt' => 'Ver')) ?>
                    </a>
                    <?php if($sf_user->hasCredential('Administrador') || $sf_guard_user->getId() == $sf_user->getUserId()):?>
                    <a href="<?php echo url_for('disipulos/edit?id=' . $sf_guard_user->getId()) ?>">
                        <?php echo image_tag('jui/edit.png', array('title' => 'Editar', 'alt' => 'Editar')) ?>
                    </a>
                    <?php endif; ?>
                    <?php if($sf_user->hasCredential('Administrador') && $sf_guard_user->getId() != $sf_user->getUserId()):?>
                    <a href="<?php echo url_for('@eliminar_discipulo?id=' . $sf_guard_user->getId()) ?>" class="lnk_confirmar" >
                        <?php echo image_tag('jui/delete.png', array('title' => 'Eliminar', 'alt' => 'Eliminar')) ?>
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
