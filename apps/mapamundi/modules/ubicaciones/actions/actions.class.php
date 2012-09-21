<?php

/**
 * ubicaciones actions.
 *
 * @package    Telesur
 * @subpackage ubicaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ubicacionesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    
  public function executeIndex(sfWebRequest $request)
  {
      
      $a=new Criteria();
      $this->ubicaciones=MmUbicacionesPeer::doSelect($a);
      if ($request->isMethod('post'))
      { 
          $accion = $request->getParameter('accion'); 
          $eliminar = $request->getParameter('eliminar'); 
          
          $a=new Criteria();
          $a->add(MmUbicacionesPeer::ID_UBICACION,$eliminar);
          if(MmUbicacionesPeer::doDelete($a)){
              
            $this->getUser()->setFlash('sms',sprintf("Eliminado con exito."));
            $this->redirect("ubicaciones/index"); 
                
                  
          }
              
      }
      
          
  }
  
  public function executeEditar(sfWebRequest $request)
  {
      $this->id=$request->getParameter("id");
      $ubicaciones=  MmUbicacionesPeer::retrieveByPK($this->id);
      $this->form=  new MmUbicacionesForm($ubicaciones);
      
      if ($request->isMethod('post'))
      { 
          $datos = $request->getParameter('datos_form');    
          $this->form->setDatos($datos);
          $this->form->bind($datos);

          if ($this->form->isValid())
          {
              $a = new Criteria();
              $a->add(MmUbicacionesPeer::ID_UBICACION,$this->id);
              $a->add(MmUbicacionesPeer::ID_PAIS,$datos['id_pais']);
              $a->add(MmUbicacionesPeer::ID_PRODUCTO,$datos['id_producto']);
              $a->add(MmUbicacionesPeer::CANTIDAD,$datos['cantidad']);
              $a->add(MmUbicacionesPeer::DESCRIPCION,$datos['descripcion']);
              if(MmUbicacionesPeer::doUpdate($a)){
                  
                  $this->getUser()->setFlash('sms',sprintf("Actualización exitosa."));
                  $this->redirect("ubicaciones/editar?id=".$this->id); 
                  
              }
          } 
      }
  }
  
  public function executeUbicacion(sfWebRequest $request)
  {

      $this->form=new MmUbicacionesForm;
      
       if ($request->isMethod('post'))
      {                  
          $datos = $request->getParameter('datos_form');    
          $this->form->setDatos($datos);
          $this->form->bind($datos);

          
            if ($this->form->isValid())
          {
              
              $sms=MmUbicacionesPeer::guarda_ubicacion($datos);
              
              $this->getUser()->setFlash('sms',sprintf($sms));
              $this->redirect("ubicaciones/index"); 
          }
      }
  }
}
