<?php

/**
 * categorias actions.
 *
 * @package    Telesur
 * @subpackage categorias
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoriasActions extends sfActions
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
  	$idu = $this->getUser()->getGuardUser()->getId();
        
        $this->idunidadusuario = $this->idunidadusuario();
        $this->unidadusuario = $this->unidadusuario();
 	
        //obtengo las categorias de la unidad
        $a=new Criteria();
	$a->add(SitCategoriasUnidadesPeer::ID_UNIDAD,$this->idunidadusuario);
	$a->addjoin(SitCategoriasPeer::ID_CATEGORIA,SitCategoriasUnidadesPeer::ID_CATEGORIA);
	$this->categorias=SitCategoriasPeer::doSelect($a);
        ////////////////////////////////////////////////////////////////////////
        
  	if ($request->isMethod('post'))
	{            
            $accion=$request->getParameter("accion");
            $idcategoria=$request->getParameter("eliminar");
            

            if($accion=='Eliminar'){
                $sms=SitCategoriasPeer::eliminar_categoria($idcategoria);      
                    
                if($sms!=false){
                    $this->getUser()->setFlash('sms',sprintf($sms));
                    $this->redirect("categorias/index"); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
		
            }
	}
  }
  
  public function executeCrearcategoria(sfWebRequest $request)
  {
  	$idu=$this->getUser()->getGuardUser()->getId();
        
        $this->idunidadusuario = $this->idunidadusuario();
        $this->unidadusuario = $this->unidadusuario();
	
  	
  	if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
            
            if($accion=='Crear categoria'){
            
		  $categoria=$request->getParameter("categoria");
		  
                  if($categoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una categoria"));return;}
		  	
		  else{
		  	$sms=  SitCategoriasPeer::crear_categoria($this->idunidadusuario, $categoria);		
                        
                        if($sms!=false){
                            $this->getUser()->setFlash('sms',sprintf($sms));
                            $this->redirect("categorias/index"); 
                        } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error o ya existe una categoria con el mismo nombre"));return;}
		  }	
                        
            }
	} 
      
  }
  
  public function executeCrearsubcategoria(sfWebRequest $request)
  {
        //recibo el id de la categoriat
  	$this->idcat = $this->getRequestParameter('id'); 
        
        //obtengo id de usuario
  	$idu=$this->getUser()->getGuardUser()->getId();
                
        //obtengo la categoria que seleccione
        $a=new Criteria();
        $a->add(SitCategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->categoria=SitCategoriasPeer::doSelect($a);
        
        
        if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
          
            if($accion=='Crear subcategoria'){      
                
                $subcategoria=$request->getParameter("subcategoria");
                
                if($subcategoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una subcategoria"));return;}
                
                else{
                    
                    $sms=SitSubcategoriasPeer::crear_subcategoria($this->idcat, $subcategoria);
                    if($sms!=false){
                            $this->getUser()->setFlash('sms',sprintf($sms));
                            $this->redirect("categorias/crearsubcategoria?id=".$this->idcat); 
                    } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                }
            }
        }
      
  }
  
  public function executeConsultarcategoria(sfWebRequest $request)
  {     
         //obtengo id de usuario
  	$idu=$this->getUser()->getGuardUser()->getId();
        
        //recibo el id por get
  	$this->idcat = $this->getRequestParameter('id');  
                 
        //obtengo la categoria que seleccione
        $a=new Criteria();
        $a->add(SitCategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->categoria=SitCategoriasPeer::doSelect($a);
        
        //obtengo las subcategorias de la categoria seleccionada
        $a=new Criteria();
        $a->add(SitSubcategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->subcategorias=SitSubcategoriasPeer::doSelect($a);    
        
        if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
            
            if($accion=='Eliminar'){
                
                $eliminar=$request->getParameter("eliminar");

                $sms=SitCategoriasPeer::eliminar_subcategoria($eliminar);
                if($sms!=false){
                            $this->getUser()->setFlash('sms',sprintf($sms));
                            $this->redirect("categorias/consultarcategoria?id=".$this->idcat); 
                } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
            }
        }       
  }
  
  public function executeEditarcategoria(sfWebRequest $request)
  {
  	//recibo el id del ticket
  	$this->idcategoria = $this->getRequestParameter('id');   
        $this->categoria=SitCategoriasPeer::retrieveByPK($this->idcategoria);
        
	if ($request->isMethod('post'))
	{
            
            $accion=$request->getParameter("accion");
            
            if($accion=='Actualizar categoria'){                
            
		  $categoria=$request->getParameter("categoria");
                        
		  if($categoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una categoria"));return;}
		  	
                  else{
                      
                        $sms=SitCategoriasPeer::editar_categoria($this->idcategoria,$categoria);
                        if($sms!=false){
                                    $this->getUser()->setFlash('sms',sprintf($sms));
                                    $this->redirect("categorias/editarcategoria?id=".$this->idcategoria); 
                        } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                      

		  	}		  	
             } 	
         }       
      
  }   
  
  public function executeEditarsubcategoria(sfWebRequest $request)
  {
      
  	//recibo el id del ticket
  	$this->idsubcategoria = $this->getRequestParameter('id');   
        $this->subcategoria=SitSubcategoriasPeer::retrieveByPK($this->idsubcategoria);
        
	if ($request->isMethod('post'))
	{
            
            $accion=$request->getParameter("accion");
            
            if($accion=='Actualizar subcategoria'){                
            
		  $subcategoria=$request->getParameter("subcategoria");
                        
		  if($subcategoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una subcategoria"));return;}
		  	
                  else{
                      
                        $sms=SitSubcategoriasPeer::editar_subcategoria($this->idsubcategoria,$subcategoria);
                        if($sms!=false){
                                    $this->getUser()->setFlash('sms',sprintf($sms));
                                    $this->redirect("categorias/editarsubcategoria?id=".$this->idsubcategoria); 
                        } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                      

		  	}		  	
             } 	
         }       
      
      
  }   
  

}
