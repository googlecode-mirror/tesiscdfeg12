<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('I18N'); ?>
<?php slot('menu') ?>
<li class="tool_item menu_lista"><?php echo link_to(image_tag('/images/toolbar/t_lista.png').__('Back to list'), 'metas/index'); ?></li>
<?php if (!$form->getObject()->isNew()): ?>
    <li class="tool_item menu_borrar"><?php echo link_to(image_tag('/images/toolbar/t_del.png').__('Delete'), 'metas/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))); ?></li>
<?php endif; ?>
<?php end_slot() ?>
<form action="<?php echo url_for('metas/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="<?php echo __('Save'); ?>" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
</form>
