<?php

/**
 * EstSolicitudes filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class EstSolicitudesFormFilter extends BaseEstSolicitudesFormFilter
{
  protected $datos = null;
  protected static $est= array(''=>'','A'=>'Estudio A','B'=>'Estudio B','C'=>'Estudio C'); 
  protected static $esta= array(''=>'','a'=>'Aprobado','r'=>'Rechazado','e'=>'En espera'); 
  
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
      
      
    $this->setWidgets(array(
        
        'estudio'      => new sfWidgetFormSelect(array('choices' => self::$est)),
        'responsable'  => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
        'desde'        => new sfWidgetFormPropelChoice(array('model' => 'EstHoras','key_method' => 'getHora', 'add_empty' => true)),
        'hasta'        => new sfWidgetFormPropelChoice(array('model' => 'EstHoras','key_method' => 'getHora', 'add_empty' => true)),
        'estatus'     =>  new sfWidgetFormSelect(array('choices' => self::$esta)),
        
    ));

    $this->setValidators(array(
        'estudio'          => new sfValidatorString(),
        'responsable'          => new sfValidatorString(),
        'desde'      => new sfValidatorTime(),
        'hasta'      => new sfValidatorTime(),
        'estatus'          => new sfValidatorString(),

    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->setDefault('estudio', $this->datos['estudio']);
    $this->setDefault('responsable', $this->datos['responsable']);
    $this->setDefault('desde', $this->datos['desde']);
    $this->setDefault('hasta', $this->datos['hasta']);
    $this->setDefault('estatus', $this->datos['estatus']);
  }
}
