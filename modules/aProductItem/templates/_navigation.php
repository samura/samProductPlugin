<?php use_helper('JavascriptBase') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php include_partial('navigation_categories', array('product_categories' => $product_categories, 'admin' => $admin)) ?>

<ul class="products default">
</ul>

<?php include_partial('navigation_products', array('product_categories' => $product_categories, 'admin' => $admin)) ?>

<?php javascript_tag() ?>
$('.add-product-category, .add-product').click(function(){
  $(this).hide();
  $(this).next().show();
});

$('.save-product-category, .save-product').click(function(){
  $(this).parent().submit();
});

$('.categories li').click(function(){
  $('.product-list .products').hide();
  $('.product-list .'+$(this).attr('class')).show();
});
<?php end_javascript_tag() ?>