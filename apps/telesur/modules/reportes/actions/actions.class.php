<?php

/**
 * reportes actions.
 *
 * @package    Telesur
 * @subpackage reportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $a=new JasperReport;
      
      $a->generar("php-jasper/usuarios.jrxml", array('titulo'=>'USUARIOS TELESUR'), "pdf","usuarios");
      exit(0);
  }
}
