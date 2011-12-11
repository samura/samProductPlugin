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
    // ADD YOUR FIELDS HERE
  	//Doctrine::getTable('ProductCategory')->createQuery()
    $this->setWidgets(array('category' => new sfWidgetFormDoctrineChoice(array('model' => 'ProductCategory', 'add_empty' => true, 'order_by' => array('id','desc'))),
    						//'random' =>  new sfWidgetFormInputCheckbox(array('value_attribute_value' => true)),
    						'delay' =>  new sfWidgetFormInput(),
    
    ));
    
    $this->setValidators(array('category' => new sfValidatorDoctrineChoice(array('model' => 'ProductCategory', 'required' => false)),
    						   'delay' => new sfValidatorInteger(array('required' => false, 'max' => '999', 'min' => 0)),
   							  // 'random' => new sfValidatorBoolean(array('required' => false)),
    ));
   
    //$this->setDefault('random', true);
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
}
