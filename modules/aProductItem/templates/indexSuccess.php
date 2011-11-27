<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>

<h1><?php echo $page ?></h1>

<ul class="product-wrapper">
<?php foreach($products as $product): ?>
  <li class="product"><?php include_partial('product_slot', array('product' => $product)) ?></li>
<?php endforeach; ?>
</ul>