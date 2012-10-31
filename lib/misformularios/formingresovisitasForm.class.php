<?php

/**
 * TraSolicitudes form.
 *
 * @package    principal
 * @subpackage form
 * @author     Your name here
 */
class formingresovisitasForm extends sfForm
{
    
  public function configure()
  {
      
     $this->disableLocalCSRFProtection();
      
     $this->setWidgets(array(        
      'num_carnet'           => new sfWidgetFormInputText(),
      'nombre'               => new sfWidgetFormInputText(),
      'apellido'             => new sfWidgetFormInputText(),
      'contacto'             => new sfWidgetFormInputText(),
      'observaciones'        => new sfWidgetFormTextarea(),
    ));
     


    $this->setValidators(array(
      'num_carnet'         => new sfValidatorString(),
      'nombre'             => new sfValidatorString(),
      'apellido'           => new sfValidatorString(),
      'contacto'           => new sfValidatorString(),
      'observaciones'      => new sfValidatorString(),       
    ));


    $this->widgetSchema->setNameFormat('datos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

      
  }
}

class formingresovisitas2Form extends sfForm
{
    
  public function configure()
  {
      
     $this->disableLocalCSRFProtection();
      
     $this->setWidgets(array(        
      'num_carnet'           => new sfWidgetFormInputText(),
      'contacto'             => new sfWidgetFormInputText(),
      'observaciones'        => new sfWidgetFormTextarea(),
    ));
     


    $this->setValidators(array(
      'num_carnet'         => new sfValidatorString(),
      'contacto'           => new sfValidatorString(),
      'observaciones'      => new sfValidatorString(),       
    ));


    $this->widgetSchema->setNameFormat('datos2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

      
  }
}
