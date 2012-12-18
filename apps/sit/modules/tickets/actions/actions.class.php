<?php

/**
 * tickets actions.
 *
 * @package    Telesur
 * @subpackage tickets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function idunidadusuario(){

    $idu = $this->getUser()->getGuardUser()->getId();
    
    $f = new funciones;
    return $id_unidad_usuario = $f->SitIdUnidad($idu);
    
  }
  
  public function unidadusuario(){
      
     $this->unidad = SitUnidadesPeer::retrieveByPK($this->idunidadusuario());
     return $this->unidad->getDescripcion();
  }
  
  public function executeIndex(sfWebRequest $request)
  {      
        $filtro='';
      
        $idu=$this->getUser()->getGuardUser()->getId();
        
        $f=new funciones;
        $this->idunidadusuario = $this->idunidadusuario();
        $this->unidadusuario = $this->unidadusuario();  	

  	$this->form_filter=new SitTicketsFormFilter();	
 
        //CUENTO LOS TICKETS NUEVOS CERRADOS Y ASIGNADOS////////////////////////
        $d1=date("Y")."-01-01";
        $d2=date("Y")."-12-31";
         
        $a = new Criteria();
        $a->add(SitTicketsPeer::ID_UNIDAD,$this->idunidadusuario);
        $a->add(SitTicketsPeer::ESTATUS,'n');
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d1,  Criteria::GREATER_EQUAL);
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d2,  Criteria::LESS_EQUAL);
        $this->cantidadnuevos=SitTicketsPeer::doCount($a);
        
        $a = new Criteria();
        $a->add(SitTicketsPeer::ID_UNIDAD,$this->idunidadusuario);
        $a->add(SitTicketsPeer::ESTATUS,'a');
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d1,  Criteria::GREATER_EQUAL);
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d2,  Criteria::LESS_EQUAL);
        $this->cantidadasignados=SitTicketsPeer::doCount($a);
        
        $a = new Criteria();
        $a->add(SitTicketsPeer::ID_UNIDAD,$this->idunidadusuario);
        $a->add(SitTicketsPeer::ESTATUS,'c');
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d1,  Criteria::GREATER_EQUAL);
        $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$d2,  Criteria::LESS_EQUAL);
        $this->cantidadcerrados=SitTicketsPeer::doCount($a);
        ////////////////////////////////////////////////////////////////////////

        $a=new Criteria();
	$a->add(SitTicketsPeer::ID_UNIDAD,$this->idunidadusuario);
	$a->addJoin(SfGuardUserProfilePeer::USER_ID, SitTicketsPeer::ID_SOLICITANTE);	
        $a->addDescendingOrderByColumn("id_ticket");
        $a->addDescendingOrderByColumn("fecha_solicitud");
        
	if ($request->isMethod('post'))
	{
		$filtro=$request->getParameter("filtro");
               
	
		if($filtro['fecha_desde']!='')
			$a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$f->voltea_fecha($filtro['fecha_desde']),Criteria::GREATER_EQUAL);

		if($filtro['fecha_hasta']!='')
			$a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$f->voltea_fecha($filtro['fecha_hasta']),Criteria::LESS_EQUAL);
		
		if($filtro['id_categoria']!='')
			$a->add(SitTicketsPeer::ID_CATEGORIA,$filtro['id_categoria']);

		if($filtro['id_solicitante']!='')
			$a->add(SitTicketsPeer::ID_SOLICITANTE,$filtro['id_solicitante']);

		if($filtro['estatus']!='')
			$a->add(SitTicketsPeer::ESTATUS,$filtro['estatus']);
		
	}		

	$p=new Paginacion();
	$p->paginar("SitTicketsPeer","ID_TICKET",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->tickets=$p->getLista();
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);
        $this->form_filter->setDatos($this->idunidadusuario,$filtro);
	
	
  }
  
  public function executeGestionarticket(sfWebRequest $request)
  {
  	//recibo el id del ticket
  	$this->idtk = $this->getRequestParameter('id'); 
        $idu=$this->getUser()->getGuardUser()->getId();
       
        //verifico que el ticket tenga primero una categoria asignada
        $this->SitTicket=SitTicketsPeer::retrieveByPK($this->idtk);        
        if($this->SitTicket->getIdCategoria()==null) $this->redirect("tickets/ticketsubcategoria?id=".$this->idtk);
        ////////////////////////////////////////////////////////////////////////
        
        $this->solicitante=  SfGuardUserProfilePeer::retrieveByPK($this->SitTicket->getIdSolicitante());
        
  	//busco si el ticket esta asignado
        $a=new Criteria();
        $a->add(SitTicketsUsuariosPeer::ID_TICKET, $this->idtk);
        $a->addJoin(SfGuardUserProfilePeer::USER_ID, SitTicketsUsuariosPeer::ID_USUARIO);
        $this->usuario_ticket=SfGuardUserProfilePeer::doSelect($a);
   	
   	if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
            
            if($accion=='Enviar comentario'){
                
                $comentario=$request->getParameter("comentario");
                if($comentario==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir un comentario"));return;}
		else{
                    
                    $sms=SitTicketsPeer::guarda_comentario($this->idtk,$comentario,$idu);
                    if($sms!=false){
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets/gestionarticket?id=".$this->idtk); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
	                
            }
            
            else if ($accion=='Asignar ticket'){
                
                $asignar=$request->getParameter("asignar");
                if($asignar==''){ $this->getUser()->setFlash('sms',sprintf("Debe elegir un técnico"));return;}
                
                $sms=SitTicketsPeer::asigna_ticket($asignar, $this->idtk);
                
                if($sms!=false){
                        //ENVÍO CORREO//
                        $tecnico= SfGuardUserPeer::retrieveByPK($asignar);
                        $solicitante=  SfGuardUserProfilePeer::retrieveByPK($this->SitTicket->getIdSolicitante());                        
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->SitAsignado($solicitante,$this->SitTicket,$tecnico->getUsername().'@telesurtv.net');
                        ////////////////             
                    
                    
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets/gestionarticket?id=".$this->idtk); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
            }
            
            else if ($accion=='Reasignar ticket'){
                
                $reasignar=$request->getParameter("reasignar");
                if($reasignar==''){ $this->getUser()->setFlash('sms',sprintf("Debe elegir una unidad"));return;}
                
                $sms=SitTicketsPeer::reasigna_ticket($reasignar, $this->idtk,$idu);
                if($sms!=false){
                    
                        //ENVÍO CORREO//
                        $correo=  SitUnidadesPeer::retrieveByPK($reasignar);
                        $solicitante= SfGuardUserProfilePeer::retrieveByPK($this->SitTicket->getIdSolicitante());
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->SitSolicitud($solicitante->getNombre1().' '.$solicitante->getApellido1(),$solicitante->getExtension(),$this->SitTicket->getSolicitud(),$correo->getCorreo());
                        ////////////////
                    
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets/index?id=".$this->idtk); 
                        
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                
                
            }
	
	}
  }
  
  public function executeTicketsubcategoria(sfWebRequest $request)
  {
  	$idu=$this->getUser()->getGuardUser()->getId();
        $this->idtk = $this->getRequestParameter('id');   
  	        
        //datos del ticket
        $this->tickets=  SitTicketsPeer::retrieveByPK($this->idtk);
        
        //identifico el departamento del usuario actual
        $this->idunidadusuario = $this->idunidadusuario();
        $this->unidadusuario = $this->unidadusuario();  
        
        $a=new Criteria();
	$a->add(SitCategoriasUnidadesPeer::ID_UNIDAD,$this->idunidadusuario);
	$a->addjoin(SitCategoriasPeer::ID_CATEGORIA,SitCategoriasUnidadesPeer::ID_CATEGORIA);
	$this->categorias=SitCategoriasPeer::doSelect($a);

        if ($request->isMethod('post'))
	{
        	$radio=$request->getParameter("radio");
                
                if($radio=='') { $this->getUser()->setFlash('sms',sprintf("Debe elegir una subcategoria"));return;}
                
                else{
                    
                       $radio=  explode("-", $radio);
                       $idcat=$radio[1];$idsub=$radio[0];
                      
                       $sms=SitTicketsPeer::tickets_categorias($this->idtk, $idcat, $idsub);
                       if($sms!=false){
                            $this->getUser()->setFlash('sms',sprintf($sms));
                            $this->redirect("tickets/gestionarticket?id=".$this->idtk); 
                       } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }          
        }
  }
  
      
  public function executeGeneral(sfWebRequest $request)
  { 
        $this->setLayout("layout_general");

        if(!$this->getUser()->addCredential("membre")){
        $this->getUser()->setFlash('sms',sprintf("No tienes permisos para acceder a este modulo"));
        $this->redirect("tickets/index"); return;}
        
        $a=new Criteria();
        $a->add(SitTicketsPeer::ESTATUS,'c',Criteria::NOT_EQUAL);
	$a->addJoin(SfGuardUserProfilePeer::USER_ID, SitTicketsPeer::ID_SOLICITANTE);	
        $a->addDescendingOrderByColumn("id_ticket");
        $a->addDescendingOrderByColumn("fecha_solicitud");

	$p=new Paginacion();
	$p->paginar("SitTicketsPeer","ID_TICKET",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->tickets=$p->getLista();
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);
  }
  
  public function executeDetallegeneral(sfWebRequest $request)
  { 
      
      //recibo el id del ticket
  	$this->idtk = $this->getRequestParameter('id'); 
        $idu=$this->getUser()->getGuardUser()->getId();
        $this->SitTicket=SitTicketsPeer::retrieveByPK($this->idtk);
        $this->solicitante=  SfGuardUserProfilePeer::retrieveByPK($this->SitTicket->getIdSolicitante());
        
  	//busco si el ticket esta asignado
        $a=new Criteria();
        $a->add(SitTicketsUsuariosPeer::ID_TICKET, $this->idtk);
        $a->addJoin(SfGuardUserProfilePeer::USER_ID, SitTicketsUsuariosPeer::ID_USUARIO);
        $this->usuario_ticket=SfGuardUserProfilePeer::doSelect($a);

       
  }
  
  public function executeMixtos(sfWebRequest $request)
  { 
      
     $idu=$this->getUser()->getGuardUser()->getId();

      $this->form=new SitTicketsMixtosForm();      

      if ($request->isMethod('post'))
      {                  
          $datos = $request->getParameter('datos_form');  
          $accion=$request->getParameter("accion");
                                        
          $this->form->setDatos($datos);
          
          $this->form->bind($datos);
          
          if ($this->form->isValid())
          {
              
                  if($accion=='Enviar solicitud'){
                    $solicitante= SfGuardUserProfilePeer::retrieveByPK($datos['id_solicitante']);    
                    $datos['extension']=$solicitante->getExtension();
                    $sms=SitTicketsPeer::guarda_ticket($datos,$datos['id_solicitante'],"","");
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=  SitUnidadesPeer::retrieveByPK($datos['idunidad']);                        
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->SitSolicitud($solicitante->getNombre1().' '.$solicitante->getApellido1(),$solicitante->getExtension(),$datos['solicitud'],$correo->getCorreo());
                        ////////////////
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets/mixtos"); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
          } else $this->getUser()->setFlash('sms',sprintf("Debe verificar el formulario."));
      }
        
  }
}
