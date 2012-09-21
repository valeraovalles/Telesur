<?php
class SitsolicitudsolicitudForm extends sfForm
{

  protected $datos = null;
  protected $ext = null;

  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function setExt($ext)
  {
	  	$this->ext = $ext;
	   	$this->configure();
  }
  
  public function configure()
  {
          
    $this->disableLocalCSRFProtection();

    $this->setWidgets(array(
        'idunidad'       => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => true)),
        'extension'   => new sfWidgetFormInputText(),
        'solicitud'   => new sfWidgetFormTextarea(array(),array('id'=>'sol')),  
        'archivo1' => new sfWidgetFormInputFile(array(),array('size'=>'6px')),
        'archivo2' => new sfWidgetFormInputFile(array(),array('size'=>'6px')),
    ));

    $this->setValidators(array(
        'idunidad'     => new sfValidatorString(),
        'extension'   => new sfValidatorString(array('max_length' => 500)),
        'solicitud'   => new sfValidatorString(array('max_length' => 500)),
        'archivo1' => new sfValidatorFile(array('required'=>false)),
        'archivo2' => new sfValidatorFile(array('required'=>false)),
    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setDefault('idunidad', $this->datos['idunidad']);
    
    $this->setDefault('solicitud', $this->datos['solicitud']);
    
    if($this->datos==null)
    $this->setDefault('extension', $this->ext);
    
    else
    $this->setDefault('archivo1', $this->datos['archivo1']);
    
    $this->setDefault('archivo2', $this->datos['archivo2']);
    
    

    
    $this->widgetSchema->setLabels(array(
        'idunidad'       => 'Unidad: ',
    ));
      
  }
}
?>
