<?php

/**
 * gestion actions.
 *
 * @package    Telesur
 * @subpackage gestion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gestionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeTransportetr(sfWebRequest $request)
  {      
      $f=new funciones;
      $this->filtro=new TraSolicitudesFormFilter;
      
      $a = new Criteria();
      
      if ($request->isMethod('post'))
      {  
            $filtro = $request->getParameter('tra_solicitudes_filters');
            
            $this->filtro->setDatos($filtro);

            if($filtro['fecha_salida']!='')
            $a->add(TraSolicitudesPeer::FECHA_SALIDA,$f->voltea_fecha($filtro['fecha_salida']));
            
            if($filtro['hora_salida']['hour']!='' && $filtro['hora_salida']['minute']!='')
            $a->add(TraSolicitudesPeer::HORA_SALIDA,$filtro['hora_salida']['hour'].':'.$filtro['hora_salida']['minute']);
            
            if($filtro['estatus']!='')
            $a->add(TraSolicitudesPeer::ESTATUS,$filtro['estatus']);
      }
      
      $a->addDescendingOrderByColumn('id_solicitud');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $a->add(TraSolicitudesPeer::TIPO_TRANSPORTE,'c');
 
      $p=new Paginacion();
      $p->paginar("TraSolicitudesPeer","ID_SOLICITUD",$a);
      $this->pagina=$p->getPagina();
      $this->cantidad_paginas=$p->getCantidadPaginas();
      $this->solicitudes=$p->getLista();	
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'n');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_nuevas=TraSolicitudesPeer::doCount($a);
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'a');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_asignadas=TraSolicitudesPeer::doCount($a);
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'ap');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_aprobadas=TraSolicitudesPeer::doCount($a);
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'c');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_cerradas=TraSolicitudesPeer::doCount($a);
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'cj');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_justificadas=TraSolicitudesPeer::doCount($a);
      
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ESTATUS,'r');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $this->cantidad_rechazadas=TraSolicitudesPeer::doCount($a);
  
  }
  
  public function executeTransporteco(sfWebRequest $request)
  {
      
      $a = new Criteria();
      $a->addDescendingOrderByColumn('id_solicitud');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'t');
      $a->add(TraSolicitudesPeer::TIPO_TRANSPORTE,'m');
 
      $p=new Paginacion();
      $p->paginar("TraSolicitudesPeer","ID_SOLICITUD",$a);
      $this->pagina=$p->getPagina();
      $this->cantidad_paginas=$p->getCantidadPaginas();
      $this->solicitudes=$p->getLista();	
  
  }
  
  public function executeCorrespondencia(sfWebRequest $request)
  {
      
      $a = new Criteria();
      $a->addDescendingOrderByColumn('id_solicitud');
      $a->add(TraSolicitudesPeer::TIPO_SOLICITUD,'c');
 
      $p=new Paginacion();
      $p->paginar("TraSolicitudesPeer","ID_SOLICITUD",$a);
      $this->pagina=$p->getPagina();
      $this->cantidad_paginas=$p->getCantidadPaginas();
      $this->solicitudes=$p->getLista();	
  
  }
  
  public function executeAsignartransportetr(sfWebRequest $request)
  {
      $this->opcion='';     
      
      
      //obtengo el id de la solicitud    
      $this->ids=$this->getRequestParameter('ids');
      //////////////////////////////////////////////////////////////////////////
      
      $this->form=new SelectAsignarTransportetrForm;
      
      //hago un select de todas las solicitudes
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ID_SOLICITUD,$this->ids);
      $a->addJoin(SfGuardUserProfilePeer::USER_ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $a->addJoin(SfGuardUserPeer::ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $solicitud=TraSolicitudesPeer::doSelect($a);
      $profile=SfGuardUserProfilePeer::doSelect($a);
      $user=SfGuardUserPeer::doSelect($a);
      $this->solicitud=$solicitud[0];
      $this->profile=$profile[0];
      $this->user=$user[0];
      //////////////////////////////////////////////////////////////////////////

      //busco todos los conductores
      $a=new Criteria();          
      $a->add(SfGuardUserProfilePeer::ID_CARGO,array('145','312','363','339','310','678','983','644'),  Criteria::IN);
      $a->addAscendingOrderByColumn("nombre1");
      $this->conductores=SfGuardUserProfilePeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      //busco todos los transportes carros
      $a=new Criteria();          
      $a->add(TraVehiculosPeer::CARRO,true);
      $this->transportes=TraVehiculosPeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      if ($request->isMethod('post'))
      {  
            $accion = $request->getParameter('accion');
            $this->opcion = $request->getParameter('opcion');
            $this->form->setDatos($this->opcion);
            
            if($accion=='Asignar conductor y transporte'){
                
                $idconductor= $request->getParameter('conductor');                
                $idvehiculo= $request->getParameter('vehiculo');  
                if($idconductor=='' || $idvehiculo==''){$this->getUser()->setFlash('sms',sprintf("Debe asignar un conductor y un transporte"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::asignar_conductor_transporte($this->ids,$idconductor,$idvehiculo);
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteAsignar($this->solicitud,$correo);
                        ////////////////  
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransportetr?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
            
                
            }
            
            else if($accion=='Aprobar solicitud'){

                $sms = TraSolicitudesPeer::aprobar_solicitud($this->ids);
                
                if($sms!=false){
                    
                    //ENVÍO CORREO//
                    $correo=$this->user->getUsername().'@telesurtv.net';
                    $cuerpo=new CorreoCuerpo();
                    $cuerpo->TransporteAprobar($this->solicitud,$correo);
                    //////////////// 
                        
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("gestion/asignartransportetr?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
        
            }
            
            else if($accion=='Rechazar solicitud'){

                $justificacion = $request->getParameter('justificacion');                
                if($justificacion==''){$this->getUser()->setFlash('sms',sprintf("Debe escribir una justificacion"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::rechazar_solicitud($this->ids,$justificacion);
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteRechazo($this->solicitud,$correo,$justificacion);
                        //////////////// 
                    
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransportetr?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}

                }                
            }
            
            else if($accion=='Cerrar solicitud'){
                
                $sms = TraSolicitudesPeer::cerrar_solicitud($this->ids);
                
                if($sms!=false){
                    
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteCerrado($this->solicitud,$correo);
                        ////////////////
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransportetr?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error o no se ha asignado un conductor y un vehículo"));return;}
            }   
            
            else if($accion=='Cierre justificado'){

                $justificacion = $request->getParameter('justificacion');                
                if($justificacion==''){$this->getUser()->setFlash('sms',sprintf("Debe escribir una justificacion"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::cierre_justificado($this->ids,$justificacion);
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteCierreJustificado($this->solicitud,$correo,$justificacion);
                        //////////////// 
                    
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransportetr?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}

                }                
            }
      }
  }
  
  public function executeAsignartransporteco(sfWebRequest $request)
  {      
      $this->opcion='';
      
      //obtengo el id de la solicitud    
      $this->ids=$this->getRequestParameter('ids');
      //////////////////////////////////////////////////////////////////////////
      
      $this->form=new SelectAsignarTransportetrForm;
      
       //hago un select de todas las solicitudes
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ID_SOLICITUD,$this->ids);
      $a->addJoin(SfGuardUserProfilePeer::USER_ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $a->addJoin(SfGuardUserPeer::ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $solicitud=TraSolicitudesPeer::doSelect($a);
      $profile=SfGuardUserProfilePeer::doSelect($a);
      $user=SfGuardUserPeer::doSelect($a);
      $this->solicitud=$solicitud[0];
      $this->profile=$profile[0];
      $this->user=$user[0];
      //////////////////////////////////////////////////////////////////////////

      //busco todos los conductores
      $a=new Criteria();          
      $a->add(SfGuardUserProfilePeer::ID_CARGO,array('679','642','671'),  Criteria::IN);
      $this->conductores=SfGuardUserProfilePeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      //busco todos los transportes carros
      $a=new Criteria();          
      $a->add(TraVehiculosPeer::CARRO,false);
      $this->transportes=TraVehiculosPeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      if ($request->isMethod('post'))
      {  
            $accion = $request->getParameter('accion');
            $this->opcion = $request->getParameter('opcion');
            $this->form->setDatos($this->opcion);
            
            if($accion=='Asignar conductor y transporte'){
                
                $idconductor= $request->getParameter('conductor');                
                $idvehiculo= $request->getParameter('vehiculo');  
                if($idconductor=='' || $idvehiculo==''){$this->getUser()->setFlash('sms',sprintf("Debe asignar un conductor y un transporte"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::asignar_conductor_transporte($this->ids,$idconductor,$idvehiculo);
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteAsignar($this->solicitud,$correo);
                        ////////////////  
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransporteco?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
            }
            
            else if($accion=='Aprobar solicitud'){

                $sms = TraSolicitudesPeer::aprobar_solicitud($this->ids);
                
                if($sms!=false){
                    
                    //ENVÍO CORREO//
                    $correo=$this->user->getUsername().'@telesurtv.net';
                    $cuerpo=new CorreoCuerpo();
                    $cuerpo->TransporteAprobar($this->solicitud,$correo);
                    //////////////// 
                    
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("gestion/asignartransporteco?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
        
            }
            
            else if($accion=='Rechazar solicitud'){

                $justificacion = $request->getParameter('justificacion');                
                if($justificacion==''){$this->getUser()->setFlash('sms',sprintf("Debe escribir una justificacion"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::rechazar_solicitud($this->ids,$justificacion);
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteRechazo($this->solicitud,$correo,$justificacion);
                        //////////////// 
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransporteco?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}

                }                
            }
            
            else if($accion=='Cerrar solicitud'){
                
                $sms = TraSolicitudesPeer::cerrar_solicitud($this->ids);
                
                if($sms!=false){
                    
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->TransporteCerrado($this->solicitud,$correo);
                        ////////////////
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignartransporteco?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error o no se ha asignado un conductor y un vehículo"));return;}
            }            
      }
  }
  
  public function executeAsignarcorrespondencia(sfWebRequest $request)
  {
      
      $this->opcion='';
      
      //obtengo el id de la solicitud    
      $this->ids=$this->getRequestParameter('ids');
      //////////////////////////////////////////////////////////////////////////
      
      $this->form=new SelectAsignarTransportetrForm;
      
       //hago un select de todas las solicitudes
      $a = new Criteria();
      $a->add(TraSolicitudesPeer::ID_SOLICITUD,$this->ids);
      $a->addJoin(SfGuardUserProfilePeer::USER_ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $a->addJoin(SfGuardUserPeer::ID, TraSolicitudesPeer::ID_SOLICITANTE);
      $solicitud=TraSolicitudesPeer::doSelect($a);
      $profile=SfGuardUserProfilePeer::doSelect($a);
      $user=SfGuardUserPeer::doSelect($a);
      $this->solicitud=$solicitud[0];
      $this->profile=$profile[0];
      $this->user=$user[0];
      //////////////////////////////////////////////////////////////////////////

      //busco todos los conductores
      $a=new Criteria();          
      $a->add(SfGuardUserProfilePeer::ID_CARGO,'257');
      $a->addOr(SfGuardUserProfilePeer::ID_CARGO,'256');
      $this->conductores=SfGuardUserProfilePeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      //busco todos los transportes carros
      $a=new Criteria();          
      $a->add(TraVehiculosPeer::CARRO,false);
      $this->transportes=TraVehiculosPeer::doSelect($a);
      //////////////////////////////////////////////////////////////////////////
      
      if ($request->isMethod('post'))
      {  
            $accion = $request->getParameter('accion');
            $this->opcion = $request->getParameter('opcion');
            $this->form->setDatos($this->opcion);
            
            if($accion=='Asignar conductor y transporte'){
                
                $idconductor= $request->getParameter('conductor');                
                $idvehiculo= $request->getParameter('vehiculo');  
               
                if($idconductor=='' || $idvehiculo==''){$this->getUser()->setFlash('sms',sprintf("Debe asignar un conductor y un transporte"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::asignar_conductor_transporte($this->ids,$idconductor,$idvehiculo);
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->CorrespondenciaAsignar($this->solicitud,$correo);
                        ////////////////  
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignarcorrespondencia?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
            }
            
            else if($accion=='Aprobar solicitud'){

                $sms = TraSolicitudesPeer::aprobar_solicitud($this->ids);
                
                if($sms!=false){
                    
                    //ENVÍO CORREO//
                    $correo=$this->user->getUsername().'@telesurtv.net';
                    $cuerpo=new CorreoCuerpo();
                    $cuerpo->CorrespondenciaAprobar($this->solicitud,$correo);
                    //////////////// 
                    
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("gestion/asignarcorrespondencia?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
        
            }
            
            else if($accion=='Rechazar solicitud'){

                $justificacion = $request->getParameter('justificacion');                
                if($justificacion==''){$this->getUser()->setFlash('sms',sprintf("Debe escribir una justificacion"));return;}
                
                else{
                    
                    $sms = TraSolicitudesPeer::rechazar_solicitud($this->ids,$justificacion);
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->CorrespondenciaRechazo($this->solicitud,$correo,$justificacion);
                        //////////////// 
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignarcorrespondencia?ids=".$this->ids); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}

                }                
            }
            
            else if($accion=='Cerrar solicitud'){
                
                $sms = TraSolicitudesPeer::cerrar_solicitud($this->ids);
                
                if($sms!=false){
                    
                        //ENVÍO CORREO//
                        $correo=$this->user->getUsername().'@telesurtv.net';
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->CorrespondenciaCerrado($this->solicitud,$correo);
                        ////////////////
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("gestion/asignarcorrespondencia?ids=".$this->ids); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
            }            
      }
      
  }   
}
