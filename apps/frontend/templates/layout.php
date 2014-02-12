<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.tool_item').mouseover(function(){
                    $(this).addClass('tool_item_hover');
                });
                $('.tool_item').mouseout(function(){
                    $(this).removeClass('tool_item_hover');
                });
            });
        </script>
    </head>
    <body id="app_window">
        <?php if ($sf_user->hasFlash('notice')): ?>
            <div class="flash notice"><?php echo $sf_user->getFlash('notice'); ?></div>
        <?php endif; ?>
        <?php if ($sf_user->hasFlash('error')): ?>
            <div class="flash error"><?php echo $sf_user->getFlash('error'); ?></div>
        <?php endif; ?>
        <ul id="tool_bar" class="kwicks">
            <li class="tool_item menu_refresh">
                <a href="javascript:location.reload(true)">
                    <?php echo image_tag('/images/toolbar/t_refresh.png'); ?>
                    Refrescar
                </a>
            </li>
            <li class="tool_separator">&nbsp;</li>
            <?php include_slot('menu') ?>
            <li class="toolbar_last">&nbsp;</li>
        </ul>
        <div id="frame_content">
            <?php echo $sf_content ?>
        </div>
    </body>
</html>
