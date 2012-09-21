<?php
class SitTicketsMixtosForm extends sfForm
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
        'id_solicitante'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true)),
        'idunidad'       => new sfWidgetFormPropelChoice(array('model' => 'SitUnidades', 'add_empty' => true)),
        'solicitud'   => new sfWidgetFormTextarea(),  
    ));

    $this->setValidators(array(
        'id_solicitante'     => new sfValidatorString(),
        'idunidad'     => new sfValidatorString(),
        'solicitud'   => new sfValidatorString(array('max_length' => 500)),
    ));

    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setDefault('idunidad', $this->datos['idunidad']);
    
    $this->setDefault('solicitud', $this->datos['solicitud']);
    
    $this->widgetSchema->setLabels(array(
        'idunidad'       => 'Unidad: ',
    ));
      
  }
}
?>
