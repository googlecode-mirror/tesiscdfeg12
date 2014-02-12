<?php use_helper('I18N'); ?>
<h1 class="titulo">Miembros de c&eacute;lulas</h1>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png') . __('New'), 'seguidores/new'); ?></li>
<?php end_slot(); ?>
<table class="datatables">
    <thead>
        <tr>
            <th>Discipulo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($miembro_celulas as $miembro_celula): ?>
            <tr>
                <td style="width: 200px;">
                    <a href="<?php echo url_for('@monitor?id_discipulo=' . $miembro_celula->getDiscipulo()->getId()) ?>">
                        <?php echo $miembro_celula->getDiscipulo() ?>
                    </a>
                </td>
                <td>
                    <?php if($sf_user->hasCredential('Administrador') || $miembro_celula->getDiscipulo()->getId() == $sf_user->getUserId()):?>
                    <a href="<?php echo url_for('seguidores/edit?id=' . $miembro_celula->getDiscipulo()->getId()) ?>">
                        <?php echo image_tag('jui/edit.png', array('title' => 'Editar', 'alt' => 'Editar')) ?>
                    </a>
                    <?php endif; ?>
                    <?php if($sf_user->hasCredential('Administrador') && $miembro_celula->getDiscipulo()->getId() != $sf_user->getUserId()):?>
                    <a href="<?php echo url_for('seguidores/delete?id=' . $miembro_celula->getDiscipulo()->getId()) ?>" class="lnk_confirmar" >
                        <?php echo image_tag('jui/delete.png', array('title' => 'Dar de baja', 'alt' => 'Dar de baja')) ?>
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


