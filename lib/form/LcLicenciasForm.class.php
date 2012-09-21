<?php

/**
 * LcLicencias form.
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
class LcLicenciasForm extends BaseLcLicenciasForm
{
    
  protected $datos = null;
  protected static $tipos= array('s'=>'Servicio','l'=>'Licencia');
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
     $this->disableLocalCSRFProtection();
      
     if(!empty($this->datos)){ 
      
        $this->setWidgets(array(
        'id_licencia'       => new sfWidgetFormInputHidden(),
        'tipo'     => new sfWidgetFormSelect(array('choices' => self::$tipos)),      
        'nombre_licencia'   => new sfWidgetFormInputText(),
        'numero'            => new sfWidgetFormInputText(),
        'fecha_compra'      => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal","style"=>"width:180px;")),
        'fecha_vencimiento' => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal","style"=>"width:180px;")),
        'descripcion'       => new sfWidgetFormTextarea(),
        'id_responsable'    => new sfWidgetFormInputHidden(array(),array("value"=>$this->datos)),
        //'bandera_correo'    => new sfWidgetFormInputText(),

        ));
     } else{
         
         $this->setWidgets(array(
        'id_licencia'       => new sfWidgetFormInputHidden(),
        'tipo'     => new sfWidgetFormSelect(array('choices' => self::$tipos)),      
        'nombre_licencia'   => new sfWidgetFormInputText(),
        'numero'            => new sfWidgetFormInputText(),
        'fecha_compra'      => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal","style"=>"width:180px;")),
        'fecha_vencimiento' => new sfWidgetFormInputText(array(),array("readonly"=>"readonly","class"=>"tcal","style"=>"width:180px;")),
        'descripcion'       => new sfWidgetFormTextarea(),
        'id_responsable'    => new sfWidgetFormInputHidden(),
        //'bandera_correo'    => new sfWidgetFormInputText(),  
        ));
         
     }

    $this->setValidators(array(
      'id_licencia'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getIdLicencia()), 'empty_value' => $this->getObject()->getIdLicencia(), 'required' => false)),
      'tipo'              => new sfValidatorString(array('max_length' => 1)),
      'id_responsable'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'nombre_licencia'   => new sfValidatorString(array('max_length' => 500)),
      'numero'            => new sfValidatorString(array('max_length' => 20)),
      'fecha_compra'      => new sfValidatorDate(),
      'fecha_vencimiento' => new sfValidatorDate(),
      'descripcion'       => new sfValidatorString(array('max_length' => 100)),
      //'bandera_correo'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      
    ));
    

    $this->widgetSchema->setNameFormat('lc_licencias[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
  }
}
