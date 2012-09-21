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
        //calculo si es lunes o martes
	$this->bloquea=0;

	if(date('N')==1 || date('N')==2){
		$this->bloquea=1;
	}
        //        
  }
  
  public function executeSolicitud(sfWebRequest $request)
  {
        //si no es lunes o martes redirige al index
        $bloquea=0;

        if(date('N')==1 || date('N')==2){
            $bloquea=1;
        }
        
        if($bloquea==0) $this->redirect ("solicitud/index");
        //
        
        //obtengo el id del usuario actual
        $idu=$this->getUser()->getGuardUser()->getId();
        //
        
        //obtengo el cargo y dependencia
        $this->cargo=TsurCargosPeer::retrieveByPK($this->getUser()->getGuardUser()->getProfile()->getIdCargo());
        $this->dependencia=TsurDependenciasPeer::retrieveByPK($this->getUser()->getGuardUser()->getProfile()->getIdDependencia());
        //
        
        $this->form = new ConstanciaformularioForm;
      
        if ($request->isMethod('post'))        
        {        
            $datos = $request->getParameter('datos_form'); 

            $this->form->setDatos($datos);
       
            $this->form->bind($datos);
        
            if ($this->form->isValid()){ 
                                
                $sms=CtConstanciasPeer::guarda_constancia($datos, $idu);
                
		if($sms!=false){
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("solicitud/estatus");
                    
		} else $this->getUser()->setFlash('sms',sprintf('Operación inválida'));
            }
        }     
  }
  
  public function executeEstatus(sfWebRequest $request)
  {     
        $idu=$this->getUser()->getGuardUser()->getId();
  	
  	$a=new Criteria();
  	$a->add(CtConstanciasPeer::ID_SOLICITANTE,$idu);
  	$a->addJoin(SfGuardUserProfilePeer::USER_ID, CtConstanciasPeer::ID_SOLICITANTE);
  	$a->addDescendingOrderByColumn("id_constancia");
  	
  	$p=new Paginacion();
	$p->paginar("CtConstanciasPeer","ID_CONSTANCIA",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->constancias=$p->getLista();	
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);  

      
  }
}
