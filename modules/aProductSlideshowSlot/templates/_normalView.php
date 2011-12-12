<?php use_helper('a') ?>

<?php if($editable):?>
	<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php endif ?>

<?php if (isset($product)): ?>

 <h1 class="a-productSlot-title"><?php echo $product ?></h1>
 
  <?php if (isset($media) && !empty($media)): ?>
 <div class='a-productSlot-media'> 
  <?php include_component('aSlideshowSlot', 'slideshow', array(
  	  			'items' => $media,
  	  			'options' => array ('width' => 240, 'resizeType' => 'c',),
  	  		))?>
 </div>
 <?php endif ?>
 
 <div class='a-productSlot-text'>
  <?php echo $sf_data->getRaw('text'); ?>
 </div>

 
<?php endif ?>