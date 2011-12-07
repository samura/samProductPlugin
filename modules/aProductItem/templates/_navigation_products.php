<?php foreach($product_categories as $category): ?>

<ul class="products a-ui <?php echo $category->slug ?>">
  <?php foreach($category->Product as $product): ?>  
    <li><?php include_partial('product_title', array('admin' => $admin, 'product' => $product)) ?></li>
  <?php endforeach; ?>
  
  <?php if($admin): // adds new product ?>
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