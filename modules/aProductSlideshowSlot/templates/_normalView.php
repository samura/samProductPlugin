<?php use_helper('a') ?>

<?php if($editable):?>
	<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php endif ?>

<?php if (isset($product)): ?>
 <h1><?php echo $product ?></h1>
 <?php echo $product->getText( 100); ?>
 
<?php endif ?>