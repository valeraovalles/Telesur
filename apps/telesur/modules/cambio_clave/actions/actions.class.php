<?php

/**
 * cambio_clave actions.
 *
 * @package    principal
 * @subpackage cambio_clave
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cambio_claveActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	
  public function executeIndex(sfWebRequest $request)
  {
      $this->sms='';
  	
    if ($request->isMethod('post'))
    {
                    
        $datos=$request->getParameter("datos");
	$actual=$datos['actual'];
	$nueva=$datos['nueva'];
	$confi=$datos['confirmar'];

  		if($actual=='' || $nueva=='' || $confi=='')
  			$this->sms='Debe llenar todos los campos';
  			
  		else if($this->getUser()->checkPassword($actual)!=1)
  			$this->sms='La clave actual no coincide';
  			
  		else if(strlen($nueva)<6)
  			$this->sms='La clave debe tener al menos 6 caracteres';
  			
  		else if($nueva!=$confi)
  			$this->sms='Las claves deben ser iguales';

  		else  {

		  	$datos=$request->getParameter("datos");
		  	
		  	$password = new PluginsfGuardUser();
			$password->setPassword($datos['nueva']);
			$pass_nuevo = $password->getPassword();
			$salt = $password->getSalt();
			
						
		  	$a=new Criteria();
		  	$a->add(sfGuardUserPeer::ID,$this->getUser()->getGuardUser()->getId());
			$a->add(sfGuardUserPeer::PASSWORD,$pass_nuevo);
			$a->add(sfGuardUserPeer::SALT,$salt);
			sfGuardUserPeer::doUpdate($a);
			
			$this->getUser()->setFlash('notice',sprintf('Operacion realizada con exito'));
                        $this->redirect("cambio_clave/index");
                }
		  	
	 }

  }
  
    public function executeValida(sfWebRequest $request)
  {
  	
  	
  	
  		
  	
  }
}
