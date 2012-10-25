<?php
class ReporteinformegestionForm extends sfForm
{
	
  protected $datos = null;
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
      
        $a=new Criteria();
	$a->add(SitUsuariosUnidadesPeer::ID_UNIDAD,$this->datos['id_unidad']);
        $a->addJoin(SfGuardUserProfilePeer::USER_ID, SitUsuariosUnidadesPeer::ID_USUARIO);
       
       $this->setWidgets(array(
            'id_unidad' => new sfWidgetFormPropelChoice(array('model' => 'sitUnidades','key_method' => 'getIdUnidad','method'=>'getDescripcion','add_empty' => true),array('onchange'=>'enviar_formulario_sa(\'unidad\')')),		
            'id_usuario' => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile','add_empty' => true,'criteria'=>$a)),
  	    'desde' => new sfWidgetFormInputText(array(),array('readonly'=>'readonly','class'=>'tcal')),
  	    'hasta' => new sfWidgetFormInputText(array(),array('readonly'=>'readonly','class'=>'tcal')),
  	));
       
        $this->setValidators(array(
        'id_unidad' => new sfValidatorString(array('max_length' => 500)),
        'id_usuario' => new sfValidatorString(array('max_length' => 500,'required' => false)),            
        'desde'         => new sfValidatorDate(array('required' => false)),
        'hasta'         => new sfValidatorDate(array('required' => false)),

        ));

        $this->widgetSchema->setNameFormat('reporteig[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);      
        
	/*$this->widgetSchema->setLabels(array(
           'id_departamento'       => 'Departamento',
	   'id_categoria'       => 'Categorias',
	));*/
  	  
  	  
  	$this->setDefault('id_unidad', $this->datos['id_unidad']);
  	$this->setDefault('id_usuario', $this->datos['id_usuario']);
        $this->setDefault('desde', $this->datos['desde']);
        $this->setDefault('hasta', $this->datos['hasta']);
  	

  }
	
}