<?php

/**
 * prestaciones actions.
 *
 * @package    Telesur
 * @subpackage prestaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class prestacionesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     
   
 
  }
  
  public function executeGenerartxt(sfWebRequest $request)
  {
                
          $this->anio = $request->getParameter('anio');  
          $this->nomina = $request->getParameter('nomina');  
          $this->periodo = $request->getParameter('periodo');  
          $this->nidesde = $request->getParameter('nidesde'); 
          $this->nihasta = $request->getParameter('nihasta'); 
      
      
   
 
  }

}
