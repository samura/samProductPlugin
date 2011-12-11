<?php slot('a-breadcrumb') ?>
<?php
  // Compatible with sf_escaping_strategy: true
  $page = isset($active) ? $sf_data->getRaw('page') : aTools::getCurrentPage();
  $active = isset($active) ? $sf_data->getRaw('active') : $page->slug;
  $class = isset($class) ? $sf_data->getRaw('class') : 'a-nav-item';
  $name = isset($name) ? $sf_data->getRaw('name') : 'component';
  $separator = isset($separator) ? $sf_data->getRaw('separator') : ' / ';
  $nav = $page->getAncestorsInfo(true);
?>

<ul id="a-breadcrumb-<?php echo ($name)? $name:'component' ?>" class="a-nav a-nav-breadcrumb a-nav-<?php echo ($name)? $name:'component' ?> a-breadcrumb-<?php echo ($name)? $name:'component' ?> breadcrumb clearfix">
	<?php foreach($nav as $pos => $item): //nodes until the root of the engine?>
		<?php if (!$item['archived']): ?>
			<li class="<?php echo $class; if($item['slug'] == $active) echo ' a-current-page'; ?>">
				<?php echo link_to($item['title'], aTools::urlForPage($item['slug'])) ?>
				<?php if(isset($category) || isset($product) || $pos+1 < count($nav)) echo '<span class="a-breadcrumb-separator">'.$separator.'</span>'; ?>
			</li>
		<?php endif ?>		
	<?php endforeach ?>
	
	<?php if(isset($category)):?>
	  <li class="<?php echo $class; if(!isset($product)) echo ' a-current-page'; ?>">
	  	<?php echo link_to($category, $category->getUrl()) ?>
		<?php if(isset($product)) echo '<span class="a-breadcrumb-separator">'.$separator.'</span>'; ?>
	  </li>
	<?php endif ?>

	<?php if(isset($product)):?>
	<li class="<?php echo $class ?> a-current-page">
		<?php echo link_to($product, $product->getUrl())?>
	</li>
	<?php endif ?>
</ul>
<?php end_slot()?>