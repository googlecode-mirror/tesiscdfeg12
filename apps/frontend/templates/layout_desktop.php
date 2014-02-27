<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script src="js/jquery.ui.interaction.min.js" type="text/javascript"></script>
        <script src="js/dashboard.js" type="text/javascript"></script>
        <script src="js/jquery.jqDock.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.menu_link').mouseover(function() {
                    $(this).addClass('menu_link_over');
                });
                $('.menu_link').mouseout(function() {
                    $(this).removeClass('menu_link_over');
                });
                $('.menu_link').click(function() {
                    $('.menu_link').each(function() {
                        $(this).removeClass('menu_link_selected');
                    });
                    $(this).addClass('menu_link_selected');
                });
                crearVentana('monitor', '<?php echo url_for('@monitor?id_discipulo=0'); ?>', 'Información general');
            });
        </script>
        <!--[if lt IE 7]>
         <style type="text/css">
         .dock img { behavior: url(iepngfix.htc) }
         </style>
        <![endif]-->
    </head>
    <body id="cross">
        <?php $left_style = 0; ?>
        <?php if ($sf_user->hasFlash('notice')): ?>
            <div class="flash notice"><?php echo $sf_user->getFlash('notice'); ?></div>
        <?php endif; ?>
        <?php if ($sf_user->hasFlash('error')): ?>
            <div class="flash error"><?php echo $sf_user->getFlash('error'); ?></div>
        <?php endif; ?>
        <div id="left_menu">
            <div class="menu_container">
                Monitor
                <ul class="menu_group">
                    <li class="menu_link" onclick="crearVentana('monitor', '<?php echo url_for('@monitor?id_discipulo=0') ?>', 'Información general');">
                        <?php echo image_tag('desktop/dock/cuenta.png', array('alt' => 'mis datos', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                        Ver mis datos
                    </li>
                </ul>
            </div>
            <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula')): ?>
                <div class="menu_container">
                    Administrar usuarios
                    <ul class="menu_group">
                        <li class="menu_link" onclick="crearVentana('Usuarios', '<?php echo url_for('discipulos') ?>', 'Usuarios')">
                            <?php echo image_tag('desktop/dock/discipulo.png', array('alt' => 'seguidores', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                            Disc&iacute;pulos
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or $sf_user->hasCredential('Discipulo')): ?>
                <div class="menu_container">
                    L&iacute;deres
                    <ul class="menu_group">
                        <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or !$sf_user->hasCredential('Discipulo')): ?>
                            <li class="menu_link" onclick="crearVentana('Celulas', '<?php echo url_for('celulas') ?>', 'Administración de células');">
                                <?php echo image_tag('desktop/dock/celulas.png', array('alt' => 'células', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                                C&eacute;lulas
                            </li>
                            <li class="menu_link" onclick="crearVentana('Asignacion', '<?php echo url_for('asignacion') ?>', 'Asignación de nuevos');">
                                <?php echo image_tag('desktop/dock/asignar.png', array('alt' => 'asignación', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                                Asignaci&oacute;n
                            </li>
                        <?php endif; ?>
                        <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or $sf_user->hasCredential('Discipulo')): ?>
                            <li class="menu_link" onclick="crearVentana('Seguimiento', '<?php echo url_for('seguimiento') ?>', 'Seguimiento de nuevos');">
                                <?php echo image_tag('desktop/dock/seguimiento.png', array('alt' => 'seguimiento', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                                Seguimiento
                            </li>
                        <?php endif; ?>
                        <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or !$sf_user->hasCredential('Discipulo')): ?>
                            <li class="menu_link" onclick="crearVentana('Seguidores', '<?php echo url_for('seguidores') ?>', 'Miembros de células');">
                                <?php echo image_tag('desktop/dock/seguidores.png', array('alt' => 'seguidores', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                                Seguidores
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or $sf_user->hasCredential('Discipulo')): ?>
                <div class="menu_container">
                    Herramientas
                    <ul class="menu_group">
                        <li class="menu_link" onclick="crearVentana('Cumpleaneros', '<?php echo url_for('@cumpleaneros') ?>', 'Cumeplañeros del mes');">
                            <?php echo image_tag('desktop/dock/birthday.png', array('alt' => 'Cumpleañeros', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                            Cumpleañeros
                        </li>
                        <li class="menu_link" onclick="crearVentana('Metas', '<?php echo url_for('meta') ?>', 'Administración de metas');">
                            <?php echo image_tag('desktop/dock/metas.png', array('alt' => 'metas', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                            Metas
                        </li>
                        <?php if ($sf_user->hasCredential('Lider de red') or $sf_user->hasCredential('Lider de celula') or !$sf_user->hasCredential('Discipulo')): ?>
                            <li class="menu_link" onclick="crearVentana('Escuela', '<?php echo url_for('escuela') ?>', 'Escuela de líderes');">
                                <?php echo image_tag('desktop/dock/elv.png', array('alt' => 'escuela', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                                ELV
                            </li>
                        <?php endif; ?>
                        <li class="menu_link" onclick="crearVentana('Reportes', '<?php echo url_for('reportes') ?>', 'Reportes');">
                            <?php echo image_tag('desktop/dock/elv.png', array('alt' => 'escuela', 'width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;')); ?>
                            Reportes
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="menu_container">
                Sesi&oacute;n
                <ul class="menu_group">
                    <li class="menu_link">
                        <a class="menu_singout" href="<?php echo url_for('sf_guard_signout'); ?>">
                            <?php echo image_tag('desktop/dock/logoff.png', array('width' => '20', 'height' => '20', 'style' => 'float:left; margin-right: 7px;', 'alt' => 'Salir', 'title' => 'Salir')) ?>
                            Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="main_container">
            <?php echo $sf_content ?>
        </div>
        <?php include_slot('javascript') ?>
    </body>
</html>
