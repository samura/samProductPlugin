<?php slot('a-body-class','a-product search') ?>
<div class="a-blog-main">

  <?php foreach($products as $product): ?>
    <div class="product-item">
      <h3 class="a-blog-item-title"><?php echo link_to($product->title, $product->getUrl()) ?></h3>
      
      <div class="a-blog-item-excerpt">      
        <?php echo $product->getTextForArea('aproduct-description', 50) ?>
      </div>
       
      <div class="a-blog-item-media">
        <?php include_component('aSlideshowSlot', 'slideshow', array(
    	    'items' => $product->getMedia(),
  	      'options' => array ('width' => 200, 'height' => 150, 'resizeType' => 'c',)))?>
      </div>
      
      <hr class="a-hr"/>   
    </div>
  <?php endforeach; ?>
  
</div>