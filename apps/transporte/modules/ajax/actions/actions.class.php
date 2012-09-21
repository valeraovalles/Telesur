<?php

/**
 * ajax actions.
 *
 * @package    proyecto
 * @subpackage ajax
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ajaxActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    

  
  public function executeMuestrapersonal(sfWebRequest $request)
  {
    $this->setLayout("layout_limpio");
  }
  
    public function executeAgregapersonalista(sfWebRequest $request)
  {
    $this->setLayout("layout_limpio");
  }
  


}
