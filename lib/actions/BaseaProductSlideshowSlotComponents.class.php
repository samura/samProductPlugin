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
		
		if ($this->product) {
			$this->text = $this->product->getRichText(100);
			$this->media = $this->product->getMedia();
		}
	}
	 
	protected function getProduct()
	{
		$category = isset($this->values['category']);
		
		$engine = isset($this->values['engine']);
		 
		$query = Doctrine::getTable('Product')->createQuery('p');
		
		if($engine || $category) {
			$query->leftJoin('p.ProductCategory c');
			
			if($engine) {
				$query->where('c.page_id = ?', $this->values['engine']);
				if($category)
					$query->andWhere('c.id = ?', $this->values['category']);
			}
			else
				$query->where('c.id = ?', $this->values['category']);
		}
		

		$query = $query->orderBy('RAND()');
		 
		return $query->fetchOne();
	}
}
