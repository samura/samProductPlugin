<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product show') ?>

<div class="product-header">
  <?php include_partial('product_title', array('product' => $product, 'tag' => array('name' => 'h1'))) ?>
</div>

<?php include_partial('product', array('product' => $product)) ?>
