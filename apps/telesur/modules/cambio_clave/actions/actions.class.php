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
  	
  	  	if ($request->isMethod('post'))
	  	{
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

		  	
	  	}

  }
  
    public function executeValida(sfWebRequest $request)
  {
  	
  	$this->setLayout("layout_limpio");
  	
  	$modulo=$_GET['opc'];
  	$datos=$_GET['datos'];
  	
	
  	if($modulo=="cambio_clave"){
  		
  		$array=explode(",",$datos);
  		
  		$actual=$array[0];
  		$nueva=$array[1];
  		$confi=$array[2];
  		

  		if($actual=='' || $nueva=='' || $confi=='')
  			echo "<div class='sms'>Debe llenar todos los campos</div>";
  			
  		else if($this->getUser()->checkPassword($actual)!=1)
  			echo "<div class='sms'>La clave actual no coincide</div>";
  			
  		else if(strlen($nueva)<6)
  			echo "<div class='sms'>La clave debe tener al menos 6 caracteres</div>";
  			
  		else if($nueva!=$confi)
  			echo "<div class='sms'>Las claves deben ser iguales</div>";

  		else echo "::envia::";

  	
  	}
  		
  	
  }
}
