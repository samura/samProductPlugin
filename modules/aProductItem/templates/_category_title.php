<?php $tag = (isset($tag)) ? $tag : array('name' => 'span') ?>
<div class="product-category-title">
<<?php echo $tag['name'] ?> class="<?php if(isset($tag['class'])) echo $tag['class'] ?>">
  <?php echo link_to($category, $category->getUrl()) ?>
</<?php echo $tag['name'] ?>>

<?php if($admin): ?>
<div class="actions a-ui">
  <input type="hidden" name="slug" value="<?php echo $category->slug ?>">
  <input type="hidden" name="url" value="<?php echo url_for('aProductItem_editCategory') ?>">
  
  <?php echo a_js_button('Edit', array('icon','no-label', 'a-edit', 'edit-product-category')) ?>
  <?php echo link_to(
    '<span class="icon"></span>', 
    'aProductItem_delete', 
    array(
      'type' => 'category', 
      'slug' => $category->slug),
    array(
      'class' => 'a-btn icon alt no-label a-delete', 
      'method' => 'delete', 
      'confirm' => a_('This will also delete all of its products! Are you sure you want to continue?'))) ?>
</div>
<?php endif ?>
</div>