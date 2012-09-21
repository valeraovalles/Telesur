<?php

/**
 * TraSolicitudes filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class TraSolicitudesFormFilter extends BaseTraSolicitudesFormFilter
{
  protected $datos = null;
  protected static $estatus= array(''=>'','n'=>'Nueva','ap'=>'Aprobada','a'=>'Asiganada','cj'=>'Cierre justificado','c'=>'Cerrada');
 
  
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
	
  public function configure()
  {
      
      $this->setWidgets(array(
     
      'fecha_salida'          => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      'hora_salida'           => new sfWidgetFormTime(),
      'estatus'               => new sfWidgetFormSelect(array('choices' => self::$estatus)),
    ));

    $this->setValidators(array(
      'fecha_salida'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'hora_salida'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'estatus'               => new sfValidatorPass(array('required' => false)),
    
    ));

    $this->widgetSchema->setNameFormat('tra_solicitudes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->setDefault('fecha_salida', $this->datos['fecha_salida']);
    $this->setDefault('hora_salida', $this->datos['hora_salida']);
    $this->setDefault('estatus', $this->datos['estatus']);
    
    $this->widgetSchema->setLabels(array(
        'fecha_salida'       => 'Fecha busqueda: ',
        'hora_salida'       => 'Hora busqueda: ',
    ));
        
  }
}


