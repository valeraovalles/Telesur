<?php

/**
 * MmUbicaciones form.
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
class MmUbicacionesForm extends BaseMmUbicacionesForm
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
        'id_producto'       => new sfWidgetFormPropelChoice(array('model' => 'MmEquiposTransmision', 'add_empty' => true)),
        'id_pais'   => new sfWidgetFormPropelChoice(array('model' => 'MmPaises', 'add_empty' => true)),
        'cantidad' => new sfWidgetFormInputText(),
        'descripcion'   => new sfWidgetFormTextarea(array(),array()),  
    ));

    $this->setValidators(array(
        'id_producto'     => new sfValidatorString(),
        'cantidad'     => new sfValidatorInteger(),
        'id_pais'   => new sfValidatorString(array('max_length' => 500)),
        'descripcion'   => new sfValidatorString(array('max_length' => 500)),
    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setDefault('id_producto', $this->datos['id_producto']);
    
    $this->setDefault('id_pais', $this->datos['id_pais']);
    
    $this->setDefault('descripcion', $this->datos['descripcion']);
    
    

    
    $this->widgetSchema->setLabels(array(
        'id_producto'       => 'Producto: ',
        'id_pais'       => 'País: ',
    ));
      
  }
}
