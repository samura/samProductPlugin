<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>

<div class="product-list">
<?php include_component('aProductItem','navigation') ?>
</div>

<?php a_slot('index-products', 'aSlideshow', array('width' => 410)) ?>