<?php

/**
 * mapa actions.
 *
 * @package    Telesur
 * @subpackage mapa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mapaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $a=new Criteria();
      $this->equipos_transmision=  MmEquiposTransmisionPeer::doSelect($a);

  }
  
  public function executeMuestramapa(sfWebRequest $request)
  {
      
      $datos=$filtro = $request->getParameter('tp');      
      $datos=  explode("-", $datos);
      
      $tipo_producto=$datos[0];
      $id_producto=$datos[1];
      
      $a=new Criteria();
      $a->add(MmUbicacionesPeer::TIPO_PRODUCTO,$tipo_producto);
      $a->add(MmUbicacionesPeer::ID_PRODUCTO,$id_producto);
      $this->ubicaciones=MmUbicacionesPeer::doSelect($a);

      //busco el producto
      
      if($tipo_producto=='et'){
          
          $this->tipo="EQUIPOS DE TRANSMISIÓN";
          $this->producto=  MmEquiposTransmisionPeer::retrieveByPK($id_producto);
      }
      
  }
  
  public function executeInicio(sfWebRequest $request)
  {

  }
}
