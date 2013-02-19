<?php

/**
 * BitBitacora form.
 *
 * @package    Telesur
 * @subpackage form
 * @author     Your name here
 */
class BitBitacoraForm extends BaseBitBitacoraForm
{
  protected $datos = null;
  protected $unidad = null;

  public function setDatos($c)
  {
      $this->datos = $c;
      $this->configure();
  }
  
    public function setUnidad($idu)
  {
      $this->unidad= $idu;
      $this->configure();
  }
  
  public function configure()
  {
    if($this->datos['id_categoria']==''){
        $id_categoria=0;
    } else{
        $id_categoria=$this->datos['id_categoria'];
    }

    $a=new Criteria();
    $a->add(BitCategoriasPeer::ID_CATEGORIA,$id_categoria);
    $a->addJoin(BitSubcategoriasPeer::ID_CATEGORIA, BitCategoriasPeer::ID_CATEGORIA);
          
    $b=new Criteria();
    $b->add(BitCategoriasUnidadesPeer::ID_UNIDAD,$this->unidad);
    $b->addJoin(BitCategoriasUnidadesPeer::ID_CATEGORIA, BitCategoriasPeer::ID_CATEGORIA);
    
    $this->disableLocalCSRFProtection();

    $this->setWidgets(array(
        'id_categoria'       => new sfWidgetFormPropelChoice(array('model' => 'BitCategorias', 'add_empty' => true, 'criteria'=>$b),array('onchange'=>'enviar_formulario_sa(\'Buscar Subcategorias\')')),
        'id_subcategoria'       => new sfWidgetFormPropelChoice(array('model' => 'BitSubcategorias', 'add_empty' => true, 'criteria'=>$a)),
        'fecha'   => new sfWidgetFormInputText(array(),array('class'=>'tcal')),
        'hora'   => new sfWidgetFormTime(array(),array('style'=>'width:50px;')),
        'observaciones'   => new sfWidgetFormTextarea(array(),array('id'=>'sol')),  
    ));

    $this->setValidators(array(
        'id_categoria'     => new sfValidatorString(),
        'id_subcategoria'     => new sfValidatorString(),
        'fecha'   => new sfValidatorDate(),
        'hora'   => new sfValidatorTime(),
        'observaciones'   => new sfValidatorString(array('max_length' => 500)),

    ));

    $this->widgetSchema->setNameFormat('datos_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setDefault('id_categoria', $this->datos['id_categoria']);
    $this->setDefault('id_subcategoria', $this->datos['id_subcategoria']);
    $this->setDefault('fecha', $this->datos['fecha']);
    $this->setDefault('hora', $this->datos['hora']);
    $this->setDefault('observaciones', $this->datos['observaciones']);
    
    $this->widgetSchema->setLabels(array(
        'id_categoria'       => 'Categoria: ',
        'id_subcategoria'       => 'Subcategoria: ',
        'fecha'       => 'Fecha: ',
        'hora'       => 'Hora: ',
        'observaciones'       => 'Observaciones: ',
    ));
      
  }
}
