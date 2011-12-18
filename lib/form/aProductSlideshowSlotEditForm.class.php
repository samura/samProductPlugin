<?php    
class aProductSlideshowSlotEditForm extends BaseForm
{
  // Ensures unique IDs throughout the page
  protected $id;
  public function __construct($id, $defaults = array(), $options = array(), $CSRFSecret = null)
  {
    $this->id = $id;
    parent::__construct($defaults, $options, $CSRFSecret);
  }
  public function configure()
  {
  	$engine = $this->defaults['engine'];
  	if($engine)
  		$query_category = Doctrine::getTable('ProductCategory')->createQuery('c')->leftJoin('c.Page p')->where('p.id = ?', $engine)->leftJoin('c.Translation')->orderBy('title');
  	else
  		$query_category = Doctrine::getTable('ProductCategory')->createQuery('c')->leftJoin('c.Translation')->orderBy('title');
  		
  	
  	$query_engine = Doctrine::getTable('aPage')->createQuery('p')->leftJoin('p.ProductCategory c')->where("c.page_id = p.id");
  	
  	
    // ADD YOUR FIELDS HERE
    $this->setWidgets(array('engine' => new sfWidgetFormDoctrineChoice(array('model' => 'aPage', 'query' => $query_engine, 'add_empty' => 'all')),
    						'category' => new sfWidgetFormDoctrineChoice(array('model' => 'ProductCategory', 'query' => $query_category, 'add_empty' => 'all', 'order_by' => array('id','desc'))),
    						//'random' =>  new sfWidgetFormInputCheckbox(array('value_attribute_value' => true)),
    						//'delay' =>  new sfWidgetFormInput(),
    
    ));
    
    $this->setValidators(array('engine' => new sfValidatorDoctrineChoice(array('model' => 'aPage', 'required' => false)),
    						   'category' => new sfValidatorDoctrineChoice(array('model' => 'ProductCategory', 'required' => false)),
    						  // 'delay' => new sfValidatorInteger(array('required' => false, 'max' => '999', 'min' => 0)),
   							  // 'random' => new sfValidatorBoolean(array('required' => false)),
    ));
   
    //$this->setDefault('random', true);
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
}
