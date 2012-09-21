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
      
        $idu=$this->getUser()->getGuardUser()->getId();
      
        //CONSULTO EL DEPARTAMENTO DEL USUARIO ACTUAL
        $a=new funciones;
        $this->Unidad=$a->SitIdUnidad($idu);

  }
  
  public function executeSolicitud(sfWebRequest $request)
  {
      $idu=$this->getUser()->getGuardUser()->getId();

      $this->form=new SitsolicitudsolicitudForm();      
      $this->form->setExt($this->getUser()->getGuardUser()->getProfile()->getExtension());

      if ($request->isMethod('post'))
      {                  
          $datos = $request->getParameter('datos_form');    
          $accion = $request->getParameter('accion'); 
                                        
          $this->form->setDatos($datos);
          
          $this->form->bind($datos,$request->getFiles('datos_form'));
          
          if ($this->form->isValid())
          {
              
                $archivo1 = $this->form->getValue('archivo1');
                $archivo2 = $this->form->getValue('archivo2');  
                
                
                
                if(!empty($archivo1)){
                    $ext1 = strtolower($archivo1->getExtension($archivo1->getOriginalExtension()));
   
                    if($ext1!='.jpg' && $ext1!='.jpeg' && $ext1!='.doc' && $ext1!='.odp' && $ext1!='.gif' && $ext1!='.png' && $ext1!='.xls' && $ext1!='.docx' && $ext1!='.xlsx' && $ext1!='.pdf' && $ext1!='.txt' && $ext1!='.rar')
                        {$this->getUser()->setFlash('sms',sprintf("Formato de archivo no válido"));return;}
                    else if($archivo1->getSize()>3000000)
                        {$this->getUser()->setFlash('sms',sprintf("El archivo no debe ser mayor a 1mb"));return;}
                }
                
                if(!empty($archivo2)){
                    $ext1 = strtolower($archivo2->getExtension($archivo2->getOriginalExtension()));
                    if($ext1!='.jpg' && $ext1!='.jpeg' && $ext1!='.doc' && $ext1!='.odp' && $ext1!='.gif' && $ext1!='.png' && $ext1!='.xls' && $ext1!='.docx' && $ext1!='.xlsx' && $ext1!='.pdf' && $ext1!='.txt' && $ext1!='.rar')
                        {$this->getUser()->setFlash('sms',sprintf("Formato de archivo no válido"));return; }
                     else if($archivo2->getSize()>3000000)
                        {$this->getUser()->setFlash('sms',sprintf("El archivo no debe ser mayor a 1mb"));return;}
                }
              
                if($accion=='Enviar solicitud'){
                        
                    $sms=SitTicketsPeer::guarda_ticket($datos,$idu,$archivo1,$archivo2);
                    
                    if($sms!=false){
                        
                        //ENVÍO CORREO//
                        $correo=  SitUnidadesPeer::retrieveByPK($datos['idunidad']);
                        $solicitante = $this->getUser()->getGuardUser()->getProfile()->getNombre1().' '.$this->getUser()->getGuardUser()->getProfile()->getApellido1();
                        $cuerpo=new CorreoCuerpo();
                        $cuerpo->SitSolicitud($solicitante,$datos['extension'],$datos['solicitud'],$correo->getCorreo());
                        ////////////////
                        
                        $this->getUser()->setFlash('sms',sprintf($sms));
                        $this->redirect("solicitud/estatus"); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
          } else $this->getUser()->setFlash('sms',sprintf("Debe verificar el formulario."));
      }
  }
  
  public function executeEstatus(sfWebRequest $request)
  {
      
        $idu=$this->getUser()->getGuardUser()->getId();
  	
  	$a=new Criteria();
  	$a->add(SitTicketsPeer::ID_SOLICITANTE,$idu);
  	$a->addDescendingOrderByColumn('ID_TICKET');
        
        $p=new Paginacion();
	$p->paginar("SitTicketsPeer","ID_TICKET",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->tickets=$p->getLista();
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);
      
  }
  
  public function executeDetalle(sfWebRequest $request)
  {
    	//recibo el id del ticket
  	$idtk = $this->getRequestParameter('id');   	

  	//obtengo la informacion del ticket
  	$a=new Criteria();
	$a->add(SitTicketsPeer::ID_TICKET,$idtk);
	$a->addJoin(SitUnidadesPeer::ID_UNIDAD, SitTicketsPeer::ID_UNIDAD);
	$a->addDescendingOrderByColumn("ID_TICKET");
	$this->tickets=SitTicketsPeer::doSelect($a);
        $this->unidad=SitUnidadesPeer::doSelect($a);
      
  }
  
}
