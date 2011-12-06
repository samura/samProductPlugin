<?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug)) ?>
<div class="actions">
  <?php echo a_js_button('Edit', array('icon','no-label', 'a-edit')) ?>
  <?php echo link_to(
    '<span class="icon"></span>', 
    'aProductItem_delete', 
    array(
      'type' => 'product', 
      'slug' => $product->slug), 
    array(
      'class' => 'a-btn icon alt no-label a-delete', 
      'method' => 'delete', 
      'confirm' => __('Are you sure?'))) ?>
</div>