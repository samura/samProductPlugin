<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product show') ?>

<?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug)) ?>
<?php a_slot('mainImage-'.$product->slug, 'aImage', array('global' => true)) ?>

