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
		
	<ul class="a-nav a-nav-<?php echo $name ?> accordion nav-depth-0 clearfix" id="a-nav-<?php echo $name ?>-0">
	<?php $count_c = count($product_categories)?>	
	<?php foreach($product_categories as $pos => $category): ?>	
		<?php $products = $category->Product ?>
	    <li class="<?php echo $class;
	        if(strcmp($active, $category->slug) == 0) echo ' current-page'; 
	        if(!empty($products) && count($products) != 0) echo ' ancestor';
	        if($pos == 0) echo ' first';
	        if($pos == 1) echo ' second';
	        if($pos == $count_c-2) echo ' next-last';
	        if($pos == $count_c-1) echo ' last'
	    ?>" id="a-nav-item-<?php echo $name ?>-<?php echo $category->id?>">
	
	  		<?php echo link_to($category, $category->getUrl()) ?>
	        	
	      <?php if(!empty($products) && count($products) != 0): //if has children?>
	      <ul class="a-nav a-nav-<?php echo $name ?> accordion nav-depth-1 clearfix" id="a-nav-<?php echo $name ?>-1">
			<?php $count_p = count($products)?>
	      	<?php foreach($products as $pos2 => $product): ?>
	      	<li class="<?php echo $class;
					if(strcmp($active, $product->slug) == 0) echo ' current-page';
					if($pos2 == 0) echo ' first';
	      	        if($pos2 == 1) echo ' second';
	      	        if($pos2 == $count_p-2) echo ' next-last';
	      	        if($pos2 == $count_p-1) echo ' last'
	      	    ?>" id="a-nav-item-<?php echo $name ?>-<?php echo $product->id?>">
					<?php echo link_to($product, $product->getUrl())?>
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
