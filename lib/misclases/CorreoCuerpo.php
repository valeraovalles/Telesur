
<?php
class CorreoCuerpo {

    public function SitSolicitud($solicitante,$extension,$solicitud,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='600px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>

                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='color:#383838;'>TICKET NUEVO</th>                                    
                    </tr>

                    <tr style='background-color:white;'>
                        <th  align=right width=100px style='background-color:#E7EEF6;color:#494949;'>Solicitante:</th>
                        <td  align=left>".ucfirst($solicitante)."</td>
                    </tr>

                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Extensi&oacute;n:</th>
                        <td  align=left>".$extension."</td>
                    </tr>

                    <tr style='background-color:white;'>
                        <th align=right style='background-color:#E7EEF6;color:#494949;'>Evento:</th>
                        <td  align=left>".ucfirst(utf8_decode($solicitud))."</td>
                    </tr>
                 </table>
             </div>
                                    
	";

         $f=new funciones();
         $f->correo($cuerpo, array($correo),"Sit-Solicitud","Sit <sit@telesurtv.net>");
        
            
    }
    
    public function SitAsignado($solicitante,$ticket,$correo)
    {
        $subcategoria=  SitSubcategoriasPeer::retrieveByPK($ticket->getIdSubcategoria());
        $unidad= SitUnidadesPeer::retrieveByPK($ticket->getIdUnidad());
        
        //CORREO AL TECNICO
        $cuerpo="
            <div align=center>
            <table width='600px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                            
                <tr style='background-color:white;'>
                    <th colspan=2 align=center style='color:#383838;'>TICKET ASIGNADO</th>                                    
                </tr>
                                
                <tr style='background-color:white;'>
                    <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Solicitante:</th>
                    <td  align=left>".ucfirst($solicitante->getNombre1()).' '.ucfirst($solicitante->getApellido1())."</td>
                </tr>
                                
                <tr style='background-color:white;'>
                    <th  align=right style='background-color:#E7EEF6;color:#494949;'>Extensi&oacute;n:</th>
                    <td  align=left>".$solicitante->getExtension()."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th  align=right style='background-color:#E7EEF6;color:#494949;'>Fecha solicitud:</th>
                    <td  align=left>".$ticket->getFechaSolicitud('d-m-Y')."</td>
                </tr>
                                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Evento:</th>
                    <td  align=left>".ucfirst(utf8_decode($ticket->getSolicitud()))."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Categoria:</th>
                    <td  align=left>".ucfirst(utf8_decode($subcategoria->getDescripcion()))."</td>
                </tr>
            </table>
            </div>
	";

         $f=new funciones();
         $f->correo($cuerpo, array($correo),"Sit-Asignacion","Sit <sit@telesurtv.net>");
         
         
        $solicitante_user=  sfGuardUserPeer::retrieveByPK($ticket->getIdSolicitante()); 
         
        //CORREO AL USUARIO
        $cuerpo="
            <div align=center>
            <table width='600px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                            
                <tr style='background-color:white;'>
                    <th colspan=2 align=center style='color:#383838;'>SOLICITUD DE SOPORTE T&Eacute;CNICO</th>                                    
                </tr>
                                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Evento:</th>
                    <td  align=left>".ucfirst(utf8_decode($ticket->getSolicitud()))."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Estatus:</th>
                    <td  align=left>Su ticket esta siendo atendido por un t&eacute;cnico de la unidad de ".$unidad->getDescripcion()."</td>
                </tr>
                
            </table>
            </div>
            
	";

         $f=new funciones();
         $f->correo($cuerpo, array($solicitante_user->getUsername().'@telesurtv.net'),"Sit-Informacion","Sit <sit@telesurtv.net>");
            
    }
    
