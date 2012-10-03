<?php

/**
 * administracion actions.
 *
 * @package    Telesur
 * @subpackage administracion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administracionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      
      $idu=$this->getUser()->getGuardUser()->getId();
  	
  	$a=new Criteria();
  	$a->addJoin(SfGuardUserProfilePeer::USER_ID, CtConstanciasPeer::ID_SOLICITANTE);
  	$a->addDescendingOrderByColumn("id_constancia");
  	
  	$this->form_filter=new CtConstanciasFormFilter();
	
    if ($request->isMethod('post')){
  	  	$constancias=$request->getParameter("constancias_filters");
  	  	$this->form_filter->setDatos($constancias);
  	  	
  	  	if($constancias['id_solicitante']!='')
  	  	$a->add(CtConstanciasPeer::ID_SOLICITANTE,$constancias['id_solicitante']);
  	  	
  	  	if($constancias['estatus']!='')
  	  	$a->add(CtConstanciasPeer::ESTATUS,$constancias['estatus']);
  	  	
  	  	if($constancias['tipo_constancia']!='')
  	  	$a->add(CtConstanciasPeer::TIPO_CONSTANCIA,$constancias['tipo_constancia']);
  	}
  	
  	
  	$p=new Paginacion();
	$p->paginar("CtConstanciasPeer","ID_CONSTANCIA",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->constancias=$p->getLista();	
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);  
        
        
        $a=new Criteria();
        $a->add(CtConstanciasPeer::ESTATUS,'n');
        $this->cantidad_nueva=CtConstanciasPeer::doCount($a);
        
        $a=new Criteria();
        $a->add(CtConstanciasPeer::ESTATUS,'v');
        $this->cantidad_vista=CtConstanciasPeer::doCount($a);
        
        $a=new Criteria();
        $a->add(CtConstanciasPeer::ESTATUS,'c');
        $this->cantidad_cerrada=CtConstanciasPeer::doCount($a);

  }
  
  public function executeEditar(sfWebRequest $request)
  {
        //capturo el id de la constancia
        $idc=$this->getRequestParameter('idc');
        //
        
        //obtengo datos de la constancia y del solicitante
  	$this->constancia=CtConstanciasPeer::retrieveByPK($idc);        
        $this->solicitante=SfGuardUserProfilePeer::retrieveByPK($this->constancia->getIdSolicitante());
        //
        
        //obtengo el cargo y dependencia
        $this->cargo=TsurCargosPeer::retrieveByPK($this->solicitante->getIdCargo());
        $this->dependencia=TsurDependenciasPeer::retrieveByPK($this->solicitante->getIdDependencia());
        //    
        
        if($this->constancia->getEstatus()=='n'){
            //cambio el estatus a 1
            $a=new Criteria();
            $a->add(CtConstanciasPeer::ID_CONSTANCIA,$idc);
            $a->add(CtConstanciasPeer::ESTATUS,'v');
            CtConstanciasPeer::doUpdate($a);  
        }
 	
  	if ($request->isMethod('post')){
            
            //recibo los dos campos que se pueden actualizar
            $dirigida=$request->getParameter("dirigida");
            $culmina=$request->getParameter("culmina");
            //
		
            //valido los campos obligatorios
            if($dirigida==''){$this->getUser()->setFlash('sms',sprintf("Debe llenar los campos obligatorios "));return;}
            //

            //actualizo los campos
            $a=new Criteria();
            $a->add(CtConstanciasPeer::ID_CONSTANCIA,$idc);
            $a->add(CtConstanciasPeer::DIRIGIDO_A,$dirigida);
		
            if($culmina=='c'){$a->add(CtConstanciasPeer::ESTATUS,'c');}
			
            if(CtConstanciasPeer::doUpdate($a)){		
			$this->getUser()->setFlash('sms',sprintf('Actualización exitosa'));
			$this->redirect("administracion/editar?idc=".$idc);
            }
            else 
            $this->getUser()->setFlash('sms',sprintf('Operación Inválida'));
	} 	 	
  }
  
  public function executePdfconstancia(sfWebRequest $request)
  {
        $this->setLayout("layout_limpio");
        $idu=$this->getUser()->getGuardUser()->getId();
        
  	$idc=$this->getRequestParameter('idc');

  	$a=new Criteria();
  	$a->add(CtConstanciasPeer::ID_CONSTANCIA,$idc);
  	$a->addJoin(SfGuardUserProfilePeer::USER_ID, CtConstanciasPeer::ID_SOLICITANTE);
  	$a->addJoin(TsurCargosPeer::ID_CARGO, SfGuardUserProfilePeer::ID_CARGO);
  	$a->addJoin(TsurDependenciasPeer::ID_DEPENDENCIA, SfGuardUserProfilePeer::ID_DEPENDENCIA);
  	$this->constancia=CtConstanciasPeer::doSelect($a);
  	$this->perfil=SfGuardUserProfilePeer::doSelect($a);
  	$this->cargo=TsurCargosPeer::doSelect($a);
  	$this->dependencia=TsurDependenciasPeer::doSelect($a);
  		
  	if ($this->perfil[0]->getSexo()=="m") $this->ciudada="el ciudadano"; else $this->ciudada="la ciudadana";
  	
  	$this->nombre=$this->perfil[0]->getNombre1().' '.$this->perfil[0]->getNombre2().' '.$this->perfil[0]->getApellido1().' '.$this->perfil[0]->getApellido2();
  	$this->cedula=$this->perfil[0]->getCedula();
                          
        //nombre del pdf
        $this->nb=$this->perfil[0]->getApellido1().'-'.$this->perfil[0]->getNombre1();
        
        
      
  }
}
