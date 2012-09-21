<?php

/**
 * SitTickets filter form.
 *
 * @package    Telesur
 * @subpackage filter
 * @author     Your name here
 */
class SitTicketsFormFilter extends BaseSitTicketsFormFilter
{    
  protected static $status= array(''=>'','n'=>'Nuevo','a'=>'Asignado','c'=>'Cerrado');
  protected $datos = null;
  protected $idunidad = null;
	
  public function setDatos($c,$f)
  {
  		$this->idunidad = $c;
	  	$this->datos = $f;
	   	$this->configure();
  }
  
  public function configure()
  {  	

 	$a=new Criteria();
  	$a->add(SitCategoriasUnidadesPeer::ID_UNIDAD,$this->idunidad);
  	$a->addJoin(SitCategoriasPeer::ID_CATEGORIA, SitCategoriasUnidadesPeer::ID_CATEGORIA);
  	
    $this->setWidgets(array(  	
  	
      'fecha_desde' => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      'fecha_hasta' => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
      'id_categoria' => new sfWidgetFormPropelChoice(array('model' => 'sitCategorias','key_method' => 'getIdCategoria','method'=>'getDescripcion','add_empty' => true,'criteria'=>$a)),
      'id_solicitante'               => new sfWidgetFormPropelChoice(array('model' => 'SfGuardUserProfile', 'add_empty' => true)),
      'estatus'     => new sfWidgetFormSelect(array('choices' => self::$status,)),
  	
    ));

    if($this->datos!=''){
   		$this->setDefault('fecha_desde', $this->datos['fecha_desde']);
   		$this->setDefault('fecha_hasta', $this->datos['fecha_hasta']);
   		$this->setDefault('id_categoria', $this->datos['id_categoria']);
   		$this->setDefault('id_solicitante', $this->datos['id_solicitante']);
   		$this->setDefault('estatus', $this->datos['estatus']);
    }
    
    $this->widgetSchema->setNameFormat('filtro[%s]');
    $this->widgetSchema->setLabel('id_categoria', 'Categorias');
    $this->widgetSchema->setLabel('id_solicitante', 'Solicitantes');
    
  }
}