    public function SitCerrado($solicitante,$ticket,$solucion,$correo)
    {
        $unidad= SitUnidadesPeer::retrieveByPK($ticket->getIdUnidad());
        
        //CORREO AL TECNICO
        $cuerpo="
            <div align=center>
            <table width='600px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                            
                <tr style='background-color:white;'>
                    <th colspan=2 align=center style='color:#383838;'>TICKET CERRADO</th>                                    
                </tr>
           
                <tr style='background-color:white;'>
                    <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha solicitud:</th>
                    <td  align=left>".$ticket->getFechaSolicitud('d-m-Y')."</td>
                </tr>
                     
                <tr style='background-color:white;'>
                    <th  align=right style='background-color:#E7EEF6;color:#494949;'>Fecha soluci&oacute;n:</th>
                    <td  align=left>".date('d-m-Y')."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora soluci&oacute;n:</th>
                    <td  align=left>".date('G:i:s')."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud:</th>
                    <td  align=left>".ucfirst(utf8_decode($ticket->getSolicitud()))."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Soluci&oacute;n:</th>
                    <td  align=left>".ucfirst(utf8_decode($solucion))."</td>
                </tr>
                
                <tr style='background-color:white;'>
                    <th align=right style='background-color:#E7EEF6;color:#494949;'>Estatus:</th>
                    <td  align=left>Su ticket fue atendido por la unidad de ".$unidad->getDescripcion()."</td>
                </tr>
                

            </table>
            </div>
	";

         $f=new funciones();
         //$f->correo($cuerpo, $correo,"Sit-Cierre","Sit <sit@telesurtv.net>");
         $f->correo($cuerpo, array($unidad->getCorreo(),$correo),"Sit-Cierre","Sit <sit@telesurtv.net>");
    }
    
    public function TransporteSolicitud($solicitante,$datos)
    {
        
        if($datos['tipo_transporte']=='c')$dir="transportetr"; else $dir="transporteco";
        
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='color:#383838;'>SOLICITUD DE TRASLADO</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Solicitante:</th>
                        <td  align=left>".ucfirst($solicitante)."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos['fecha_salida']."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos['hora_salida']['hour'].':'.$datos['hora_salida']['minute']."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos['direccion_traslado'])."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos['datos_interes_razon'])."</td>
                    </tr>
             
                </table>
                <br><br>
                            
                <div>Para ver esta solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/gestion/".$dir."'>aqu&iacute;</a></div>
            </div>
                                    
	";
        
         
         $f=new funciones();
         
