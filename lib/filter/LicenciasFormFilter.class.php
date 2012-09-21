<?php

/**
 * Licencias filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class LicenciasFormFilter extends BaseLicenciasFormFilter
{
    
	
  protected $datos = null;
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
	
	
	
  public function configure()
  {
  	
  	$this->setWidgets(array(
      'nombre_licencia'   => new sfWidgetFormInputText(),
      'numero'            => new sfWidgetFormInputText(),
      'fecha_compra'      => new sfWidgetFormInputText(array(),array("class"=>"tcal")),
      'fecha_vencimiento' => new sfWidgetFormInputText(array(),array("class"=>"tcal")),
      //'descripcion'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'responsable'       => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      //'bandera_correo'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));
    
    
   
    $this->setDefault('nombre_licencia', $this->datos['nombre']);
    $this->setDefault('numero', $this->datos['numero']);
    $this->setDefault('fecha_compra', $this->datos['fc']);
    $this->setDefault('fecha_vencimiento', $this->datos['fv']);
    $this->setDefault('responsable', $this->datos['rs']);
    
  }
}
