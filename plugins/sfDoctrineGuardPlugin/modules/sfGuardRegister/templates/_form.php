<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_register') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
    <table>
        <?php echo $form ?>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" name="register" value="<?php echo __('Save') ?>" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>
