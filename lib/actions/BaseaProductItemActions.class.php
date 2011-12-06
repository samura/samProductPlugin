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
   * Show categories 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeCategories(sfWebRequest $request)
  {
  }
  
  /**
   * Show a single product 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
    $this->page->slug = '/product/'.$this->product->slug;
  }
  
  /**
   * Add a category 
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
   * Add a product
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
  
  /**
   * Execute delete category or product
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    
    switch($request->getParameter('type'))
    {
      case 'category':
        $this->deleteCategory($request->getParameter('slug'));
        break;
      case 'product':
        $this->deleteProduct($request->getParameter('slug'));
        break;
      default:
        $this->forward404();
    }
    
    $this->redirect($this->getRequest()->getReferer());
  }
  
  /*
   * tests if can delete a ProductCategory and deletes it
   * param string $slug The ProductCategory slug
   */
  protected function deleteCategory($slug)
  {
    $this->forward404Unless(
      $category = Doctrine::getTable('ProductCategory')->findOneBySlug($slug));
      
    // test if has products or other categories in it
    if(sizeof($category->Product) || sizeof($category->ChildProductCategory))
      return $this->getUser()->setFlash('error', 'You can only delete empty categories');

    // TODO: delete every slot used by the category (if any)
  
    $category->delete();
    
    return $this->getUser()->setFlash('message', 'Category successfully deleted.');
  }
  
  /*
   * deletes a product and all the slots in it
   * param string $slug The Product slug
   */
  protected function deleteProduct($slug)
  {
    $this->forward404Unless(
      $product = Doctrine::getTable('Product')->findOneBySlug($slug));
      
    // delete every slot used by the product
    $page = aPageTable::retrieveBySlugWithSlots('/product/'.$product->slug);
    if($page)
      $page->delete();
    
    $product->delete();
    
    return $this->getUser()->setFlash('message', 'Product successfully deleted.');
  }
}
