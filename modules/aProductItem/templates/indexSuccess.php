<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>

<?php // display error and info messages ?>
<?php include_partial('messages') ?>

<?php if($admin):  // adds new category ?>
    <?php echo a_js_button('<span class="icon"></span>Add Category', array('a-btn','icon', 'a-add', 'add-product-category')) ?>
    <div class="add">
      <?php echo form_tag('aProductItem_category_add') ?>
      <input type="text" name="category">
      <?php echo a_js_button('Save', array('a-btn','a-save', 'save-product-category')) ?>
      </form>
    </div>
 <?php endif ?>

<ul class="categories a-ui">
<?php foreach($categories as $category): ?>
  <li class="<?php echo $category->slug ?>"><?php include_partial('category_title', array('admin' => $admin, 'category' => $category)) ?></li>
<?php endforeach; ?>
</ul>

<?php //include_partial('navigation', array('product_categories' => $categories, 'admin' => $admin)) ?>


<?php javascript_tag() ?>
$('.add').hide();

$('.add-product-category').click(function(event){
  $(this).hide();
  $(this).next().show();
  event.preventDefault();
});

$('.save-product-category').click(function(){
  $(this).parent().submit();
});
<?php end_javascript_tag() ?>
