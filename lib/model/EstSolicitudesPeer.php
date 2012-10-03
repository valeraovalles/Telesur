<?php


/**
 * Skeleton subclass for performing query and update operations on the 'est_solicitudes' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Aug  3 15:40:45 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class EstSolicitudesPeer extends BaseEstSolicitudesPeer {
    
    public static function guarda_solicitud($datos,$ids,$fecha){
        
        $a=new EstSolicitudes;
        $a->setIdSolicitante($ids);
        $a->setHoraDesde($datos['desde']);
        $a->setHoraHasta($datos['hasta']);
        $a->setEstudio($datos['estudio']);
        $a->setObservaciones($datos['observaciones']);
        $a->setIdProducto($datos['producto']);
        $a->setFechaSolicitud($fecha);
        $a->setEstatus('e');
        if($a->save())return "Solicitud enviada exitosamente"; else return "Operación inválida";
        
        
    }

} // EstSolicitudesPeer
