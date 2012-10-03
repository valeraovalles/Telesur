<?php

/**
 * admin actions.
 *
 * @package    Telesur
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adminActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $f=new funciones;
      $this->filtro=new EstSolicitudesFormFilter;
      
      $a = new Criteria();
      
      if ($request->isMethod('post'))
      {  
            $filtro = $request->getParameter('datos_form');

            $this->filtro->setDatos($filtro);

            if($filtro['estudio']!='')
            $a->add(EstSolicitudesPeer::ESTUDIO,$filtro['estudio']);
            
            if($filtro['estatus']!='')
            $a->addAnd(EstSolicitudesPeer::ESTATUS,$filtro['estatus']);
            
            if($filtro['responsable']!='')
            $a->add(EstSolicitudesPeer::ID_SOLICITANTE,$filtro['responsable']);
            
            if($filtro['hora_desde']!='')
            $a->add(EstSolicitudesPeer::ESTATUS,$filtro['desde']);
            
            if($filtro['hora_hasta']!='')
            $a->add(EstSolicitudesPeer::ESTATUS,$filtro['hasta']);
      }
      
      $a->addDescendingOrderByColumn('id_solicitud');
      $a->add(EstSolicitudesPeer::ESTATUS,'f',  Criteria::NOT_IN);
            
      $p=new Paginacion();
      $p->paginar("EstSolicitudesPeer","ID_SOLICITUD",$a);
      $this->pagina=$p->getPagina();
      $this->cantidad_paginas=$p->getCantidadPaginas();
      $this->solicitudes=$p->getLista();	

  }
  
  public function executeDetalle(sfWebRequest $request)
  {
        //capturo el id de la constancia
        $ids=$this->getRequestParameter('ids');
        //
        
        //obtengo datos de la constancia y del solicitante
  	$this->solicitud=  EstSolicitudesPeer::retrieveByPK($ids);        
        $this->solicitante=SfGuardUserProfilePeer::retrieveByPK($this->solicitud->getIdSolicitante());
        $this->producto=  EstProductosPeer::retrieveByPK($this->solicitud->getIdProducto());
        //
        
  	if ($request->isMethod('post')){
            
            $accion=$request->getParameter("accion");
            
            if($accion=='Aprobar'){
                
                $a=new Criteria();
                $a->add(EstSolicitudesPeer::ID_SOLICITUD,$ids);
                $a->add(EstSolicitudesPeer::ESTATUS,'a');
                if(EstSolicitudesPeer::doUpdate($a)){
                    $this->getUser()->setFlash('sms',sprintf('Solicitud aprobada'));
                    $this->redirect("admin/detalle?ids=".$ids);
                }
                else {
                    $this->getUser()->setFlash('sms',sprintf('Operación inválida'));
                    $this->redirect("admin/detalle?ids=".$ids);
                }
                
            }
            
            else if($accion=='Rechazar'){
                
                $a=new Criteria();
                $a->add(EstSolicitudesPeer::ID_SOLICITUD,$ids);
                $a->add(EstSolicitudesPeer::ESTATUS,'r');
                if(EstSolicitudesPeer::doUpdate($a)){
                    $this->getUser()->setFlash('sms',sprintf('Solicitud rechazada'));
                    $this->redirect("admin/detalle?ids=".$ids);
                }
                else {
                    $this->getUser()->setFlash('sms',sprintf('Operación inválida'));
                    $this->redirect("admin/detalle?ids=".$ids);
                }
                
            }

	
			
	} 	 
      
  }
}
