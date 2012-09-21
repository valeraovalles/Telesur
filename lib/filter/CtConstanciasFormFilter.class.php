<?php

/**
 * CtConstancias filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class CtConstanciasFormFilter extends BaseCtConstanciasFormFilter
{
  protected $datos = null;
  protected static $estatus= array(''=>'','n'=>'Nueva','v'=>'En proceso','c'=>'Culminada');
  protected static $tipos= array(''=>'','sn'=>'Sueldo Normal','sb'=>'Sueldo Básico','si'=>'Sueldo Integral','san'=>'Sueldo Anual Normal','sab'=>'Sueldo Anual Básico','sai'=>'Sueldo Anual Integral');
  
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
	
  
  public function configure()
  {
  	
    $this->setWidgets(array(
      'id_solicitante'    => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'tipo_constancia'     => new sfWidgetFormSelect(array('choices' => self::$tipos)),
      'estatus'     => new sfWidgetFormSelect(array('choices' => self::$estatus)),
    ));
    
    $this->widgetSchema->setNameFormat('constancias_filters[%s]');
  	  	
    $this->setDefault('id_solicitante', $this->datos['id_solicitante']);
    $this->setDefault('tipo_constancia', $this->datos['tipo_constancia']);
    $this->setDefault('estatus', $this->datos['estatus']);

  }
}
