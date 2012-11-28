<div class="titulo_modulo">SINCRONIZAR SIGEFIRRHH CON TELESUR</div>

<?php
//CONEXIONES A BASEDE DATOS///////////////////////////////////////////////////
$conexion=new ConexionDirecta();
$postgresql_local=$conexion->postgresql_local();
$postgresql_sigefirrhh=$conexion->postgresql_sigefirrhh();
////////////////////////////////////////////////////////////////////////////////

//revisa si el username ya existe en caso contrario devuelve null///////////////
function buscar_usuario($usr){
	
        $a = new Criteria();
        $a->add(sfGuardUserPeer::USERNAME,$usr);
        $usuario=sfGuardUserPeer::doSelect($a);
       
        if(isset($usuario[0]))
            return true;
        
        else return false;
        
}
////////////////////////////////////////////////////////////////////////////////

//devuelve usuario si este posee cuenta de correo///////////////////////////////
function BuscaUID($cedula){
		
	$ds = ldap_connect("192.168.3.5") or die ("No se pudo establecer coneccion con el servidor");
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	$sr=ldap_search($ds,"ou=Personas, dc=telesur", "telephonenumber=".$cedula);	
    $info = ldap_get_entries($ds, $sr);

        if (isset($info[0]['uid'][0]))
         return strtolower(trim($info[0]['uid'][0]));
        else return null;
}
////////////////////////////////////////////////////////////////////////////////

//si no tiene correo genero un usuario//////////////////////////////////////////
function generarUSR($n,$a){

	$usr=$n[0].$a;	
	$username=buscar_usuario($usr);
	
	if($username==true){
		
		$usr=$n[0].$n[1].$a;
		$username=buscar_usuario($usr);
		
		
		if($username==true){
			
			$usr=$n[0].$n[1].$n[2].$a;
			$username=buscar_usuario($usr);	
                        
                        if($username==true){
                            
                            $usr=$n[0].$n[1].$n[2].$n[3].$a;
                            
                        }
                        
		}		
	}
	
	return $usr;
}
////////////////////////////////////////////////////////////////////////////////
	
//INSERTO CARGOS////////////////////////////////////////////////////////////////

$query = "select * from cargo order by id_cargo";
$rs = pg_query($postgresql_sigefirrhh, $query);
	
$cargos_insertados=0;
$cargos_actualizados=0;
	
while($row = pg_fetch_array($rs)){

    $id_cargo=$row['id_cargo'];
    $descripcion_cargo=$row['descripcion_cargo'];
    
    
    $query="select id_cargo from tsur_cargos where id_cargo='".$id_cargo."'";
    $rs2=pg_query($postgresql_local,$query);
    $row2=pg_fetch_array($rs2);
    
    if(!isset($row2['id_cargo'])){	

        $query="insert into tsur_cargos (id_cargo,descripcion) values (".$id_cargo.",'".$descripcion_cargo."')";
	if(pg_query($postgresql_local,$query))$cargos_insertados++;

    }	
		
    else{
			
        $query="update tsur_cargos set descripcion='".$descripcion_cargo."' where id_cargo='".$id_cargo."'";
        if(pg_query($postgresql_local,$query))$cargos_actualizados++;
			
    }
}

echo "<br>Cargos insertados: ".$cargos_insertados."<br>";
echo "Cargos actualizados: ".$cargos_actualizados."<br>";
////////////////////////////////////////////////////////////////////////////////

//INSERTO DEPENDENCIAS//////////////////////////////////////////////////////////

$query = "select * from dependencia order by id_dependencia";
$rs = pg_query($postgresql_sigefirrhh, $query);
	
$dependencias_insertadas=0;
$dependencias_actualizadas=0;

while($row = pg_fetch_array($rs)){

    $id_dependencia=$row['id_dependencia'];
    $descripcion_dependencia=$row['nombre'];
    
    
    $query="select id_dependencia from tsur_dependencias where id_dependencia='".$id_dependencia."'";
    $rs2=pg_query($postgresql_local,$query);
    $row2=pg_fetch_array($rs2);
    
    if(!isset($row2['id_dependencia'])){	

        $query="insert into tsur_dependencias (id_dependencia,descripcion) values (".$id_dependencia.",'".$descripcion_dependencia."')";
	if(pg_query($postgresql_local,$query))$dependencias_insertadas++;

    }	
		
    else{
			
        $query="update tsur_dependencias set descripcion='".$descripcion_dependencia."' where id_dependencia='".$id_dependencia."'";
        if(pg_query($postgresql_local,$query))$dependencias_actualizadas++;
			
    }
}

