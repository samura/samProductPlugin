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
  public function preExecute()
  {
    $this->getResponse()->addJavascript('/samProductPlugin/js/samProduct.js');
    parent::preExecute();
  }

  /**
   * Execute 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->max_per_page = sfConfig::get('app_samProduct_max_per_page_category');
    $this->pager = $this->getPager( Doctrine::getTable('ProductCategory')
		->createQuery()
		->where('page_id = ?', $this->page->id)
    );
  }
  
  /**
   * Show all products
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeAll(sfWebRequest $request)
  {
    $this->max_per_page = sfConfig::get('app_samProduct_max_per_page_product');
    
    $this->pager = $this->getPager(Doctrine::getTable('Product')
    	->createQuery('p')
    	->leftJoin('p.ProductCategory c')
    	->where('c.page_id = ?', $this->page->id)
    );
  }
  
  /**
  * Show a single category
  *
  * @param sfWebRequest $request The request parameters
  */
  public function executeCategory(sfWebRequest $request)
  {
  	$this->category = $this->getRoute()->getObject();
  	
  	$this->max_per_page = sfConfig::get('app_samProduct_max_per_page_product');
  	
  	//TODO melhorar a query
  	$query = Doctrine::getTable('Product')
      ->createQuery('p')
      ->leftJoin('p.ProductCategory c')
      ->where('c.id = ?', $this->category->id);
  	
  	$this->pager = $this->getPager($query);
  	
  	$this->setPageBy($this->category);
  }
  
  /**
   * Show a single product 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeShow(sfWebRequest $request)
  {
  	$this->forward404Unless(
	    $this->product = Doctrine::getTable('Product')
	      ->createQuery('p')
	      ->leftJoin('p.ProductCategory c')
	      ->where('c.slug = ?', $request->getParameter('cat'))
	      ->andWhere('p.slug = ?', $request->getParameter('slug'))
  		  ->andWhere('c.page_id = ?', $this->page->id)
	      ->fetchOne()
  	);
    $this->setPageBy($this->product);
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
    $category->Page = $this->page;
    $category->save();
    
    $this->redirect('aProductItem_category', array('slug' => $category->slug, 'engine-slug' => $category->Page->slug));
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
    
    $this->redirect('aProductItem_show', array('slug' => $product->slug, 'cat' => $category->slug, 'engine-slug' => $category->Page->slug));
  }
 
  
  /**
   * Shows form or submit 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeEditCategory(sfWebRequest $request)
  {
  	if($request->getMethod() == sfRequest::POST)
  	{
  		$category = Doctrine::getTable('ProductCategory')->find($request['product_category']['id']);
  		$form = new ProductCategoryForm($category);
  		$form->bind($request->getParameter('product_category'));
  		if($form->isValid())
  		$form->save();
  		else
  		$this->getUser()-setFlash('error', 'The category name you entered is not valid.');
  
  		$this->redirect($request->getReferer());
  	}
  	$category = Doctrine::getTable('ProductCategory')->findOneBySlug($request->getParameter('slug'));
  	$this->form = new ProductCategoryForm($category);
  }
  
  /**
   * Shows form or submit 
   *
   * @param sfWebRequest $request The request parameters
   */
  public function executeEditProduct(sfWebRequest $request)
  {
    if($request->getMethod() == sfRequest::POST)
    {
      $product = Doctrine::getTable('Product')->find($request['product']['id']);
      $form = new ProductForm($product);
      $form->bind($request->getParameter('product'));
      if($form->isValid())
        $form->save();
      else
        $this->getUser()-setFlash('error', 'The product name you entered is not valid.');
      
      $this->redirect($request->getReferer());  
    }
    $product = Doctrine::getTable('Product')->findOneBySlug($request->getParameter('slug'));
    $this->form = new ProductForm($product);
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
  			$this->deleteCategory($request->getParameter('slug'), $request->getReferer());	
  			break;
  		case 'product':
  			$this->deleteProduct($request->getParameter('slug'), $request->getReferer());
  			break;
  		default:
  			$this->forward404();
  	}
  }
  
  /*
   * tests if can delete a ProductCategory and deletes it
   * param string $slug The ProductCategory slug
   */
  protected function deleteCategory($slug, $referer)
  {
    $this->forward404Unless(
      $category = Doctrine::getTable('ProductCategory')->findOneBySlug($slug));
      
    $engine_slug = $category->Page->slug;
    
    // test if has products or other categories in it
    if(sizeof($category->Product) || sizeof($category->ChildProductCategory)) {
      $this->getUser()->setFlash('error', 'You can only delete empty categories.');
      $this->redirect($referer);
    }
    
    $page = aPageTable::retrieveBySlugWithSlots($category->getPageSlug());
    if($page)
    	$page->delete();
  
    $category->delete();
    
    $this->getUser()->setFlash('message', 'Category successfully deleted.');
    $this->redirect('aProductItem_index', array ('engine-slug' => $engine_slug));
  }
  
  /*
   * deletes a product and all the slots in it
   * param string $slug The Product slug
   */
  protected function deleteProduct($slug)
  {
    $this->forward404Unless(
      $product = Doctrine::getTable('Product')->findOneBySlug($slug));
    
    $engine_slug = $product->ProductCategory->Page->slug;
      
    // delete every slot used by the product
    $page = aPageTable::retrieveBySlugWithSlots($product->getPageSlug());
    if($page)
      $page->delete();
    
    $product->delete();
    
    $this->getUser()->setFlash('message', 'Product successfully deleted.');
    $this->redirect('aProductItem_category', array('slug' => $product->ProductCategory->slug, 'engine-slug' => $engine_slug));
  }
  

  /*
   * gets or creates a new aPage for the product or category given
   * param Product/Category $item
   * param $perfix 
   */
  protected function setPageBy($item)
  { 
    $newPage = aPageTable::retrieveBySlugWithSlots($item->getPageSlug());
    if(!$newPage)
    {
      $newPage = new aPage();
      $newPage->getNode()->insertAsFirstChildOf($this->page);
      $newPage->slug = $item->getPageSlug();
      //TODO por titulo $newPage->setTitle($item);
      $newPage->save();
    }
    aTools::setCurrentPage($newPage);
  }
  
  protected function getPager($query) {
  	$pager = new sfDoctrinePager($this->modelClass);
  	$pager->setMaxPerPage($this->max_per_page);
  	$pager->setQuery($query);
  	$pager->setPage($this->getRequestParameter('page', 1));
  	$pager->init();
  	
  	return $pager;
  }
  
}
