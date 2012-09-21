<div class="titulo_modulo">
    
        ASIGNACIÓN DE TRANSPORTE 
        <?php 
        
            if ($solicitud->getEstatus()=='n') echo "<br><h1>SOLICITUD SIN ASIGNAR</h1>";
            else if ($solicitud->getEstatus()=='a'){
                
                $a=new Criteria();
                $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
                $a->addJoin(SfGuardUserProfilePeer::USER_ID,TraAsignacionesPeer::ID_CONDUCTOR);
                $ctor=SfGuardUserProfilePeer::doSelect($a);
                
                
                $a=new Criteria();
                $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
                $a->addJoin(TraVehiculosPeer::ID_VEHICULO,TraAsignacionesPeer::ID_VEHICULO);
                $vehiculo=TraVehiculosPeer::doSelect($a);
                
                echo "<br><h1>SOLICITUD ASIGNADA: <br>
                      CONDUTOR: (".ucfirst($ctor[0]->getNombre1().' '.$ctor[0]->getApellido1()).")<BR>
                      VEHÍCULO: (".ucfirst($vehiculo[0]->getModelo()).")</h1> 

                ";
            }
            else if ($solicitud->getEstatus()=='c'){
                
                $a=new Criteria();
                $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
                $a->addJoin(SfGuardUserProfilePeer::USER_ID,TraAsignacionesPeer::ID_CONDUCTOR);
                $ctor=SfGuardUserProfilePeer::doSelect($a);
                
                
                $a=new Criteria();
                $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
                $a->addJoin(TraVehiculosPeer::ID_VEHICULO,TraAsignacionesPeer::ID_VEHICULO);
                $vehiculo=TraVehiculosPeer::doSelect($a);
                
                echo "<br><h1>SOLICITUD CERRADA: <br>
                      CONDUTOR: (".ucfirst($ctor[0]->getNombre1().' '.$ctor[0]->getApellido1()).")<BR>
                      VEHÍCULO: (".ucfirst($vehiculo[0]->getModelo()).")</h1> 

                ";
            }     
            
            else if ($solicitud->getEstatus()=='r'){
                
                echo "<br><h1 style='color:red;width:500px;'>SOLICITUD RECHAZADA: <br>".$solicitud->getJustificacionRechazo()."<h1>";
                
            }
            
            else if ($solicitud->getEstatus()=='ap'){
                
                echo "<br><h1 style='color:red;width:500px;'>SOLICITUD APROBADA: <br> Se ha informado al usuario que su solicitud fue aprobada y debe esperar la asignación de transporte.<h1>";
                
            }
        ?>
</div>

<?php if($sf_user->getFlash('sms')){?>
<div class="sms"><?php echo $sf_user->getFlash('sms')?></div>
<?php }?>	


<div style="background-color:#696A6A;color:white;font-weight: bold;border:1px;cursor:pointer;" class="ocultasolicitud">DATOS DE LA SOLICITUD (Mostrar / Ocultar)</div>
<div id="solicitud">

        <br><br>
        <table class="crud_form" cellpadding="5px" style="width: 450px;">
            
            <tr>
                <th>Solicitante:</th>
                <td><?php echo ucwords($profile->getNombre1()." ".$profile->getApellido1())?></td>
            </tr>

            <tr>
                <th>Fecha de solicitud:</th>
                <td><?php echo $solicitud->getFechaSolicitud("d-m-Y")?></td>
            </tr>

            <tr>
                <th>Fecha de búsqueda:</th>
                <td><?php echo $solicitud->getFechaSalida("d-m-Y")?></td>
            </tr>

            <tr>
                <th>Hora de búsqueda:</th>
                <td><?php echo $solicitud->getHoraSalida()?></td>
            </tr>

                <tr>
                <th>Dirección Desde/Hasta:</th>
                <td><?php echo $solicitud->getDireccionTraslado()?></td>
            </tr>

            <?php if($solicitud->getTipoSolicitud()=='t'){?>
            <tr>
                <th>Equipos a trasladar:</th>
                <td><?php echo $solicitud->getDescripcionEquipos()?></td>
            </tr>
            <?php }?>

            <tr>
                <th>Razón/Otros datos:</th>
                <td><?php echo $solicitud->getDatosInteresRazon()?></td>
            </tr>

            <?php if($solicitud->getTipoSolicitud()=='t'){?>
            <tr>
                <th>Cantidad a trasladar:</th>
                <td><?php $lista = explode(",",$solicitud->getAsistentes()); echo count($lista)?></td>
            </tr>
            <?php }?>



        </table>

        <br>

        <?php if($solicitud->getTipoSolicitud()=='t'){?>
            <h1>LISTA DE ASISTENTES INTERNOS</h1>

            <table class="tabla_list">
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cargo</th>
                    <th>Dirección</th>
                </tr>

            <?php

                $lista = explode(",",$solicitud->getAsistentes());

                foreach ($lista as $l) {
                    $datos = explode("-",$l);

                    if($datos[1]=='i'){

                        $usuario_i=SfGuardUserProfilePeer::retrieveByPK($datos[0]);
                        $cargo_i=  TsurCargosPeer::retrieveByPK($usuario_i->getIdCargo());
                        $dependencias_i= TsurDependenciasPeer::retrieveByPK($usuario_i->getIdDependencia());

            ?>

                        <tr>
                            <td><?php echo $usuario_i->getNombre1()." ".$usuario_i->getNombre2()?></td>
                            <td><?php echo $usuario_i->getApellido1()." ".$usuario_i->getApellido2()?></td>
                            <td><?php echo $cargo_i->getDescripcion()?></td>
                            <td><?php echo $dependencias_i->getDescripcion()?></td>
                        </tr>




            <?php
                    } 
                }

                if(empty($usuario_i)) echo "<tr><td colspan=4 align=center>No se agregaron asistentes internos</td></tr>";
            ?>

            </table>

            <br>

            <h1>LISTA DE ASISTENTES EXTERNOS</h1>


                <table class="tabla_list" >
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cedula/Pasaporte</th>
                </tr>

            <?php

                $lista = explode(",",$solicitud->getAsistentes());

                foreach ($lista as $l) {
                    $datos = explode("-",$l);

                    if($datos[1]=='e'){

                        $usuario_e=  TraPersonasExternasPeer::retrieveByPK($datos[0]);

            ?>

                        <tr>
                            <td><?php echo $usuario_e->getNombres()?></td>
                            <td><?php echo $usuario_e->getApellidos()?></td>
                            <td><?php echo $usuario_e->getCedula()?></td>
                        </tr>




            <?php
                    } 
                }

                if(empty($usuario_e)) echo "<tr><td colspan=3 align=center>No se agregaron asistentes externos</td></tr>";
            ?>

                </table>            
        <?php }?>   
        
