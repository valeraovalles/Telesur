<?php
class Formulariocorrespondencia extends sfForm
{
        protected $datos = null;
    
      public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  
  public function configure()
  {
      
     $this->disableLocalCSRFProtection();
      
     $this->setWidgets(array(
      //'fecha_salida'         => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      //'hora_salida'          => new sfWidgetFormTime(),
      'extension' => new sfWidgetFormInputText(),
      'direccion_traslado' => new sfWidgetFormTextarea(),
      'datos_interes_razon'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      //'fecha_salida'         => new sfValidatorDate(),
      //'hora_salida'          => new sfValidatorTime(),
      'extension' => new sfValidatorInteger(),
      'direccion_traslado' => new sfValidatorString(array('max_length' => 500)),
      'datos_interes_razon'        => new sfValidatorString(array('max_length' => 500)),
    ));


    $this->widgetSchema->setNameFormat('tra_correspondencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   
    //$this->setDefault('fecha_salida', $this->datos['fecha_salida']);
    //$this->setDefault('hora_salida', $this->datos['hora_salida']);
    $this->setDefault('direccion_traslado', $this->datos['direccion_traslado']);
    $this->setDefault('datos_interes_razon', $this->datos['datos_interes_razon']);
      
  }
}
?>
