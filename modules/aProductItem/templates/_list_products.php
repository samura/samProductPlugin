<?php if(isset($category) && $admin): ?>

  <?php echo a_js_button('<span class="icon"></span>Add Product', array('a-btn','icon', 'a-add', 'add-product'), 'add-product') ?>
  <div class="add">
    <?php echo form_tag('aProductItem_product_add') ?>
      <input type="text" name="product">
      <input type="hidden" name="category" value="<?php echo $category->id ?>">
      <?php echo a_js_button('Save', array('a-btn','a-save', 'save-product')) ?>
    </form>
  </div>
<?php endif ?>

<ul class="products a-ui <?php echo isset($category) ? $category->slug : 'all' ?>">
  <?php foreach($products as $product): ?>  
    <li><?php include_partial('product_title', array('product' => $product)) ?></li>
  <?php endforeach; ?>
</ul>

<?php javascript_tag() ?>
$('.add').hide();

$('.add-product').click(function(event){
  $(this).hide();
  $(this).next().show();
  event.preventDefault();
});

$('.save-product').click(function(){
  $(this).parent().submit();
});
<?php end_javascript_tag() ?>