</div>




<br>





<?php if($solicitud->getEstatus()!='r' && $solicitud->getEstatus()!='c'){?>
    <div style="background-color:#696A6A;color:white;font-weight: bold;cursor:pointer;" class="ocultaadmin">ADMINISTRAR SOLICITUD (Mostrar / Ocultar)</div>

    <br>


    <div id="admin">
    
    <form action="<?php echo url_for("gestion/asignartransporteco?ids=".$ids)?>" method="post" name="form">

    <div>Seleccione una opción: <?php echo $form['opcion'];?></div>
 
    <?php if($opcion=='asignar'){?>

        <br><br>
        <table class="crud_form select200" cellpadding="5px" style="width: 450px;">

            <tr>
                <th>Asignar Conductor:</th>
                <td>
                    <select name="conductor">
                        <option value=""></option>
                    <?php foreach ($conductores as $ct) {?>

                        <option value="<?php echo $ct->getUserId()?>"><?php echo $ct->getNombre1().' '.$ct->getApellido1(); ?></option>

                    <?php }?>

                </select>
                </td>
            </tr>

         
            <tr>
                <th>Asignar Transporte:</th>
                <td>
                    <select  name="vehiculo">
                        <option value=""></option>
                    <?php foreach ($transportes as $tp) {?>

                        <option value="<?php echo $tp->getIdVehiculo()?>"><?php echo $tp->getModelo()?></option>

                    <?php }?>

                </select>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="button" id="boton" value="Asignar" onclick="enviar_formulario('Asignar conductor y transporte')">
                </td>
            </tr>
        </table>
       
    <?php } else if ($opcion=='rechazar'){?>
    
        <br><br>
        <table class="crud_form" cellpadding="5px" style="width: 450px;">
            <tr><th>Justifique</th><td><textarea name="justificacion"></textarea></td></tr>
            <tr><td colspan="2" style="text-align: center;"><input type="button" value="Rechazar" id="boton" onclick="enviar_formulario('Rechazar solicitud')"></td></tr>
        </table>
    
    <?php } else if ($opcion=='aprobar'){?>
    
        <br><br>
        <table class="crud_form" cellpadding="5px" style="width: 450px;">
            <tr>
                <th>Aprobar solicitud:</th>
                <td>
                    <input type="button" value="Aprobar" id="boton"  onclick="enviar_formulario('Aprobar solicitud')">
                </td>
            </tr>            
        </table>
        
    <?php }else if($opcion=='cerrar'){?>
    
        <br><br>
        <table class="crud_form" cellpadding="5px" style="width: 450px;">
            <tr>
                <th>Cerrar solicitud</th>
                <td>
                    <input type="button" value="Cerrar" id="boton"  onclick="enviar_formulario('Cerrar solicitud')">
                </td>
            </tr>            
        </table>
    
    <?php }?>
        
        
    <input type="hidden" name="accion" id="accion" value="">
    </form>
    
    </div>
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('gestion/transporteco')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>


    

<?php if($solicitud->getEstatus()!='r' && $solicitud->getEstatus()!='c'){?>
<script type="text/javascript">

jQuery(document).ready(function  (){

	jQuery("#solicitud").hide();

    });
</script>
<?php }?>

<script type="text/javascript">
jQuery("div.ocultasolicitud").click(function  (){

	jQuery("#solicitud").delay(200).slideToggle();

    });
    
jQuery("div.ocultaadmin").click(function  (){

	jQuery("#admin").delay(200).slideToggle(); 
	
    });



</script>