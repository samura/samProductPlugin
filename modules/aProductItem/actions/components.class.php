<?php

/**
 * aProductItem components.
 *
 * @package    symfony
 * @subpackage aProductItem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aProductItemComponents extends sfComponents
{
  public function executeNavigation(sfWebRequest $request)
  {
    $this->product_categories = Doctrine::getTable('ProductCategory')->createQuery()->execute();
  }
}
