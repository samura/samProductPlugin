<?php use_helper('JavascriptBase') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php include_partial('navigation_categories', array('product_categories' => $product_categories, 'admin' => $admin)) ?>

<ul class="products default">
</ul>

<?php include_partial('navigation_products', array('product_categories' => $product_categories, 'admin' => $admin)) ?>