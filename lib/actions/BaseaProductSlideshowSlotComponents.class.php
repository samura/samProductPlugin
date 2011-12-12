<?php
class BaseaProductSlideshowSlotComponents extends aSlotComponents
{
	public function executeEditView()
	{
		// Must be at the start of both view components
		$this->setup();

		// Careful, don't clobber a form object provided to us with validation errors
		// from an earlier pass
		if (!isset($this->form))
		{
			$this->form = new aProductSlideshowSlotEditForm($this->id, $this->slot->getArrayValue());
		}
	}
	public function executeNormalView()
	{
		$this->setup();
		$this->values = $this->slot->getArrayValue();

		$this->product = $this->getProduct();
		
		$this->text = $this->product->getText(100);
		
		$this->media = $this->product->getMedia();
	}
	 
	protected function getProduct()
	{
		$category = isset($this->values['category']);
		//$random = isset($this->values['random']) && $this->values['random'];
		 
		$query = Doctrine::getTable('Product');
		 
		if($category)
		$query = $query->createQuery('p')->leftJoin('p.ProductCategory c')->where('c.id = ?', $this->values['category']);
		else
		$query = $query->createQuery();
		 
		//if($random)
		$query = $query->orderBy('RAND()');
		 
		return $query->fetchOne();


		/*if(isset($this->values['random']) && $this->values['random']) {
		 $count = $query->select('count(*)')->fetchOne(array(), Doctrine::HYDRATE_NONE);
		return $query->limit(1) ->offset(rand(0, $count[0] - 1)) ->fetchOne();
		}
		else
		return $query->fetchOne();*/
	}
}