         /*if($datos['tipo_transporte']=='c')
         $f->correo($cuerpo, array('transporte@telesurtv.net'),"Transporte-Solicitud","Transporte <transporte@telesurtv.net>");
         
         else
         $f->correo($cuerpo, array('rbencomo@telesurtv.net','jlinero@telesurtv.net'),"Transporte-Solicitud","Transporte <transporte@telesurtv.net>");*/
    }    
    
    public function TransporteAsignar($datos,$correo)
    {
        
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>CONDUCTOR ASIGNADO</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos->getFechaSalida('d-m-Y')."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos->getHoraSalida('G:i:s')."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
             
                </table>
                <br><br>
                            
                <div>Para ver el conductor asignado ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Transporte-Asignación"),"Transporte <transporte@telesurtv.net>");
    }
    
    public function TransporteAprobar($datos,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>SOLICITUD APROBADA, DEBE ESPERAR LA ASIGNACI&Oacute;N DEL CONDUCTOR</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos->getFechaSalida('d-m-Y')."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos->getHoraSalida('G:i:s')."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
             
                </table>
                <br><br>
                            
                <div>Para ver su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Transporte-Aprobación"),"Transporte <transporte@telesurtv.net>");
    }
    
    public function TransporteRechazo($datos,$correo,$justificacion)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:red;'>SOLICITUD RECHAZADA</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos->getFechaSalida('d-m-Y')."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos->getHoraSalida('G:i:s')."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
                    
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:red;'>Justificaci&oacute;n:</th>
                        <td  align=left>".utf8_decode($justificacion)."</td>
                    </tr>     
             
                </table>
                <br><br>
                            
                <div>Para ver su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

        // $f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Transporte-Rechazo"),"Transporte <transporte@telesurtv.net>");
    }
    
     public function TransporteCierreJustificado($datos,$correo,$justificacion)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:red;'>SOLICITUD CERRADA</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos->getFechaSalida('d-m-Y')."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos->getHoraSalida('G:i:s')."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
                    
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:red;'>Justificaci&oacute;n:</th>
                        <td  align=left>".utf8_decode($justificacion)."</td>
                    </tr>     
             
                </table>
                <br><br>
                            
                <div>Para ver su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Transporte-Cierre-Justificado"),"Transporte <transporte@telesurtv.net>");
    }
    
    public function TransporteCerrado($datos,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>SU SOLICITUD SE HA REALIZADO CON EXITO</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Fecha B&uacute;squeda:</th>
                        <td  align=left>".$datos->getFechaSalida('d-m-Y')."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Hora Salida:</th>
                        <td  align=left>".$datos->getHoraSalida('G:i:s')."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                   
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Raz&oacute;n traslado:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
                 
             
                </table>
                <br><br>
                            
                <div>Para ver los datos de su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Transporte-Solicitud-Culminada"),"Transporte <transporte@telesurtv.net>");
    }
    
    public function CorrespondenciaSolicitud($solicitante,$datos)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>SOLICITUD CORRESPONDENCIA</th>                                    
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right width=200px style='background-color:#E7EEF6;color:#494949;'>Solicitante:</th>
                        <td  align=left>".$solicitante."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud/Raz&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos['datos_interes_razon'])."</td>
                    </tr>
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n de b&uacute;squeda:</th>
                        <td  align=left>".utf8_decode($datos['direccion_traslado'])."</td>
                    </tr>              
             
                </table>
                <br><br>
                            
                <div>Para ver los datos de la solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/gestion'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array('rbencomo@telesurtv.net','jlinero@telesurtv.net'),"Transporte-Solicitud","Transporte <transporte@telesurtv.net>");
         
    }
    
    public function CorrespondenciaAsignar($datos,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>CONDUCTOR ASIGNADO A SU SOLICITUD</th>                                    
                    </tr>
                    
                    <tr style='background-color:white;'>
                        <th width='200px'  align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud/Raz&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
             
                               
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>                                

                </table>
                <br><br>
                            
                <div>Para ver el conductor asignado ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Correspondencia-Asignación"),"Correspondencia <transporte@telesurtv.net>");
    }
    
    public function CorrespondenciaAprobar($datos,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>SOLICITUD APROBADA, DEBE ESPERAR LA ASIGNACI&Oacute;N DEL CONDUCTOR</th>                                    
                    </tr>
                    
                    <tr style='background-color:white;'>
                        <th width='200px' align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud/Raz&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
                                
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>                        
             
                </table>
                <br><br>
                            
                <div>Para ver su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Correspondencia-Aprobación"),"Correspondencia <transporte@telesurtv.net>");
    }
    
    public function CorrespondenciaRechazo($datos,$correo,$justificacion)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:red;'>SOLICITUD RECHAZADA</th>                                    
                    </tr>

                    <tr style='background-color:white;'>
                        <th width='200px'  align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud/Raz&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>

                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>                           
                    
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:red;'>Justificaci&oacute;n:</th>
                        <td  align=left>".utf8_decode($justificacion)."</td>
                    </tr>     
             
                </table>
                <br><br>
                            
                <div>Para ver su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Correspondencia-Rechazo"),"Correspondencia <transporte@telesurtv.net>");
    }
    
    public function CorrespondenciaCerrado($datos,$correo)
    {
        $cuerpo="
            <div align=center>
                <table width='700px'cellpadding='10px' cellspacing='1' style='background-color:gray;'>
                           
                    <tr style='background-color:white;'>
                        <th colspan=2 align=center style='background-color:#E7EEF6;color:#383838;'>SU SOLICITUD SE HA REALIZADO CON EXITO</th>                                    
                    </tr>

                    <tr style='background-color:white;'>
                        <th width='200px'  align=right style='background-color:#E7EEF6;color:#494949;'>Solicitud/Raz&oacute;n:</th>
                        <td align=left>".utf8_decode($datos->getDatosInteresRazon())."</td>
                    </tr>
                    
                    <tr style='background-color:white;'>
                        <th  align=right style='background-color:#E7EEF6;color:#494949;'>Direcci&oacute;n:</th>
                        <td  align=left>".utf8_decode($datos->getDireccionTraslado())."</td>
                    </tr>
                 
             
                </table>
                <br><br>
                            
                <div>Para ver los datos de su solicitud ingrese <a href='http://aplicativos.telesurtv.net/Telesur/web/transporte.php/solicitud/detalle/ids/".$datos->getIdSolicitud()."'>aqu&iacute;</a></div>
            </div>
                                    
	";

         //$f=new funciones();
         //$f->correo($cuerpo, array($correo),utf8_decode("Correspondencia-Solicitud-Culminada"),"Correspondencia <transporte@telesurtv.net>");
    }
    
}
?>