echo "<br>Dependencias insertadas: ".$dependencias_insertadas."<br>";
echo "Dependencias actualizadas: ".$dependencias_actualizadas."<br>";
////////////////////////////////////////////////////////////////////////////////

//EXTRAER DATOS DE SIGEFIRRHH CON LDAP HE INSERTARLOS EN TELESUR////////////////
$query="select * from trabajador t,personal p where t.id_personal=p.id_personal and t.estatus='A' order by t.fecha_ingreso ASC";
$rs = pg_query($postgresql_sigefirrhh,$query);
		  



$cont=0;
$trabajadores_ldapUser_insertados=0;
$trabajadores_ldapProfile_insertados=0;
$trabajadores_ldapProfile_actualizados=0;
while( $row = pg_fetch_array($rs)){  
    
    $cedula = strtoupper(trim($row['cedula']));
    
    //busco si tiene cuenta ldap
    $usr_ldap=BuscaUID($cedula);    
    
    //si el usuario tiene ldap
    if($usr_ldap!=null){

        //verifico si el usuario ya está insertado en Telesur
        $existe_usuario_Telesur=buscar_usuario($usr_ldap);
        
        if($existe_usuario_Telesur==false){
    
                $user = new sfGuardUser();
                $user->setId(null);
                $user->setUsername(strtolower(trim($usr_ldap)));
                $user->setPassword("");
                if($user->save()){

                    $trabajadores_ldapUser_insertados++;

                    $a = new Criteria();
                    $a->addDescendingOrderByColumn("id");
                    $ultimo_usuario=sfGuardUserPeer::doSelect($a);

                    $profile = new SfGuardUserProfile;
                    $profile->setUserId($ultimo_usuario[0]->getId());
                    $profile->setNombre1(strtolower($row['primer_nombre']));
                    $profile->setNombre2(strtolower($row['segundo_nombre']));
                    $profile->setApellido1(strtolower($row['primer_apellido']));
                    $profile->setApellido2(strtolower($row['segundo_apellido']));
                    //$profile->setCedula($cedula);
                    $profile->setIdCargo($row['id_cargo']);
                    $profile->setIdDependencia($row['id_dependencia']);
                    $profile->setFechaNacimiento($row['fecha_nacimiento']);
                    $profile->setFechaIngreso($row['fecha_ingreso']);            
                    $profile->setSexo(strtolower($row['sexo']));   
                    $profile->setNacionalidad(strtolower($row['nacionalidad']));  
                    if($profile->save())$trabajadores_ldapProfile_insertados++;          

                } 
            } else if($existe_usuario_Telesur==true){
                
                    //busco el id del usuario a actualizar
                    $a = new Criteria();
                    $a->add(sfGuardUserPeer::USERNAME,$usr_ldap);
                    $usuario=sfGuardUserPeer::doselect($a);
                
                    $profile = new Criteria();
                    $profile->add(SfGuardUserProfilePeer::USER_ID,$usuario[0]->getId());
                    $profile->add(SfGuardUserProfilePeer::NOMBRE1,strtolower($row['primer_nombre']));
                    $profile->add(SfGuardUserProfilePeer::NOMBRE2,strtolower($row['segundo_nombre']));
                    $profile->add(SfGuardUserProfilePeer::APELLIDO1,strtolower($row['primer_apellido']));
                    $profile->add(SfGuardUserProfilePeer::APELLIDO2,strtolower($row['segundo_apellido']));
                    $profile->add(SfGuardUserProfilePeer::CEDULA,$cedula);
                    $profile->add(SfGuardUserProfilePeer::ID_CARGO,strtolower($row['id_cargo']));
                    $profile->add(SfGuardUserProfilePeer::ID_DEPENDENCIA,strtolower($row['id_dependencia']));
                    $profile->add(SfGuardUserProfilePeer::FECHA_NACIMIENTO,strtolower($row['fecha_nacimiento']));
                    $profile->add(SfGuardUserProfilePeer::FECHA_INGRESO,strtolower($row['fecha_ingreso']));
                    $profile->add(SfGuardUserProfilePeer::SEXO,strtolower($row['sexo']));
                    $profile->add(SfGuardUserProfilePeer::NACIONALIDAD,strtolower($row['nacionalidad']));
                    if(SfGuardUserProfilePeer::doUpdate($profile))$trabajadores_ldapProfile_actualizados++;
            }
        }
        
        else{
        //guardo los usuarios sin ldap
        $trabajadores_sin_ldap[$cont]=$row;} 

        $cont++;
}

