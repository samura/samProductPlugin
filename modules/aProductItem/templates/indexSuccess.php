<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product index') ?>

<div class="product-list">
<?php include_component('aProductItem','navigation') ?>
</div>
