<?php use_helper('a','JavascriptBase', 'I18N') ?>
<?php $admin = $sf_user->isAuthenticated(); ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','a-product all') ?>

<?php include_partial('breadcrumb', array('page' => $page)) ?>
<?php include_component('aProductItem', 'subnav', array('page' => $page)) ?>

<?php include_partial('list_products', array('pager' => $pager, 'admin' => $admin, 'max_per_page' => $max_per_page)) ?>