echo "<br>Trabajadores con ldap insertados en user: ".$trabajadores_ldapUser_insertados."<br>";
echo "Trabajadores con ldap insertados en profile: ".$trabajadores_ldapProfile_insertados."<br>";
echo "<br>Trabajadores con ldap actualizados en profile: ".$trabajadores_ldapProfile_actualizados."<br>";
//echo "<br>Trabajadores sin ldap calculados ".count($trabajadores_sin_ldap)."<br>";
////////////////////////////////////////////////////////////////////////////////

//GUARDAR USUARIOS SIN LDAP EN TELESUR//////////////////////////////////////////
$trabajadores_sinldapUser_insertados=0;
$trabajadores_sinldapProfile_insertados=0;
$trabajadores_sinldapProfile_actualizados=0;
foreach ($trabajadores_sin_ldap as $tse) {
    
    $a = new Criteria();
    $a->add(SfGuardUserProfilePeer::CEDULA,$tse['cedula']);
    $existe_en_profile=SfGuardUserProfilePeer::doSelect($a);
    
    if(!isset($existe_en_profile[0])){
        
        //genero un usuario
        $usuario_generado=generarUSR(strtolower($tse['primer_nombre']),strtolower($tse['primer_apellido']));
    
        $user = new sfGuardUser();
        $user->setId(null);
        $user->setUsername(strtolower(trim($usuario_generado)));
        $user->setPassword(strtoupper(trim($tse['cedula'])));
        if($user->save()){

                $trabajadores_sinldapUser_insertados++;

                $a = new Criteria();
                $a->addDescendingOrderByColumn("id");
                $ultimo_usuario=sfGuardUserPeer::doSelect($a);

                $profile = new SfGuardUserProfile;
                $profile->setUserId($ultimo_usuario[0]->getId());
                $profile->setNombre1(strtolower($tse['primer_nombre']));
                $profile->setNombre2(strtolower($tse['segundo_nombre']));
                $profile->setApellido1(strtolower($tse['primer_apellido']));
                $profile->setApellido2(strtolower($tse['segundo_apellido']));
                $profile->setCedula(strtoupper(trim($tse['cedula'])));
                $profile->setIdCargo($tse['id_cargo']);
                $profile->setIdDependencia($tse['id_dependencia']);
                $profile->setFechaNacimiento($tse['fecha_nacimiento']);
                $profile->setFechaIngreso($tse['fecha_ingreso']);            
                $profile->setSexo(strtolower($tse['sexo']));   
                $profile->setNacionalidad(strtolower($tse['nacionalidad']));  
                if($profile->save())$trabajadores_sinldapProfile_insertados++;      
      }
    }
    
    else if(isset($existe_en_profile[0])){
        
                 //busco el id del usuario a actualizar
                 $a = new Criteria();
                 $a->add(SfGuardUserProfilePeer::CEDULA,$tse['cedula']);
                 $usuario=SfGuardUserProfilePeer::doselect($a);
                
                 $profile = new Criteria();
                 $profile->add(SfGuardUserProfilePeer::USER_ID,$usuario[0]->getUserId());
                 $profile->add(SfGuardUserProfilePeer::NOMBRE1,strtolower($tse['primer_nombre']));
                 $profile->add(SfGuardUserProfilePeer::NOMBRE2,strtolower($tse['segundo_nombre']));
                 $profile->add(SfGuardUserProfilePeer::APELLIDO1,strtolower($tse['primer_apellido']));
                 $profile->add(SfGuardUserProfilePeer::APELLIDO2,strtolower($tse['segundo_apellido']));
                 $profile->add(SfGuardUserProfilePeer::CEDULA,strtoupper(trim($tse['cedula'])));
                 $profile->add(SfGuardUserProfilePeer::ID_CARGO,strtolower($tse['id_cargo']));
                 $profile->add(SfGuardUserProfilePeer::ID_DEPENDENCIA,strtolower($tse['id_dependencia']));
                 $profile->add(SfGuardUserProfilePeer::FECHA_NACIMIENTO,strtolower($tse['fecha_nacimiento']));
                 $profile->add(SfGuardUserProfilePeer::FECHA_INGRESO,strtolower($tse['fecha_ingreso']));
                 $profile->add(SfGuardUserProfilePeer::SEXO,strtolower($tse['sexo']));
                 $profile->add(SfGuardUserProfilePeer::NACIONALIDAD,strtolower($tse['nacionalidad']));
                 if(SfGuardUserProfilePeer::doUpdate($profile))$trabajadores_sinldapProfile_actualizados++;        
    } 
}

