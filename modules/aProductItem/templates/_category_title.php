<?php echo $category ?>

<?php if($admin): ?>
<div class="actions a-ui">
  <?php echo a_js_button('Edit', array('icon','no-label', 'a-edit')) ?>
  <?php echo link_to(
    '<span class="icon"></span>', 
    'aProductItem_delete', 
    array(
      'type' => 'category', 
      'slug' => $category->slug),
    array(
      'class' => 'a-btn icon alt no-label a-delete', 
      'method' => 'delete', 
      'confirm' => __('Are you sure?'))) ?>
</div>
<?php endif ?>