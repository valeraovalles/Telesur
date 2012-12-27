<?php
function changePassword($user,$oldPassword,$newPassword,$newPasswordCnf){
  global $message;
  global $message_css;
  
  $server = "192.168.3.5";
  $dn = "ou=Personas,dc=telesur";
     
  error_reporting(0);
  
  //conexion al servidor
  ldap_connect($server);
  $con = ldap_connect($server);  
  ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
    
  //buscar datos de un usuario
  $user_search = ldap_search($con,$dn,"(|(uid=$user)(mail=$user))");
  $user_get = ldap_get_entries($con, $user_search);

  //captura el primer registro y se loguea
  $user_entry = ldap_first_entry($con, $user_search);
  $user_dn = ldap_get_dn($con, $user_entry);
  
  //obtengo el usuario
  $user_id = $user_get[0]["uid"][0];

  ///////////////$user_givenName = $user_get[0]["givenName"][0];
 
  $user_search_arry = array( "*", "ou", "uid", "mail", "passwordRetryCount", "passwordhistory" );
  $user_search_filter = "(|(uid=$user_id)(mail=$user))";
  
  /*$user_search_opt = ldap_search($con,$user_dn,$user_search_filter,$user_search_arry);
  $user_get_opt = ldap_get_entries($con, $user_search_opt);
  $passwordRetryCount = $user_get_opt[0]["passwordRetryCount"][0];
  $passwordhistory = $user_get_opt[0]["passwordhistory"][0];*/


  /* VALIDACIÓN */
  /*if ( $passwordRetryCount == 3 ) {
    $message[] = "Su cuenta está bloqueada!!!";
    return false;
  }*/
  

    
  if (ldap_bind($con, $user_dn, $oldPassword) === false) {
    $message[] = "Nombre de usuario o contraseña actual es incorrecto.";
    return false;
  }
  if ($newPassword != $newPasswordCnf ) {
    $message[] = "Sus nuevas contraseñas no coinciden!";
    return false;
  }
  
  //codifico es password nuevo
  $encoded_newPassword = "{SHA}" . base64_encode( pack( "H*", sha1( $newPassword ) ) );
  
  /*$history_arr = ldap_get_values($con,$user_dn,"passwordhistory");
  if ( $history_arr ) {
    $message[] = "Su nueva contraseña coincide con una de las últimas 10 contraseñas que usted utiliza, debe utilizar una nueva contraseña.";
    return false;
  }*/
    
  if (strlen($newPassword) < 8 ) {
    $message[] = "Su contraseña debe tener al menos 8 caracteres.";
    return false;
  }
  if (!preg_match("/[0-9]/",$newPassword)) {
    $message[] = "Su nueva contraseña debe tener al menos un número.";
    return false;
  }
  if (!preg_match("/[a-zA-Z]/",$newPassword)) {
    $message[] = "Su nueva contraseña debe tener al menos una letra.";
    return false;
  }
  if ($newPassword=='12345678') {
    $message[] = "Debe ingresar una contraseña segura.";
    return false;
  }
    if (!strrpos($newPassword,array('*'))) {
    $message[] = "Su nueva contraseña debe tener al menos un caracter .";
    return false;
  }
  /*if (!preg_match("/[A-Z]/",$newPassword)) {
    $message[] = "Error E106 - Your new password must contain at least one uppercase letter.";
    return false;
  }*/
  /*if (!preg_match("/[a-z]/",$newPassword)) {
    $message[] = "Error E107 - Your new password must contain at least one lowercase letter.";
    return false;
  }*/
  if (!$user_get) {
    $message[] = "No se puede conectar al servidor, no puede cambiar su contraseña en este momento.";
    return false;
  }
  
  
  $auth_entry = ldap_first_entry($con, $user_search);
  
  $mail_addresses = ldap_get_values($con, $auth_entry, "mail");
  $given_names = ldap_get_values($con, $auth_entry, "givenName");
  //$password_history = ldap_get_values($con, $auth_entry, "passwordhistory");
  $mail_address = $mail_addresses[0];
  $first_name = $given_names[0];
  

    
  /* CAMBIO DE CONTRASEÑA */
  $entry = array();
  $entry["userPassword"] = "$encoded_newPassword";

  if (ldap_modify($con,$user_dn,$entry) === false){
    $error = ldap_error($con);
    $errno = ldap_errno($con);
    $message[] = "La contraseña no se puede cambiar, por favor póngase en contacto con el administrador.";
    $message[] = "$errno - $error";
  } else {
    $message_css = "yes";
    $message[] = "La contraseña de $user_id cambiado.";
  }
}

?>