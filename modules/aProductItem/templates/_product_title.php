<?php $tag = (isset($tag)) ? $tag : array('name' => 'span') ?>

<<?php echo $tag['name'] ?> class="<?php if(isset($tag['class'])) echo $tag['class'] ?>">
  <?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug, 'cat' => $product->ProductCategory->slug)) ?>
</<?php echo $tag['name'] ?>>

<?php if($admin): ?>
<div class="actions a-ui">
  <input type="hidden" name="slug" value="<?php echo $product->slug ?>">
  <input type="hidden" name="url" value="<?php echo url_for('aProductItem_editProduct') ?>">

  <?php echo a_js_button('Edit', array('icon','no-label', 'a-edit', 'edit-product')) ?>
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
<?php endif ?>