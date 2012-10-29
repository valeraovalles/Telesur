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
	$a->add(BitCategoriasUnidadesPeer::ID_UNIDAD,$this->idunidadusuario);
	$a->addjoin(BitCategoriasPeer::ID_CATEGORIA,BitCategoriasUnidadesPeer::ID_CATEGORIA);
	$this->categorias=BitCategoriasPeer::doSelect($a);
        ////////////////////////////////////////////////////////////////////////
        
  	if ($request->isMethod('post'))
	{            
            $accion=$request->getParameter("accion");
            $idcategoria=$request->getParameter("eliminar");
            

            if($accion=='Eliminar'){
                $sms=BitCategoriasPeer::eliminar_categoria($idcategoria);      
                    
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
		  	$sms=  BitCategoriasPeer::crear_categoria($this->idunidadusuario, $categoria);		
                        
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
        $a->add(BitCategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->categoria=BitCategoriasPeer::doSelect($a);
        
        
        if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
          
            if($accion=='Crear subcategoria'){      
                
                $subcategoria=$request->getParameter("subcategoria");
                
                if($subcategoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una subcategoria"));return;}
                
                else{
                    
                    $sms=BitSubcategoriasPeer::crear_subcategoria($this->idcat, $subcategoria);
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
        $a->add(BitCategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->categoria=BitCategoriasPeer::doSelect($a);
        
        //obtengo las subcategorias de la categoria seleccionada
        $a=new Criteria();
        $a->add(BitSubcategoriasPeer::ID_CATEGORIA,$this->idcat);
        $this->subcategorias=BitSubcategoriasPeer::doSelect($a);    
        
        if ($request->isMethod('post'))
	{
            $accion=$request->getParameter("accion");
            
            if($accion=='Eliminar'){
                
                $eliminar=$request->getParameter("eliminar");

                $sms=BitCategoriasPeer::eliminar_subcategoria($eliminar);
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
        $this->categoria=BitCategoriasPeer::retrieveByPK($this->idcategoria);
        
	if ($request->isMethod('post'))
	{
            
            $accion=$request->getParameter("accion");
            
            if($accion=='Actualizar categoria'){                
            
		  $categoria=$request->getParameter("categoria");
                        
		  if($categoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una categoria"));return;}
		  	
                  else{
                      
                        $sms=BitCategoriasPeer::editar_categoria($this->idcategoria,$categoria);
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
        $this->subcategoria=BitSubcategoriasPeer::retrieveByPK($this->idsubcategoria);
        
	if ($request->isMethod('post'))
	{
            
            $accion=$request->getParameter("accion");
            
            if($accion=='Actualizar subcategoria'){                
            
		  $subcategoria=$request->getParameter("subcategoria");
                        
		  if($subcategoria==''){ $this->getUser()->setFlash('sms',sprintf("Debe escribir una subcategoria"));return;}
		  	
                  else{
                      
                        $sms=BitSubcategoriasPeer::editar_subcategoria($this->idsubcategoria,$subcategoria);
                        if($sms!=false){
                                    $this->getUser()->setFlash('sms',sprintf($sms));
                                    $this->redirect("categorias/editarsubcategoria?id=".$this->idsubcategoria); 
                        } else {$this->getUser()->setFlash('sms',sprintf("Ha ocurrido un error"));return;}
                      

		  	}		  	
             } 	
         }       
    }   
}
