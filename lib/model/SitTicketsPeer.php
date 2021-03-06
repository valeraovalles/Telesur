<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sit_tickets' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Apr 18 16:14:54 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class SitTicketsPeer extends BaseSitTicketsPeer {

    public static function guarda_ticket($datos,$idu,$archivo1,$archivo2){

        $a=new Criteria();
	$a->add(SfGuardUserProfilePeer::USER_ID,$idu);
	$a->add(SfGuardUserProfilePeer::EXTENSION,$datos['extension']);
	SfGuardUserProfilePeer::doUpdate($a);        
        
        $solicitud = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $datos['solicitud']);  
        $solicitud = $solicitud;
		
	$tk=new SitTickets();
	$tk->setFechaSolicitud(date("d-m-Y"));
	$tk->setHoraSolicitud(date("G:i:s"));
	$tk->setIdSolicitante($idu);
	$tk->setIdUnidad($datos['idunidad']);
	$tk->setSolicitud($solicitud);
	$tk->setEstatus("n");
                
	if($tk->save()){
            
            $a=new Criteria();
            $a->addDescendingOrderByColumn('id_ticket');
            $ultimoticket=SitTicketsPeer::doSelect($a);
                            
            if(!empty($archivo1)){       
                $nombreArchivo1 = 'subido_'.$archivo1->getOriginalName();
                $extension1 = $archivo1->getExtension($archivo1->getOriginalExtension());
                $archivo1->save(sfConfig::get('sf_upload_dir').'/sit/01-'.$ultimoticket[0]->getIdTicket().$extension1);
            }
            
            if(!empty($archivo2)){       
                $nombreArchivo2 = 'subido_'.$archivo2->getOriginalName();
                $extension2 = $archivo2->getExtension($archivo2->getOriginalExtension());
                $archivo2->save(sfConfig::get('sf_upload_dir').'/sit/02-'.$ultimoticket[0]->getIdTicket().$extension2);
            }
            
     
            $guarda=0;
            if(!empty($archivo1) && !empty($archivo2)){ 
                $nombres='01-'.$ultimoticket[0]->getIdTicket().$extension1.','.'02-'.$ultimoticket[0]->getIdTicket().$extension2; $guarda=1;}
            else if(!empty($archivo1) && empty($archivo2)){
                $nombres='01-'.$ultimoticket[0]->getIdTicket().$extension1; $guarda=1;}
            else if(empty($archivo1) && !empty($archivo2)){
                $nombres='02-'.$ultimoticket[0]->getIdTicket().$extension2; $guarda=1;}
                
            if($guarda==1){
                $a=new Criteria ();
                $a->add(SitTicketsPeer::ID_TICKET,$ultimoticket[0]->getIdTicket());            
                $a->add(SitTicketsPeer::ARCHIVOS,$nombres);
                SitTicketsPeer::doUpdate($a); 
            }
                
            return "Se ha enviado el ticket correctamente"; 
            
        }
            else return false;              
    }
    
    public static function tickets_categorias($idtk,$idcat,$idsub){
            
        //echo $idtk.' '.$idcat.' '.$idsub;
            
        $a=new Criteria();
        $a->add(SitTicketsPeer::ID_TICKET,$idtk);
        $a->add(SitTicketsPeer::ID_CATEGORIA,$idcat);
        $a->add(SitTicketsPeer::ID_SUBCATEGORIA,$idsub);
        if(SitTicketsPeer::doUpdate($a)) return "Categoria asignada";
        else return "Operación inválida";
    }
    
    public static function guarda_comentario($idtk,$comentario,$id_u){
		
        $a=new SitComentarios();
	$a->setIdTicket($idtk);
	$a->setComentario($comentario);
	$a->setFecha(date("Y-m-d"));
	$a->setHora(date("G:m:s"));
	$a->setIdUsuario($id_u);
        if($a->save()) return "Comentario enviado"; 
        else return false;	
    }
    
    public static function asigna_ticket($idu,$idtk){
	        
        $a=new Criteria();
	$a->add(SitTicketsUsuariosPeer::ID_TICKET,$idtk);
	$existe=SitTicketsUsuariosPeer::doSelect($a);

	if(!isset($existe[0])){		
		
		$ut=new SitTicketsUsuarios();
		$ut->setIdUsuario($idu);
		$ut->setIdTicket($idtk);		
		if($ut->save()){
									
                        //cuando asigno actualizo el estado
			$a=new Criteria();
			$a->add(SitTicketsPeer::ID_TICKET,$idtk);
			$a->add(SitTicketsPeer::ESTATUS,'a');
			if(SitTicketsPeer::doUpdate($a))return "El ticket fue asignado correctamente";
                        else return false;
				
		} else return false;
			
	} else{
		$a=new Criteria();
		$a->add(SitTicketsUsuariosPeer::ID_TICKET,$idtk);
                $a->add(SitTicketsUsuariosPeer::ID_USUARIO,$idu);
		if(SitTicketsUsuariosPeer::doUpdate($a)){
                       
                        //cuando asigno actualizo el estado
			$a=new Criteria();
			$a->add(SitTicketsPeer::ID_TICKET,$idtk);
			$a->add(SitTicketsPeer::ESTATUS,'a');
			if(SitTicketsPeer::doUpdate($a))return "El ticket fue asignado a otro técnico";
                        else return false;
                    
                }else return false;
	}
    }
    
    public static function reasigna_ticket($idunidad,$idtk,$idu){
		
        $a=new Criteria();
	$a->add(SitTicketsPeer::ID_TICKET,$idtk);
	$a->add(SitTicketsPeer::ID_UNIDAD,$idunidad);
	$a->add(SitTicketsPeer::ID_CATEGORIA,null);
        $a->add(SitTicketsPeer::ID_SUBCATEGORIA,null);
        $a->add(SitTicketsPeer::ESTATUS,'r');
        $a->add(SitTicketsPeer::REASIGNADO,true);
	if(SitTicketsPeer::doUpdate($a)){
            
            $a = new SitTicketsReasignados;
            $a->setIdTicket($idtk);
            $a->setUserId($idu);
            if($a->save()) return "El ticket fue reasignado a otra unidad";
            else return false;
        } else return false;
		
    }
    
    public static function cerrar_ticket($idtk,$solucion){
	
        $solucion = str_replace(array("Á","É","Í","Ó","Ú"), array("á","é","í","ó","ú"), $solucion);  

        $a=new Criteria();
	$a->add(SitTicketsPeer::ID_TICKET,$idtk);
        $a->add(SitTicketsPeer::SOLUCION,$solucion);        
        $a->add(SitTicketsPeer::FECHA_SOLUCION,date("d-m-Y"));
        $a->add(SitTicketsPeer::HORA_SOLUCION,date("G:m:s"));
	$a->add(SitTicketsPeer::ESTATUS,'c');
	if(SitTicketsPeer::doUpdate($a)) return "El ticket ha sido cerrado"; 
        else return false;		
		
    }
        
} // SitTicketsPeer
