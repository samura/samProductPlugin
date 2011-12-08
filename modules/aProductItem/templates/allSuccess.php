<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product all') ?>

<?php include_partial('breadcrumb', array('page' => $page)) ?>
<?php include_partial('subnav') ?>

<?php include_partial('list_products', array('admin' => $admin, 'products' => $products)) ?>
