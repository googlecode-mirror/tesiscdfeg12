<?php use_helper('I18N') ?>
<?php decorate_with('layout_wellcome') ?>
<div id="signin_form">
    <div id="container">
        <div id="welcome_message">
            <h1>Bienvenid@s</h1>
            <p>A ti que eres un l&iacute;der de &eacute;xito, a ti cuyo discipulado es ejemplar, a ti esta dedicada esta p&aacute;gina</p>
        </div>
        <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
            <h1 style="text-align: center;">Iniciar Sesi&oacute;n</h1>
            <table>
                <tbody>
                    <?php echo $form ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="submit" value="<?php echo __('Signin', null, 'sf_guard') ?>" />
                            <?php $routes = $sf_context->getRouting()->getRoutes() ?>
                            <?php if (isset($routes['sf_guard_forgot_password'])): ?>
                                | <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>