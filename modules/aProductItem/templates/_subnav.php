<?php slot('a-subnav') ?>
<?php use_helper('a') ?>
<?php
  // Compatible with sf_escaping_strategy: true
  $page = isset($active) ? $sf_data->getRaw('page') : aTools::getCurrentPage();
  $active = isset($active) ? $sf_data->getRaw('active') : $page->slug;
  $class = isset($class) ? $sf_data->getRaw('class') : 'a-nav-item';
  $name = isset($name) ? $sf_data->getRaw('name') : 'subnav';
?>

<div class="a-ui a-subnav-wrapper">
	<div class="a-subnav-inner">
		
	<ul class="a-nav a-nav-<?php echo $name ?>' accordion nav-depth-0 clearfix <?php echo $ulClass ?>" id="a-nav-<?php echo $name ?>-0">
	
	<?php foreach($product_categories as $pos => $category): ?>	
	    <li class="<?php echo $class;
	        if(strpos($active, $category->slot) !== FALSE) echo ' a-current-page';
	        if(!empty($category->Product)) echo ' ancestor';
	        if($pos == 0) echo ' first';
	        if($pos == 1) echo ' second';
	        if($pos == count($product_categories)-2) echo ' next-last';
	        if($pos == count($product_categories)-1) echo ' last'
	    ?>" id="a-nav-item-<?php echo $name ?>-<?php echo $category->id?>">
	
	      <?php echo link_to($category, 'aProductItem_category', array('slug' => $category->slug)) ?>
	
	      <?php if(!empty($category->Product)): //if has children?>
	      <ul class="a-nav a-nav-<?php echo $name ?>' accordion nav-depth-1 clearfix <?php echo $ulClass ?>" id="a-nav-<?php echo $name ?>-1">
	      <?php foreach($category->Product as $pos2 => $product): ?>
	      	<li class="<?php echo $class;
	      	        if(strpos($active, $product->slot) !== FALSE) echo ' a-current-page';
	      	        if($pos2 == 0) echo ' first';
	      	        if($pos2 == 1) echo ' second';
	      	        if($pos2 == count($category->Product)-2) echo ' next-last';
	      	        if($pos2 == count($category->Product)-1) echo ' last'
	      	    ?>" id="a-nav-item-<?php echo $name ?>-<?php echo $product->id?>">
	      
	      		<?php echo link_to($product, 'aProductItem_show', array('slug' => $product->slug, 'cat' => $category->slug)) ?>
	      	</li>
	      <?php endforeach; ?>
	      </ul>
	      <?php endif; ?>
	      
	    </li>
	  <?php endforeach ?>
	</ul>
	</div>
</div>
<?php end_slot() ?>
