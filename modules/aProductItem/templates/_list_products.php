<?php $pagerUrl = isset($category) ? $category->getUrl().'?' : url_for('aProductItem/all?') ?>
<?php if(isset($category) && $admin): ?>
<div class="actions a-ui">
  <?php echo a_js_button('<span class="icon"></span>'.__('Add Product'), array('a-btn','icon', 'big', 'a-add', 'add-product'), 'add-product') ?>
  <div class="add">
    <?php echo form_tag('aProductItem_product_add') ?>
      <input type="text" name="product">
      <input type="hidden" name="category" value="<?php echo $category->id ?>">
      <?php echo a_js_button(__('Save'), array('a-btn','a-save', 'save-product')) ?>
    </form>
  </div>
</div>
<?php endif ?>

<ul class="products a-ui <?php echo isset($category) ? $category->slug : 'all' ?>">
  <?php if ($pager->haveToPaginate()): ?>
  	<?php include_partial('aProductItem/pager', array('max_per_page' => $max_per_page, 'pager' => $pager, 'pagerUrl' => $pagerUrl)) ?>
  <?php endif ?>

  <?php foreach ($pager->getResults() as $product): ?>
    <li><?php include_partial('product_title', array('product' => $product, 'admin' => $admin)) ?></li>
  <?php endforeach ?>
  
  <?php if ($pager->haveToPaginate()): ?>
    	<?php include_partial('aProductItem/pager', array('max_per_page' => $max_per_page, 'pager' => $pager, 'pagerUrl' => $pagerUrl)) ?>
  <?php endif ?>
</ul>
