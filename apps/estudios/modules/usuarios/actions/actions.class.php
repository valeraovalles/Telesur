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

    public function HoraAntes($hora)
  {
        $a=new Criteria();
        $a->addDescendingOrderByColumn("id_hora");
        $horas = EstHorasPeer::doSelect($a);
        
        $cont=0;
        foreach ($horas as $h) {
            if($cont==1)return $h->getHora();
            
            if($h->getHora()==$hora)
                $cont=1;
        }    
          
  }
  public function executeIndex(sfWebRequest $request)
  {



     
      if ($request->isMethod('post'))
      {                  
          $this->mes = $request->getParameter('mes');    
          $this->anio = $request->getParameter('anio');  
          
      }

  }
  
  public function executeSolicitud(sfWebRequest $request)
  {
      $this->idus=$this->getUser()->getGuardUser()->getId();
      $this->observacion='no';
      
      $this->fecha=$this->getRequestParameter('fecha');
   
      //ACTUALIZO LA FECHA DE LOS PROGRAMAS FIJOS PARA QUE SE REFLEJEN EN EL CALENDARIO SELECCIONADO
        $a=new Criteria();
        $a->add(EstSolicitudesPeer::ESTATUS,'f');
        $fijos=EstSolicitudesPeer::doSelect($a);

        
        $dia_fecha=date("N",  strtotime($this->fecha));
        foreach ($fijos as $f) {
            
            $dias=explode(",",$f->getDiaTransmision());

            $valor=in_array($dia_fecha, $dias);
            
            if($valor==true){
                $a=new Criteria();
                $a->add(EstSolicitudesPeer::ID_SOLICITUD,  $f->getIdSolicitud());
                $a->add(EstSolicitudesPeer::FECHA_SOLICITUD,  $this->fecha);
                EstSolicitudesPeer::doUpdate($a);
            }
        }
      //

      $this->sms='';
      $this->form=new SolicitudestudiosForm;    
      
      $a=new Criteria();
      $this->horas = EstHorasPeer::doSelect($a);
      
      $a=new Criteria();
      $a->addAscendingOrderByColumn("hora_desde");
      $a->add(EstSolicitudesPeer::FECHA_SOLICITUD,  $this->fecha);
      $this->solicitudes = EstSolicitudesPeer::doSelect($a);

      if ($request->isMethod('post'))
      {
          $datos = $request->getParameter('datos_form');
          $accion = $request->getParameter('accion');
          
          if($accion=='Eliminar'){
              $eliminar = $request->getParameter('eliminar');
              $a=new Criteria();
              $a->add(EstSolicitudesPeer::ID_SOLICITUD,$eliminar);
              if (EstSolicitudesPeer::doDelete($a))
                $this->getUser()->setFlash('sms',sprintf("Pauta eliminada con exito"));
              else
                $this->getUser()->setFlash('sms',sprintf("Operación inválida"));
             
              $this->redirect("usuarios/solicitud?fecha=".$this->fecha); 
          }
          
          
          
          $this->form->setDatos($datos);
          $this->form->bind($datos);

          if ($this->form->isValid())
          {
              
            if($datos['hasta']<=$datos['desde']){
                $this->sms="La hora hasta debe ser mayor que la fecha desde";return;
            }
            
                
            
  
            
            //VALIDO
                //busco las solicitudes
                $a=new Criteria();
                $a->addAscendingOrderByColumn("hora_desde");
                $a->add(EstSolicitudesPeer::FECHA_SOLICITUD,  $this->fecha);
                $a->add(EstSolicitudesPeer::ESTUDIO,$datos['estudio']);
                $a->add(EstSolicitudesPeer::ESTATUS,array('a','e','f'),  Criteria::IN);
                $solicitudes = EstSolicitudesPeer::doSelect($a);

                //me traigo todas las horas solicitadas
                $a=new Criteria();
                $a->add(EstHorasPeer::HORA,$datos['desde'],  Criteria::GREATER_EQUAL);
                $a->addAnd(EstHorasPeer::HORA,  $this->HoraAntes($datos['hasta']),Criteria::LESS_EQUAL);
                $horas_solicitadas=EstHorasPeer::doSelect($a);

                foreach ($solicitudes as $s){

                    //me traigo las horas existentes
                    $a=new Criteria();
                    $a->add(EstHorasPeer::HORA,$s->getHoraDesde(),  Criteria::GREATER_EQUAL);
                    $a->addAnd(EstHorasPeer::HORA,$s->getHoraHasta(),  Criteria::LESS_EQUAL);
                    $horas_existentes=EstHorasPeer::doSelect($a);

                    foreach ($horas_solicitadas as $hs){

                        foreach ($horas_existentes as $he){

                            if($hs->getHora()==$he->getHora()){
                                $this->sms="Debe seleccionar un horario que no este ocupado";return;
                            }
                        }

                    }
                }
            // TERMINO LA VALIDACION
            $observaciones = $request->getParameter('observaciones');
            if(isset($observaciones)){    
                
                if($observaciones==''){
                    $this->sms="Debe agregar una observación";return;
                }
                else $datos['observaciones']= $observaciones;
            }
            
            $hora_antes = $this->HoraAntes($datos['hasta']);
            $datos['hasta']=$hora_antes;
            
          
            $sms=EstSolicitudesPeer::guarda_solicitud($datos, $this->idus, $this->fecha);
             
            $this->getUser()->setFlash('sms',sprintf($sms));
            $this->redirect("usuarios/solicitud?fecha=".$this->fecha); 
           
          }
          
      }
      
      
  }
}
