<?php

/**
 * usuarios actions.
 *
 * @package    Telesur
 * @subpackage usuarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuariosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->setLayout('layout_limpio');
  }
  
  public function executeFormulario_ingreso(sfWebRequest $request)
  {
      
      if ($request->isMethod('post'))
      {                  
          $cedula = $request->getParameter('cedula');    
          $accion = $request->getParameter('accion');
          
          if($accion=='Buscar Usuario'){
              echo $cedula;
          }
      }
    
  
  }
}