echo "<br>Trabajadores sin ldap insertados en user: ".$trabajadores_sinldapUser_insertados."<br>";
echo "Trabajadores sin ldap insertados en profile: ".$trabajadores_sinldapProfile_insertados."<br>";
echo "<br>Trabajadores sin ldap actualizados en profile: ".$trabajadores_sinldapProfile_actualizados."<br>";
////////////////////////////////////////////////////////////////////////////////

//BORRAR USUARIOS EGRESADOS/////////////////////////////////////////////////////

/*$usuarios_telesur=  SfGuardUserProfilePeer::doSelect(new Criteria());

$usuarios_eliminados_user=0;
$usuarios_eliminados_profile=0;
foreach ($usuarios_telesur as $ut) {
    
    $query="select t.cedula from trabajador t,personal p where t.cedula='".$ut->getCedula()."' and t.id_personal=p.id_personal and t.estatus='A'";
    $rs = pg_query($postgresql_sigefirrhh,$query);
    $row = pg_fetch_array($rs);
    
    if(!isset($row['cedula'])){
        
        $a = new Criteria();
        $a->add(SfGuardUserProfilePeer::USER_ID,$ut->getUserId());
        if(SfGuardUserProfilePeer::doDelete($a)){
            
            $usuarios_eliminados_user++;          
             
            $a = new Criteria();
            $a->add(SfGuardUserPeer::ID,$ut->getUserId());
            if(SfGuardUserPeer::doDelete($a))$usuarios_eliminados_profile++;
        }
    }
    
}
echo "<br>Trabajadores eliminados en user: ".$usuarios_eliminados_user."<br>";
echo "Trabajadores eliminados en profile: ".$usuarios_eliminados_profile."<br>";*/

////////////////////////////////////////////////////////////////////////////////

    
//CONTAR TRABAJADORES EN SIGEFIRRHH///////////////////////////////////////////// 
$query="select count(*) as suma from trabajador where estatus='A'";
$rs = pg_query($postgresql_sigefirrhh,$query);
$row = pg_fetch_array($rs);
echo "<br>Cantidad de trabajadores en Sigefirrhh: ".$row['suma']."<br>";
////////////////////////////////////////////////////////////////////////////////

//CONTAR TRABAJADORES EN TELESUR USER///////////////////////////////////////////// 
$query="select count(*) as suma from sf_guard_user";
$rs = pg_query($postgresql_local,$query);
$row = pg_fetch_array($rs);
echo "<br>Cantidad de trabajadores en Telesur User: ".$row['suma']."<br>";
////////////////////////////////////////////////////////////////////////////////

//CONTAR TRABAJADORES EN TELESUR PROFILE///////////////////////////////////////////// 
$query="select count(*) as suma from sf_guard_user_profile";
$rs = pg_query($postgresql_local,$query);
$row = pg_fetch_array($rs);
echo "<br>Cantidad de trabajadores en Telesur Profile: ".$row['suma']."<br>";
////////////////////////////////////////////////////////////////////////////////

?>
<br><br>


