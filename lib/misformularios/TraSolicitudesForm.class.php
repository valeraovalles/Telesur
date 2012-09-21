<?php

/**
 * TraSolicitudes form.
 *
 * @package    principal
 * @subpackage form
 * @author     Your name here
 */
class TraSolicitudesForm extends BaseTraSolicitudesForm
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
      'asistentes'           => new sfWidgetFormInputHidden(),
      'fecha_salida'         => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      'hora_salida'          => new sfWidgetFormTime(),
      'direccion_traslado'   => new sfWidgetFormTextarea(),
      'descripcion_equipos'  => new sfWidgetFormTextarea(),
      'datos_interes_razon'  => new sfWidgetFormTextarea(),
      'tipo_transporte'      => new sfWidgetFormChoice(array('expanded' => true,'choices'  => array('c'=> 'Carro', 'm' => 'Moto'))),
    ));
     


    $this->setValidators(array(
      'asistentes'           => new sfValidatorString(array('max_length' => 50)),
      'fecha_salida'         => new sfValidatorDate(),
      'hora_salida'          => new sfValidatorTime(),
      'direccion_traslado'   => new sfValidatorString(array('max_length' => 500)),
      'descripcion_equipos'  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'datos_interes_razon'        => new sfValidatorString(array('max_length' => 500)),
      'tipo_transporte'      => new sfValidatorString(),  
    ));


    $this->widgetSchema->setNameFormat('tra_solicitudes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   
    $this->setDefault('fecha_salida', $this->datos['asistentes']);
    $this->setDefault('fecha_salida', $this->datos['fecha_salida']);
    $this->setDefault('hora_salida', $this->datos['hora_salida']);
    $this->setDefault('direccion_traslado', $this->datos['direccion_traslado']);
    $this->setDefault('descripcion_equipos', $this->datos['descripcion_equipos']);
    $this->setDefault('datos_interes_razon', $this->datos['datos_interes_razon']);
    
    if($this->datos['tipo_transporte']=='')$this->datos['tipo_transporte']= 'c';
    $this->setDefault('tipo_transporte', $this->datos['tipo_transporte']);
      
  }
}
