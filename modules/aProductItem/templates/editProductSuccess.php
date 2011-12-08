<?php echo form_tag('aProductItem_editProduct', array('method' => 'post')); ?>
<?php echo $form->renderHiddenFields() ?>

<?php echo $form[$sf_user->getCulture()]['title']->render() ?>

<?php echo a_submit_button(a_('Save'), array('a-btn')) ?>

</form>