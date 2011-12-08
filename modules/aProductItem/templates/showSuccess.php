<?php use_helper('a') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product show') ?>

<?php include_partial('breadcrumb') ?>
<?php include_partial('subnav') ?>

<div class="product-header">
  <?php include_partial('product_title', array('admin' => $admin, 'product' => $product, 'tag' => array('name' => 'h1'))) ?>
</div>

<?php include_partial('product', array('product' => $product)) ?>
