<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tra_solicitudes' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Apr 18 16:14:57 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class TraSolicitudesPeer extends BaseTraSolicitudesPeer {

    public static function guarda_solicitud($datos,$idu){
  
            $a = new TraSolicitudes;        
            $a->setFechaSolicitud(date('Y-m-d'));
            $a->setFechaSalida($datos['fecha_salida']);
            $a->setHoraSalida($datos['hora_salida']['hour'].':'.$datos['hora_salida']['minute']);
            $a->setDireccionTraslado($datos['direccion_traslado']);
            $a->setDescripcionEquipos($datos['descripcion_equipos']);
            $a->setDatosInteresRazon($datos['datos_interes_razon']);
            $a->setAsistentes($datos['asistentes']);
            $a->setIdSolicitante($idu);
            $a->setTipoTransporte($datos['tipo_transporte']);
            $a->setTipoSolicitud("t");
            $a->setEstatus("n");
            if($a->save()) return "Datos guardados exitosamente"; else return false; 

    }
    
    public static function guarda_correspondencia($datos,$idu){
  
            $a=new Criteria();
            $a->add(SfGuardUserProfilePeer::USER_ID,$idu);
            $a->add(SfGuardUserProfilePeer::EXTENSION,$datos['extension']);
            SfGuardUserProfilePeer::doUpdate($a);        
            $a = new TraSolicitudes;        
            $a->setFechaSolicitud(date('Y-m-d'));
            //$a->setFechaSalida($datos['fecha_salida']);
            //$a->setHoraSalida($datos['hora_salida']['hour'].':'.$datos['hora_salida']['minute']);
            $a->setDireccionTraslado($datos['direccion_traslado']);
            $a->setDatosInteresRazon($datos['datos_interes_razon']);
            $a->setIdSolicitante($idu);
            $a->setTipoTransporte('m');
            $a->setTipoSolicitud("c");
            $a->setEstatus("n");
            if($a->save()) return "Datos guardados exitosamente"; else return false; 
            
            
            

    }
    
    public static function aprobar_solicitud ($ids){

       $a = new Criteria();
       $a->add(TraSolicitudesPeer::ID_SOLICITUD,  $ids);
       $a->add(TraSolicitudesPeer::ESTATUS,'ap');
       if(TraSolicitudesPeer::doUpdate($a))return "La solicitud ha sido aprobada";
       else return false;     
    
    }
    
    public static function rechazar_solicitud ($ids,$justificacion){
        
       $a = new Criteria();
       $a->add(TraSolicitudesPeer::ID_SOLICITUD,  $ids);
       $a->add(TraSolicitudesPeer::ESTATUS,'r');
       $a->add(TraSolicitudesPeer::JUSTIFICACION_RECHAZO,$justificacion);
       if(TraSolicitudesPeer::doUpdate($a))return "La solicitud fue rechazada";
       else return false;
    }
    
    public static function cierre_justificado ($ids,$justificacion){
        
       $a = new Criteria();
       $a->add(TraSolicitudesPeer::ID_SOLICITUD,  $ids);
       $a->add(TraSolicitudesPeer::ESTATUS,'cj');
       $a->add(TraSolicitudesPeer::JUSTIFICACION_RECHAZO,$justificacion);
       if(TraSolicitudesPeer::doUpdate($a))return "La solicitud fue cerrada";
       else return false;
    }
    
    public static function cerrar_solicitud ($ids){
        
       $asignado=  TraAsignacionesPeer::retrieveByPK($ids);
                
       if(!empty($asignado)){                
            $a = new Criteria();
            $a->add(TraSolicitudesPeer::ID_SOLICITUD,  $ids);
            $a->add(TraSolicitudesPeer::ESTATUS,'c');
            if(TraSolicitudesPeer::doUpdate($a))return "La solicitud ha sido cerrada";
            else return false;
       } else return false;     
       
    }
    
    public static function asignar_conductor_transporte ($ids,$idconductor,$idvehiculo){

        $asignado=  TraAsignacionesPeer::retrieveByPK($ids);
        
        if(empty($asignado)){  
            $a = new TraAsignaciones;
            $a->setIdSolicitud($ids);
            $a->setIdConductor($idconductor);
            $a->setIdVehiculo($idvehiculo);
            if($a->save()){
                $a=new Criteria();
                $a->add(TraSolicitudesPeer::ID_SOLICITUD,$ids);
                $a->add(TraSolicitudesPeer::ESTATUS,'a');
                if(TraSolicitudesPeer::doUpdate($a)) return "Transporte asignado";
                else return false;
            } else return false;
        } else {
                $a=new Criteria();
                $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
                $a->add(TraAsignacionesPeer::ID_CONDUCTOR,$idconductor);
                $a->add(TraAsignacionesPeer::ID_VEHICULO,$idvehiculo);
                if(TraAsignacionesPeer::doUpdate($a)){
                  $a=new Criteria();
                  $a->add(TraSolicitudesPeer::ID_SOLICITUD,$ids);
                  $a->add(TraSolicitudesPeer::ESTATUS,'a');
                  TraSolicitudesPeer::doUpdate($a);
                  return "Transporte cambiado";
                }
                else return false;                
        }
        
    }

 
} // TraSolicitudesPeer
