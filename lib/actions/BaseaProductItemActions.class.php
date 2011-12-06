<?php

/**
 * aProductItem actions.
 *
 * @package    symfony
 * @subpackage aProductItem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BaseaProductItemActions extends aEngineActions
{
  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->products = Doctrine::getTable('Product')
      ->createQuery()
      ->execute();
  }
  
  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeCategories(sfWebRequest $request)
  {
  }
  
  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless(
      $this->product = Doctrine::getTable('Product')->findOneBySlug($request->getParameter('slug')));
  }
  
  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeAddProductCategory(sfWebRequest $request)
  {
    $this->forward404Unless(
      $request->getParameter('category'));
      
    $category = new ProductCategory();
    $category->title = $request->getParameter('category');
    $category->save();
    
    $this->redirect($request->getReferer());
  }
  
  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeAddProduct(sfWebRequest $request)
  {
    $this->forward404Unless(
      $request->getParameter('category') && 
      $request->getParameter('product') && 
      $category = Doctrine::getTable('ProductCategory')->find($request->getParameter('category')));
    
    $product = new Product();
    $product->ProductCategory = $category;
    $product->title = $request->getParameter('product');
    
    $product->save();
    
    $this->redirect($request->getReferer());
  }
}
