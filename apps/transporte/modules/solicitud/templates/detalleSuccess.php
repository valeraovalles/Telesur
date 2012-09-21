<div class="titulo_modulo">DETALLE DE SOLICITUD</div>
<?php 
    if ($solicitud->getEstatus()=='n') echo "<h1>SOLICITUD SIN ASIGNAR</h1>";
    else if ($solicitud->getEstatus()=='a'){
                
        $a=new Criteria();
        $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
        $a->addJoin(SfGuardUserProfilePeer::USER_ID,TraAsignacionesPeer::ID_CONDUCTOR);
        $ctor=SfGuardUserProfilePeer::doSelect($a);
                
        $a=new Criteria();
        $a->add(TraAsignacionesPeer::ID_SOLICITUD,$ids);
        $a->addJoin(TraVehiculosPeer::ID_VEHICULO,TraAsignacionesPeer::ID_VEHICULO);
        $vehiculo=TraVehiculosPeer::doSelect($a);
                
        echo "<h1>SOLICITUD ASIGNADA: <br>
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
                
        echo "<h1>SOLICITUD CERRADA: <br>
              CONDUTOR: (".ucfirst($ctor[0]->getNombre1().' '.$ctor[0]->getApellido1()).")<BR>
              VEHÍCULO: (".ucfirst($vehiculo[0]->getModelo()).")</h1> 
        ";
    }     
            
    else if ($solicitud->getEstatus()=='r'){
                
        echo "<h1 style='color:red;width:500px;'>SOLICITUD RECHAZADA: <br>Justificación: ".$solicitud->getJustificacionRechazo()."</h1>";
                
    }
    
    else if ($solicitud->getEstatus()=='ap'){
                
        echo "<h1 style='color:red;width:500px;'>SOLICITUD APROBADA: <br> Su solicitud fue aprobada.<h1>";
                
    }
?>
<br>

<table class="crud_form" cellpadding="5px" style="width: 450px;">

    <tr>
        <th>Fecha de solicitud:</th>
        <td><?php echo $solicitud->getFechaSolicitud("d-m-Y")?></td>
    </tr>
    
    <?php if($solicitud->getTipoSolicitud()=='t'){?>
    <tr>
        <th>Fecha de búsqueda:</th>
        <td><?php echo $solicitud->getFechaSalida("d-m-Y")?></td>
    </tr>

    <tr>
        <th>Hora de búsqueda:</th>
        <td><?php echo $solicitud->getHoraSalida()?></td>
    </tr>
    <?php }?>
    
    <tr>
        <th>Dirección de búsqueda:</th>
        <td><?php echo $solicitud->getDireccionTraslado()?></td>
    </tr>
    
    <tr>
        <th>Solicitud/Razón:</th>
        <td><?php echo $solicitud->getDatosInteresRazon()?></td>
    </tr>

    <?php if($solicitud->getTipoSolicitud()=='t'){?>
    <tr>
        <th>Equipos a trasladar:</th>
        <td><?php echo $solicitud->getDescripcionEquipos()?></td>
    </tr>
    <?php }?>
    
  
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
                        $departamento_i= TsurDependenciasPeer::retrieveByPK($usuario_i->getIdDependencia());

            ?>

                        <tr>
                            <td><?php echo $usuario_i->getNombre1()." ".$usuario_i->getNombre2()?></td>
                            <td><?php echo $usuario_i->getApellido1()." ".$usuario_i->getApellido2()?></td>
                            <td><?php echo $cargo_i->getDescripcion()?></td>
                            <td><?php echo $departamento_i->getDescripcion()?></td>
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

                        $usuario_e=  TraDatosExternosPeer::retrieveByPK($datos[0]);

            ?>

                        <tr>
                            <td><?php echo $usuario_e->getNombre()?></td>
                            <td><?php echo $usuario_e->getApellido()?></td>
                            <td><?php echo $usuario_e->getCedula()?></td>
                        </tr>




            <?php
                    } 
                }

                if(empty($usuario_e)) echo "<tr><td colspan=4 align=center>No se agregaron asistentes externos</td></tr>";
            ?>

                </table>            
<?php }?>

<div class="iconos">
<a href="<?php echo url_for('solicitud/estatus')?>"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>