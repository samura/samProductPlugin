  <div class="product-thumbnail">
  <?php a_slot('aproduct-mainImage-'.$product->slug, 'aSlideshow', array(
    'class' => 'product-image',
    'edit' => false,
    'global' => true,
    'width' => false,
    'height' => 200)) ?>
  </div>
    
  <?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug)) ?>
  