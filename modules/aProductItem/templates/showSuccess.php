<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product show') ?>

<h1><?php echo $product ?></h1>

<?php include_partial('product', array('product' => $product)) ?>

