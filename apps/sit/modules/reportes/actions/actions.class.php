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

      
      
      $this->form = new ReporteinformegestionForm;
      
      
      
      if ($request->isMethod('post'))
      {
          $datos=$request->getParameter("reporteig");
          $accion=$request->getParameter("accion");
          
          $this->form->setDatos($datos);
          
          if($accion!='unidad'){
            $this->form->bind($datos);

            if ($this->form->isValid())
            {
                    $tipo_archivo=$request->getParameter("ta");
                    if($tipo_archivo=='p')
                    $this->forward("reportes","pdfinformegestion");
                    else
                    if($tipo_archivo=='r')
                    $this->forward("reportes","rtfinformegestion");
            } 
          }
          
      }
      
  }
  
  public function executePdfinformegestion(sfWebRequest $request)
  {
      //$this->setLayout("layout_limpio");
      $this->funciones=new funciones;
      
      if ($request->isMethod('post'))
      {
          $this->datos=$request->getParameter("reporteig");   
          
       

          //ENCABEZADO//////////////////////////////////////////////////////////
            $this->unidad=SitUnidadesPeer::retrieveByPK($this->datos['id_unidad']);

            //valido esto para mostrar en el encabezado
            if($this->datos['desde']!='' && $this->datos['hasta']!=''){

                $this->desdehasta="DESDE ".$this->datos['desde']." HASTA ".$this->datos['hasta'];
            } 

            else if ($this->datos['desde']!='' && $this->datos['hasta']==''){

                $this->desdehasta="DESDE ".$this->datos['desde'];
            }

            else if ($this->datos['hasta']!='' && $this->datos['desde']==''){

                $this->desdehasta="HASTA ".$this->datos['hasta'];
            }

            else if ($this->datos['desde']=='' && $this->datos['hasta']==''){$this->desdehasta="";}
          //////////////////////////////////////////////////////////////////////
                    
          $a=new Criteria();
          
          if($this->datos['desde']!='')
              $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$this->funciones->voltea_fecha($this->datos['desde']),Criteria::GREATER_EQUAL);

          
          if($this->datos['hasta']!='')
              $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$this->funciones->voltea_fecha($this->datos['hasta']),Criteria::LESS_EQUAL);
          
          if($this->datos['id_usuario']!='')
              $a->addAnd(SitTicketsUsuariosPeer::ID_USUARIO,$this->datos['id_usuario']);
                   
                    
          $a->addjoin(SitTicketsUsuariosPeer::ID_TICKET,  SitTicketsPeer::ID_TICKET);
          $a->add(SitTicketsPeer::ID_UNIDAD,$this->datos['id_unidad']);
          $a->add(SitTicketsPeer::ESTATUS,'c');
          $a->addJoin(SitCategoriasPeer::ID_CATEGORIA,SitTicketsPeer::ID_CATEGORIA);          
          $a->addGroupByColumn("sit_categorias.descripcion");
          $a->addGroupByColumn("sit_categorias.id_categoria");
          $a->addAscendingOrderByColumn("descripcion");
          $this->categorias=SitCategoriasPeer::doSelect($a);
          
          if(!isset($this->categorias[0])){
              $this->getUser()->setFlash('sms',sprintf("No existen datos para los parámetros seleccionados"));
              $this->redirect ("reportes/index");
          }
    
          
      }
  }
  
  public function executeRtfinformegestion(sfWebRequest $request)
  {
      $this->setLayout("layout_limpio");
      $this->funciones=new funciones;
      
      if ($request->isMethod('post'))
      {
          $this->datos=$request->getParameter("reporteig");   
       

          //ENCABEZADO//////////////////////////////////////////////////////////
            $this->unidad=SitUnidadesPeer::retrieveByPK($this->datos['id_unidad']);

            //valido esto para mostrar en el encabezado
            if($this->datos['desde']!='' && $this->datos['hasta']!=''){

                $this->desdehasta="DESDE ".$this->datos['desde']." HASTA ".$this->datos['hasta'];
            } 

            else if ($this->datos['desde']!='' && $this->datos['hasta']==''){

                $this->desdehasta="DESDE ".$this->datos['desde'];
            }

            else if ($this->datos['hasta']!='' && $this->datos['desde']==''){

                $this->desdehasta="HASTA ".$this->datos['hasta'];
            }

            else if ($this->datos['desde']=='' && $this->datos['hasta']==''){$this->desdehasta="";}
          //////////////////////////////////////////////////////////////////////
                    
          $a=new Criteria();
          
          if($this->datos['desde']!='')
              $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$this->funciones->voltea_fecha($this->datos['desde']),Criteria::GREATER_EQUAL);

          
          if($this->datos['hasta']!='')
              $a->addAnd(SitTicketsPeer::FECHA_SOLICITUD,$this->funciones->voltea_fecha($this->datos['hasta']),Criteria::LESS_EQUAL);
                    
                    
          $a->add(SitTicketsPeer::ID_UNIDAD,$this->datos['id_unidad']);
          $a->add(SitTicketsPeer::ESTATUS,'c');
          $a->addJoin(SitCategoriasPeer::ID_CATEGORIA,SitTicketsPeer::ID_CATEGORIA);          
          $a->addGroupByColumn("sit_categorias.descripcion");
          $a->addGroupByColumn("sit_categorias.id_categoria");
          $a->addAscendingOrderByColumn("descripcion");
          $this->categorias=SitCategoriasPeer::doSelect($a);
          
          if(!isset($this->categorias[0])){
              $this->getUser()->setFlash('sms',sprintf("No existen datos para los parámetros seleccionados"));
              $this->redirect ("reportes/index");
          }
    
          
      }
  }
}