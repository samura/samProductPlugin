<?php if(isset($category)):?>

 <?php if($admin): // adds new product ?>
    <?php echo a_js_button('<span class="icon"></span>Add Product', array('a-btn','icon', 'a-add', 'add-product'), 'add-product') ?>
    <div class="add">
      <?php echo form_tag('aProductItem_product_add') ?>
      <input type="text" name="product">
      <input type="hidden" name="category" value="<?php echo $category->id ?>">
      <?php echo a_js_button('Save', array('a-btn','a-save', 'save-product')) ?>
      </form>
    </div>
 <?php endif ?>

<ul class="products a-ui <?php echo $category->slug ?>">
  <?php foreach($category->Product as $product): ?>  
    <li><?php include_partial('product_title', array('product' => $product)) ?></li>
  <?php endforeach; ?>
</ul>


<?php elseif (isset($products)):?>
<ul class="products a-ui all">
<?php foreach($products as $product): ?>
    <li><?php include_partial('product_title', array('product' => $product)) ?></li>
  <?php endforeach; ?>
</ul>
<?php endif ;?>



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
