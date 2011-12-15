<?php

/**
 * aProductItem components.
 *
 * @package    symfony
 * @subpackage aProductItem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BaseaProductItemComponents extends sfComponents
{
  public function executeSubnav(sfWebRequest $request)
  {
    $this->product_categories = Doctrine::getTable('ProductCategory')->createQuery()->execute();
    
    $pageSlug = aTools::getCurrentPage()->slug;
    
    $prefix = sfConfig::get('app_samProduct_prefixProduct');
    if (substr($pageSlug, 0, strlen($prefix) ) == $prefix) {
    	$pageSlug = substr($pageSlug, strlen($prefix), strlen($pageSlug) );
    }
    
    $prefix = sfConfig::get('app_samProduct_prefixCategory');
    if (substr($pageSlug, 0, strlen($prefix) ) == $prefix) {
    	$pageSlug = substr($pageSlug, strlen($prefix), strlen($pageSlug) );
    }
    
    $this->active = $pageSlug;
  }
}
