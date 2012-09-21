<?php

/**
 * tickets_asignados actions.
 *
 * @package    Telesur
 * @subpackage tickets_asignados
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tickets_asignadosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->nombre_user=$this->getUser()->getProfile()->getNombre1().' '.$this->getUser()->getProfile()->getApellido1();
  	
  	$idu=$this->getUser()->getGuardUser()->getId();
  	
	
	$a=new Criteria();
	$a->addDescendingOrderByColumn("fecha_solicitud");
        $a->addDescendingOrderByColumn("hora_solicitud");
        $a->add(SitTicketsUsuariosPeer::ID_USUARIO,$idu);
        $a->add(SitTicketsPeer::ESTATUS,'a');      
	$a->addjoin(SitTicketsPeer::ID_TICKET,SitTicketsUsuariosPeer::ID_TICKET);	
	$a->addJoin(SitCategoriasPeer::ID_CATEGORIA, SitTicketsPeer::ID_CATEGORIA);
	$a->addJoin(SfGuardUserProfilePeer::USER_ID, SitTicketsPeer::ID_SOLICITANTE);
        
	$this->tickets=SitTicketsPeer::doSelect($a);
	$this->categorias=SitCategoriasPeer::doSelect($a);
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);
  }
  
  public function executeGestionarticket(sfWebRequest $request)
  {
  	$idu=$this->getUser()->getGuardUser()->getId();
        $this->nombre_user=$this->getUser()->getProfile()->getNombre1().' '.$this->getUser()->getProfile()->getApellido1();
  	
  	//recibo el id del ticket
  	$this->idtk = $this->getRequestParameter('id');   	

        $this->SitTicket=SitTicketsPeer::retrieveByPK($this->idtk);        
        $this->solicitante=  SfGuardUserProfilePeer::retrieveByPK($this->SitTicket->getIdSolicitante());
       
        
        if ($request->isMethod('post'))
	{  
            $accion=$request->getParameter("accion");
            
            if($accion=='Cerrar ticket'){
                
                $solucion=$request->getParameter("solucion");
                if($solucion==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una solución"));return;}
		else{
                               
                    $sms=SitTicketsPeer::cerrar_ticket($this->idtk,$solucion);
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $solicitante_user= SfGuardUserPeer::retrieveByPK($this->SitTicket->getIdSolicitante());
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->SitCerrado($solicitante_user,$this->SitTicket,$solucion,$solicitante_user->getUsername().'@telesurtv.net');
                        ////////////////           
                   
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets_asignados/index?id=".$this->idtk); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
     
		}
            }
		
            else if($accion=='Enviar comentario'){
                
                $comentario=$request->getParameter("comentario");
		if($comentario==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir un comentario"));return;}
		else{
                    $sms=SitTicketsPeer::guarda_comentario($this->idtk,$comentario,$idu);
                    if($sms!=false){
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("tickets_asignados/gestionarticket?id=".$this->idtk); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
		}
            }
	
	}
	
  	

      
  }
}
