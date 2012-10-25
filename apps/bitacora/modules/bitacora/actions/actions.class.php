<?php

/**
 * bitacora actions.
 *
 * @package    Telesur
 * @subpackage bitacora
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bitacoraActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      
  }
  
  public function executeListado(sfWebRequest $request)
  {
      
            
      $idu=$this->getUser()->getGuardUser()->getId();
  	
      $a=new Criteria();
      $a->addJoin(SfGuardUserProfilePeer::USER_ID, BitBitacoraPeer::ID_USUARIO);
      $a->addJoin(BitSubcategoriasPeer::ID_SUBCATEGORIA, BitBitacoraPeer::ID_SUBCATEGORIA);
      $a->addDescendingOrderByColumn("id_bitacora");
  	
      $this->form_filter=new BitBitacoraFormFilter();
	
    if ($request->isMethod('post')){
  	  	$bitacora=$request->getParameter("bit_bitacora_filters");
  	  	$this->form_filter->setDatos($bitacora);
  	  	
  	  	if($bitacora['fecha']!='')
  	  	$a->add(BitBitacoraPeer::FECHA,$bitacora['fecha']);
  	  	
  	  	if($bitacora['id_subcategoria']!='')
  	  	$a->add(BitBitacoraPeer::ID_SUBCATEGORIA,$bitacora['id_subcategoria']);
  	  	
  	}
  	
  	
  	$p=new Paginacion();
	$p->paginar("BitBitacoraPeer","ID_BITACORA",$a);
	$this->pagina=$p->getPagina();
	$this->cantidad_paginas=$p->getCantidadPaginas();
	$this->bitacora=$p->getLista();	
        $this->subcategoria=BitSUbcategoriasPeer::doSelect($a);
	$this->perfiles=SfGuardUserProfilePeer::doSelect($a);  
        
        

      
  }
  
  public function executeRegistro(sfWebRequest $request)
  {
      $idu=$this->getUser()->getGuardUser()->getId();
      
      $this->form= new BitBitacoraForm;
      
      if ($request->isMethod('post'))
      { 
          $datos = $request->getParameter('datos_form');    
          $accion = $request->getParameter('accion'); 
          $this->form->setDatos($datos);
          
          if($accion=='Guardar'){
   
            $this->form->bind($datos);
                
            if ($this->form->isValid())
            {
               $sms=  BitBitacoraPeer::guardar($idu,$datos);
                
               if($sms==false){
                  $this->getUser()->setFlash('sms',sprintf("Operación inválida exitosa."));
                  $this->redirect("bitacora/registro");
               }else{
                   $this->getUser()->setFlash('sms',sprintf($sms));
                   $this->redirect("bitacora/listado"); 
               }

            } 
         }
      }
   }
}
