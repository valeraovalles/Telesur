<?php

/**
 * UsuarioUnidad actions.
 *
 * @package    Telesur
 * @subpackage UsuarioUnidad
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioUnidadActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $a = new Criteria();
      $a->add(SfGuardUserProfilePeer::ID_DEPENDENCIA,22);
      $this->usuarios=  SfGuardUserProfilePeer::doSelect($a);
      

  }
  
  public function executeAsignar(sfWebRequest $request)
  {
      //capturo el id del usuario
      $this->idu=$this->getRequestParameter('id');
        
      $this->unidades = SitUnidadesPeer::doSelect(new Criteria());
      
      if ($request->isMethod('post'))
      {                  
          $unidad= $request->getParameter('unidad'); 
          
          $sms=  SitUsuariosUnidadesPeer::asignar($this->idu,  $unidad);
          
          if($sms!=false){
                $this->getUser()->setFlash('sms',sprintf($sms));
                $this->redirect("UsuarioUnidad/index");    
          } else $this->getUser()->setFlash('sms',sprintf("Ha ocurrido un problema"));
      }
          
          
      
  }
}
