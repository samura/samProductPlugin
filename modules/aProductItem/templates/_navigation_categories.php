<ul class="categories a-ui">
<?php foreach($product_categories as $category): ?>
  <li class="<?php echo $category->slug ?>"><?php include_partial('category_title', array('category' => $category)) ?></li>
<?php endforeach; ?>

  <?php if($admin):  // adds new category ?>
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