<?php
class SelectAsignarTransportetrForm extends sfForm
{

  protected $datos = null;
  protected static $opcion = array(
                                    ''=>'',
                                    'asignar'=>'Asignar transporte y conductor',
                                    'aprobar'=>'Aprobar solicitud',
                                    'cerrar'=>'Cerrar solicitud',
                                    'rechazar'=>'Cancelar Solicitud'/*,
                                    /*'cerrar_justificar'=>'Cierre con justificación'*/);
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
      
    $a=new Criteria();
    $a->add(TraVehiculosPeer::CARRO,true);
    
    $b=new Criteria();
    $b->add(SfGuardUserProfilePeer::ID_CARGO,145);
      
    $this->setWidgets(array(
        'opcion'     => new sfWidgetFormSelect(array('choices' => self::$opcion),array('onchange'=>'document.form.submit()')),
        //'transporte'       => new sfWidgetFormPropelChoice(array('model' => 'TraVehiculos', 'add_empty' => true,'criteria'=>$a)),
        //'conductor'       => new sfWidgetFormPropelChoice(array('model' => 'sfguarduserprofile', 'add_empty' => true,'criteria'=>$b)),
    ));

    $this->setValidators(array(
        'opcion'     => new sfValidatorString(),
    ));


    //$this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setDefault('opcion', $this->datos);

    
    $this->widgetSchema->setLabels(array(
        'opcion'       => 'Seleccione una opción: ',
    ));
      
  }
}
?>
