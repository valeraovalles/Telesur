<?php

/**
 * solicitud actions.
 *
 * @package    Telesur
 * @subpackage solicitud
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class solicitudActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }
  
  public function executeFormulariotransporte(sfWebRequest $request)
  {  
      $this->lista='';
      
      $fc=new funciones;
      
      $this->form=new TraSolicitudesForm;
      $idu=$this->getUser()->getGuardUser()->getId();
           
      if ($request->isMethod('post'))
      {                  
          $datos = $request->getParameter('tra_solicitudes');    
          $this->lista = $datos['asistentes']; 

          $this->form->bind($datos);
          
          //VALIDO QUE LA FECHA NO SEA MENOR A LA ACTUAL
          if($datos['fecha_salida']!=''){
          $sms=$fc->comparar_fechas_mayor_menor(date("d-m-Y"), $datos['fecha_salida']);
          if($sms!=false){$this->getUser()->setFlash('sms',sprintf($sms));return;}}
          //////////////////////////////////////////////////////////////////////          
          
          //VALIDO QUE LA FECHA DE SOLICITUD NO SEA MAYOR A 48 HORAS
          if($datos['fecha_salida']!=''){
            $dias=$fc->dias_fechas(explode("-",$datos['fecha_salida']));
            if($dias>3){$this->getUser()->setFlash('sms',sprintf("La fecha de búsqueda no puede superar las 48 horas"));return;}
            /*else if ($dias==0){
                
                if($datos['hora_salida']['hour']-(date("G")) < 3){$this->getUser()->setFlash('sms',sprintf("Debe realizar la solicitud con un mínimo de tres hora de antelación"));return;}
                
            }*/
          
          }
          //////////////////////////////////////////////////////////////////////  
          
          if ($this->form->isValid())
          {
                $this->form->setDatos($datos);

                $sms = TraSolicitudesPeer::guarda_solicitud($datos,$idu);
                
                if($sms!=false){
                    
                    //ENVÍO CORREO//
                    $solicitante = $this->getUser()->getGuardUser()->getProfile()->getNombre1().' '.$this->getUser()->getGuardUser()->getProfile()->getApellido1();
                    $cuerpo=new CorreoCuerpo();
                    $cuerpo->TransporteSolicitud($solicitante,$datos);
                    ////////////////    
                    
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("solicitud/estatus");     
                }              
          } else  $this->getUser()->setFlash('sms',sprintf("Debe verificar el formulario"));        
      }
  }
  
  public function executeEstatus(sfWebRequest $request)
  { 
      $idu=$this->getUser()->getGuardUser()->getId();
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ID_SOLICITANTE,$idu);
      $a->addDescendingOrderByColumn('id_solicitud');
      
      $p=new Paginacion();
      $p->paginar("TraSolicitudesPeer","ID_SOLICITUD",$a);
      $this->pagina=$p->getPagina();
      $this->cantidad_paginas=$p->getCantidadPaginas();
      $this->solicitudes=$p->getLista();	
    
  }
  
  public function executeDetalle(sfWebRequest $request)
  { 
      
      $this->ids=$this->getRequestParameter('ids');
        
      $this->solicitud=TraSolicitudesPeer::retrieveByPK($this->ids);
      
  }
  
  public function executeFormulariocorrespondencia(sfWebRequest $request)
  {
      $fc= new funciones;
      $this->form=new Formulariocorrespondencia;
      $idu=$this->getUser()->getGuardUser()->getId();
           
      if ($request->isMethod('post'))
      {                  
          $datos = $request->getParameter('tra_correspondencia');    

          $this->form->bind($datos);
          
          //VALIDO QUE LA FECHA NO SEA MENOR A LA ACTUAL
          /*if($datos['fecha_salida']!=''){
          $sms=$fc->comparar_fechas_mayor_menor(date("d-m-Y"), $datos['fecha_salida']);
          if($sms!=false){$this->getUser()->setFlash('sms',sprintf($sms));return;}}*/
          //////////////////////////////////////////////////////////////////////  

          if ($this->form->isValid())
          {
                $this->form->setDatos($datos);

                $sms = TraSolicitudesPeer::guarda_correspondencia($datos,$idu);
                
                if($sms!=false){
                    //ENVÍO CORREO//
                    $solicitante = $this->getUser()->getGuardUser()->getProfile()->getNombre1().' '.$this->getUser()->getGuardUser()->getProfile()->getApellido1();
                    $cuerpo=new CorreoCuerpo();
                    $cuerpo->CorrespondenciaSolicitud($solicitante,$datos);
                    ////////////////    
                        
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("solicitud/estatus");     
                }

              
          }
                   
             
      }
      
      
  }
}
