<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<?php if($sf_user->hasCredential('Administrador') || $discipulo->getId() == $sf_user->getUserId()): ?>
<li class="tool_item menu_editar"><?php echo link_to(image_tag('/images/toolbar/t_edit.png') . __('Edit'), 'disipulos/edit?id=' . $discipulo->getId()); ?></li>
<?php endif; ?>
<?php end_slot(); ?>
<div id="monitor_top">
    <table border="0" cellspacing="0" cellpadding="5" class="datos_generales">
        <tr>
            <td rowspan="8">
                <?php echo image_tag('/uploads/discipulos/' . $discipulo->getFoto()) ?>
            </td>
        </tr>
        <tr class="fondo">
            <td colspan="6">
                <h1 class="titulo">Bienvenid<?php echo $discipulo->getGenero() == 2 ? 'o': 'a'; ?> <?php echo $discipulo ?></h1>
            </td>
        </tr>
        <tr>
            <td class="etiqueta">Estado Civil</td>
            <td><?php echo ucfirst($discipulo->getEstCivil()) ?></td>
            <td class="etiqueta">Edad</td>
            <td><?php echo $discipulo->getEdad() ?> A&ntilde;os</td>
            <td class="etiqueta">Sector</td>
            <td><?php echo $discipulo->getSectorCiudad() ?></td>
        </tr>
        <tr class="fondo">
            <td class="etiqueta">Env. Encuentro</td>
            <td><?php echo count($asignados_encuentro) ?></td>
            <td class="etiqueta">Discipulos</td>
            <td><?php echo count($seguidores) ?></td>
            <td class="etiqueta">Nivel ELV</td>
            <td><?php echo $escuelas->getFirst(); ?></td>
        </tr>
        <tr>
            <td class="etiqueta">Crecimiento</td>
            <td><?php echo $tipos_id[$discipulo->getTipoDiscipulo()] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

</div>
<div id="monitor_bottom">
    <div class="box_1 bottom_box">
        <table border="0">
            <thead>
                <tr>
                    <th colspan="2"><h2 class="titulo_azul">Discipulos</h2></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($seguidores as $seguidor): ?>
                    <tr>
                        <td><?php echo $seguidor ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="box_2 bottom_box">
        <table border="0">
            <thead>
                <tr>
                    <th colspan="2"><h2 class="titulo_aqua">Metas</h2></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Meta</th>
                    <th>Estado</th>
                </tr>
                <?php foreach ($metas as $meta): ?>
                    <tr>
                        <td><?php echo $meta ?></td>
                        <td>
                            <a href="<?php echo url_for('@completar_meta?id=' . $meta->getId() . '&modulo=' . $modulo) ?>" class="lnk_confirmar" >
                                <?php echo image_tag('jui/' . $meta->getNombreImgAlerta($meta->getFechaCumplir()), array('hspace' => '15', 'alt' => $meta->getEstado(), 'class' => 'j_tooltip', 'title' => 'Clic aquí para Completar la meta y quitar de la lista. Una vez completada la meta no se puede re-abrir')); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="asignados_box bottom_box">
        <table border="0">
            <thead>
                <tr>
                    <th colspan="2"><h2 class="titulo_verde">Asignados</h2></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($asignados as $asignado): ?>
                    <tr>
                        <td><?php echo $asignado ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>