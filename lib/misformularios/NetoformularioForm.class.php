<?php
class NetoformularioForm extends sfForm
{

  protected $datos = null;
  protected static $proceso= array(''=>'','n'=>'Nomina','a'=>'Aguinaldos');
  protected static $periodo= array(''=>'','1'=>'1era Quincena','2'=>'2da Quincena');
  protected static $mes= array(''=>'','1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Nobiembre','12'=>'Diciembre');
  protected static $ano= array(''=>'','2010'=>'2010','2011'=>'2011','2012'=>'2012','2013'=>'2013');
	
  public function setDatos($c)
  {
	  	$this->datos = $c;
	   	$this->configure();
  }
  
  public function configure()
  {
      
    $this->setWidgets(array(
        'proceso'     => new sfWidgetFormSelect(array('choices' => self::$proceso)),
        'periodo'     => new sfWidgetFormSelect(array('choices' => self::$periodo)),
        'mes'         => new sfWidgetFormSelect(array('choices' => self::$mes)),
        'ano'         => new sfWidgetFormSelect(array('choices' => self::$ano)),
        '_csrf_token'         => new sfWidgetFormInputHidden(),
        
        
    ));

    $this->setValidators(array(
        'proceso'     => new sfValidatorString(),
        'periodo'     => new sfValidatorString(),
        'mes'         => new sfValidatorString(),
        'ano'         => new sfValidatorString(),
        '_csrf_token'         => new sfValidatorString(array('required'=>false)),
    ));


    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   
    $this->setDefault('proceso', $this->datos['proceso']);
    $this->setDefault('periodo', $this->datos['periodo']);
    $this->setDefault('mes', $this->datos['mes']);
    $this->setDefault('ano', $this->datos['ano']);
    
    $this->widgetSchema->setLabels(array(
        'proceso'       => '<span style="color:red;">*</span>Proceso:',
        'periodo'       => '<span style="color:red;">*</span>Periodo:',
        'mes'       => '<span style="color:red;">*</span>Mes:',
        'ano'       => '<span style="color:red;">*</span>Año:',
    ));
      
  }
}
?>
