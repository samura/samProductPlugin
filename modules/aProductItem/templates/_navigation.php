<?php use_helper('JavascriptBase') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<ul class="categories a-ui">
<?php foreach($product_categories as $category): ?>
  <li class="<?php echo $category->slug ?>"><?php echo $category ?></li>
<?php endforeach; ?>
  <?php if($admin): ?>
  <li>
    <?php echo a_js_button('<span class="icon"></span>Add Category', array('a-btn','icon', 'a-add', 'add-product-category')) ?>
    <div class="add">
      <?php echo form_tag('aProductItem_category_add') ?>
      <input type="text" name="category">
      <?php echo a_js_button('Save', array('a-btn','a-save', 'save-product-category')) ?>
      </form>
    </div>
  </li>
  <?php endif ?>
</ul>

<ul class="products default">
</ul>
<?php foreach($product_categories as $category): ?>
<ul class="products a-ui <?php echo $category->slug ?>">
  <?php foreach($category->Product as $product): ?>  
    <li><?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug)) ?></li>
  <?php endforeach; ?>
  <?php if($admin): ?>
  <li>
    <?php echo a_js_button('<span class="icon"></span>Add Product', array('a-btn','icon', 'a-add', 'add-product'), 'add-product') ?>
    <div class="add">
      <?php echo form_tag('aProductItem_product_add') ?>
      <input type="text" name="product">
      <input type="hidden" name="category" value="<?php echo $category->id ?>">
      <?php echo a_js_button('Save', array('a-btn','a-save', 'save-product')) ?>
      </form>
    </div>
  </li>
  <?php endif ?>
</ul>
<?php endforeach; ?>


<?php javascript_tag() ?>
$('.add-product-category, .add-product').click(function(){
  $(this).hide();
  $(this).next().show();
});

$('.save-product-category, .save-product').click(function(){
  $(this).parent().submit();
});

$('.categories li').click(function(){
  $('.product-list .products').hide();
  $('.product-list .'+$(this).attr('class')).show();
});
<?php end_javascript_tag() ?>