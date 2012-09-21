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
  public function executeAccion(sfWebRequest $request)
  {
      
      $this->setLayout("layout_limpio");
  	
      $this->datos=$_GET['datos'];
      $this->opc=$_GET['opc'];
  	

      //busco los tecnicos del departamento al cual pertenece el usuario actual
      $idu=$this->getUser()->getGuardUser()->getId();
  	
      $f=new funciones;
      $idunidad=$f->SitIdUnidad($idu);
		
      if($this->datos==1){
          
        $a = new Criteria();
	$a->add(SitUsuariosUnidadesPeer::ID_UNIDAD,$idunidad);
	$a->addjoin(SfGuardUserProfilePeer::USER_ID,SitUsuariosUnidadesPeer::ID_USUARIO);
        $a->addjoin(SfGuardUserProfilePeer::USER_ID,SitUsuariosUnidadesPeer::ID_USUARIO);
        
	$this->tecnico_unidad=SfGuardUserProfilePeer::doSelect($a);
      }
  		
      if($this->datos==2){
        //departamentos
        $a = new Criteria();
        $a->add(SitUnidadesPeer::ID_UNIDAD,$idunidad, Criteria::NOT_EQUAL);
	$this->unidades=SitUnidadesPeer::doSelect($a);
      }
  }
  public function executeComentarios(sfWebRequest $request)
  {
        $this->setLayout("layout_limpio");
  	$idtk=$_GET['idtk'];
  		
  	$a=new Criteria();
	$a->add(SitComentariosPeer::ID_TICKET,$idtk);
	$a->addJoin(SfGuardUserProfilePeer::USER_ID, SitComentariosPeer::ID_USUARIO);
	$a->addDescendingOrderByColumn("ID_COMENTARIO");
	$this->comentarios=SitComentariosPeer::doSelect($a);
	$this->comentarios_u=SfGuardUserProfilePeer::doSelect($a);      
      
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
    public function executeSitCantidadTickets(sfWebRequest $request)
  {
        $this->setLayout("layout_limpio");
        
        $idu=$this->getUser()->getGuardUser()->getId();
       
        //CONSULTO EL DEPARTAMENTO DEL USUARIO ACTUAL
        $a=new Criteria();
        $a->add(SitUsuDepPeer::ID_USUARIO,$idu);
        $SitUsuDep=SitUsuDepPeer::doSelect($a);
                 
        //VERIFICO CUANTOS TICKETS NUEVOS TIENE LA UNIDAD
        $a=new Criteria();
        $a->add(SitTicketsPeer::STATUS,0);
        $a->add(SitTicketsPeer::ID_DEPARTAMENTO,$SitUsuDep[0]->getIdDepartamento());
        $this->tickets_nuevos=SitTicketsPeer::doCount($a);
        
        //VERIFICO CUANTOS TICKETS TIENE ASIGNADOS UN TECNICO
        $a=new Criteria();
        $a->add(SitTicketsPeer::STATUS,1);
        $a->add(SitUsuTicketPeer::ID_USUARIO,$idu);
        $a->add(SitTicketsPeer::ID_DEPARTAMENTO,$SitUsuDep[0]->getIdDepartamento());
        $a->addJoin(SitTicketsPeer::ID_TICKET,SitUsuTicketPeer::ID_TICKET);
        $this->tickets_asignados=SitTicketsPeer::doCount($a);
        
        //VERIFICO CUANTAS NOTIFICACIONES DE CIERRE A REALIZADO UN TECNICO
        $a=new Criteria();
        $a->add(SitTicketsPeer::STATUS,2);
        $a->add(SitTicketsPeer::ID_DEPARTAMENTO,$SitUsuDep[0]->getIdDepartamento());
        $this->tickets_notificados=SitTicketsPeer::doCount($a);
  }
}
