<?php
class SolicitudestudiosForm extends sfForm
{

  protected $datos = null;
  protected static $est= array(''=>'','A'=>'Estudio A','B'=>'Estudio B','C'=>'Estudio C');
  

  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
    $this->disableLocalCSRFProtection();
    
    $this->setWidgets(array(
        'estudio'          => new sfWidgetFormSelect(array('choices' => self::$est)),
        'desde'  => new sfWidgetFormPropelChoice(array('model' => 'EstHoras','key_method' => 'getHora', 'add_empty' => true)),
        'hasta'  => new sfWidgetFormPropelChoice(array('model' => 'EstHoras','key_method' => 'getHora', 'add_empty' => true)),
        'producto'  => new sfWidgetFormPropelChoice(array('model' => 'EstProductos', 'add_empty' => true),array()),
        'observaciones'  => new sfWidgetFormTextarea(),
                
    ));

    $this->setValidators(array(
        'estudio'          => new sfValidatorString(),
        'desde'      => new sfValidatorTime(),
        'hasta'      => new sfValidatorTime(),
        'producto'          => new sfValidatorString(),
        'observaciones'          => new sfValidatorString(),
  
    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   
    $this->setDefault('estudio', $this->datos['estudio']);
    $this->setDefault('desde', $this->datos['desde']);
    $this->setDefault('hasta', $this->datos['hasta']);
    $this->setDefault('producto', $this->datos['producto']);
    $this->setDefault('observaciones', $this->datos['observaciones']);

    
    
      
  }
}
?>
