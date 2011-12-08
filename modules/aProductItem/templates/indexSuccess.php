<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php $page = aTools::getCurrentNonAdminPage() ?>
<?php $realPage = aTools::getCurrentPage() ?>
<?php $root = aPageTable::retrieveBySlug('/') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>
<?php include_partial('breadcrumb',  array('root' => $root, 'active' => $page, 'name' => 'component', 'separator' => ' /')) ?>
<?php include_partial('subnav') ?>

<?php // display error and info messages ?>
<?php include_partial('messages') ?>

<?php if($admin):  // adds new category ?>
<div class="actions a-ui">
    <?php echo a_js_button('<span class="icon"></span>'.__('Add Category'), array('a-btn','icon', 'big', 'a-add', 'add-product-category')) ?>
    <div class="add">
      <?php echo form_tag('aProductItem_category_add') ?>
      <input type="text" name="category">
      <?php echo a_js_button(__('Save'), array('a-btn','a-save', 'save-product-category')) ?>
      </form>
    </div>
 <?php endif ?>
</div>

<ul class="categories a-ui">
<?php foreach($categories as $category): ?>
  <li class="<?php echo $category->slug ?>"><?php include_partial('category_title', array('admin' => $admin, 'category' => $category, 'tag' => 'p')) ?></li>
<?php endforeach; ?>
</ul>