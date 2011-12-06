<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>

<div class="category-list">

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
  <li class="<?php echo $category->slug ?>"><?php include_partial('category_title', array('category' => $category)) ?></li>
<?php endforeach; ?>
</ul>
</div>

<?php //include_component('aProductItem','navigation') ?>



<?php javascript_tag() ?>
$('.add-product-category, .add-product').click(function(){
  $(this).hide();
  $(this).next().show();
});

$('.save-product-category, .save-product').click(function(){
  $(this).parent().submit();
});
<?php end_javascript_tag() ?>
