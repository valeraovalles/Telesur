<?php

/**
 * visitas actions.
 *
 * @package    Telesur
 * @subpackage visitas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class visitasActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  //20865825
  }
  
  public function executeForm_ingreso(sfWebRequest $request)
  {
      $this->cedula='';
      $this->form=new formingresovisitasForm; 
      $this->form2=new formingresovisitas2Form;
      
      if ($request->isMethod('post'))
      {   
          $this->cedula = $request->getParameter('cedula');    
          $accion = $request->getParameter('accion');

          
          //BUSCO EL USUARIO DE LA CEDULA INDICADA
          if($accion=='Buscar Usuario'){
              if($this->cedula=='' || strlen($this->cedula)>15)
              {
                    $this->getUser()->setFlash('sms',sprintf('Cedula incorrecta'));
                    $this->redirect("visitas/form_ingreso"); 
              }
              else{
                  
                  $a=new Criteria();
                  $a->add(CvUsuariosPeer::CEDULA,$this->cedula);
                  $this->datos=  CvUsuariosPeer::doSelect($a);
                  
                  if(empty($this->datos)){
                      
                    $a=new Criteria();
                    $a->add(TsurCnePeer::CEDULA,$this->cedula);
                    $this->datos=  TsurCnePeer::doSelect($a);
                    if(empty($this->datos)) $this->exist=0;
                      
                      
                    
                  } else $this->exist=1;
              }
              
              print_r($this->datos);
          }
          
          else if($accion=='Registrar Visitante'){
                  
            //recibo formulario
            $datos = $request->getParameter('datos');
            
            //valido formulario
            $this->form->bind($datos);
            
            //variable si no existe cedula
            $this->exist=0;
              
            //si el formulario es valido
            if ($this->form->isValid())
            {
               $rs=CvUsuariosPeer::guarda_usuario($datos,$this->cedula);
               
               if($rs!=false){
                   
                   CvVisitasPeer::guarda_visita($datos,$rs);
                   
                   
                   
                   
                    $this->getUser()->setFlash('sms',sprintf("Visita Registrada"));
                    $this->redirect("visitas/form_ingreso"); 
               }

            }
         }
         
         /*
         //REGISTRO VISITA
         else if($accion=='Registrar Visita'){
             $datos2 = $request->getParameter('datos2');
             
             //valido formulario
             $this->form2->bind($datos2);        
             //variable si no existe cedula
             
             $a=new Criteria();
             $a->add(CvUsuariosPeer::CEDULA,$this->cedula);
             $this->datos=  CvUsuariosPeer::doSelect($a);
             $this->exist=1;
   
             CvVisitasPeer::guarda_visita($datos2,$this->datos[0]->getIdUsuario());
             $this->getUser()->setFlash('sms',sprintf("Visita Registrada"));
                    $this->redirect("visitas/form_ingreso");
         }
          //registro salida
         
        $a=new Criteria();
  	$a->addJoin(SfGuardUserProfilePeer::USER_ID, CvVisitasPeer::ID_USUARIO);
  	$a->addDescendingOrderByColumn("id_visita");
  	
  	$this->form_filter=new CtVisitasFormFilter();
	
    if ($request->isMethod('post')){
  	  	$datos=$request->getParameter("vistas_filters");
  	  	$this->form_filter->setDatos($constancias);
  	  	
  	  	if($datos['cedula']!='')
  	  	$a->add(CtVisitasPeer::ID_visitante,$datos['cedula']);
  	  	
  	  	if($datos['num_carnet']!='')
  	  	$a->add(CtConstanciasPeer::ESTATUS,$constancias['estatus']);
  	  	
  	  
  	}
  	
  	
  	$p=new Paginacion();
	$p->paginar("CtVisitasPeer","ID_visita",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->constancias=$p->getLista();	
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);  
        
        
        $a=new Criteria();
        $a->add(CtPeer::ESTATUS,'n');
        $this->hora_salida=CtVisitasPeer::doCount($a);
        
        $a=new Criteria();
        $a->add(CtConstanciasPeer::ESTATUS,'v');
        $this->cantidad_vista=CtConstanciasPeer::doCount($a);*/
  }
}
}