<?php

/**
 * PluginProductCategory form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductCategoryForm extends BaseProductCategoryForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['product_category_id'], $this['slug'], $this['page_id']);
    
    $this->embedi18n(array(sfContext::getInstance()->getUser()->getCulture()));
  }
}
