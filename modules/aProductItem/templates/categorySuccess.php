<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product category') ?>
<?php include_partial('breadcrumb', array('page' => $page, 'category' => $category)) ?>
<?php include_component('aProductItem', 'subnav') ?>

<div class="category-header">
  <?php include_partial('category_title', array('admin' => $admin, 'category' => $category, 'tag' => array('name' => 'h1'))) ?>
</div>

<?php include_partial('category', array('category' => $category)) ?>


<?php include_partial('list_products', array('admin' => $admin, 'products' => $category->Product, 'category' => $category)) ?>
