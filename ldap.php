<?php include("cambiar.php");?>

<html>
<head>
<title>Cambio de COntraseña</title>
<style type="text/css">
    body { font-family: Verdana,Arial,Courier New; font-size: 0.7em; }
    th { text-align: right; padding: 0.8em; }
    #container { text-align: center; width: 500px; margin: 5% auto; }
    .msg_yes { margin: 0 auto; text-align: center; color: green; background: #D4EAD4; border: 1px solid green; border-radius: 10px; margin: 2px; }
    .msg_no { margin: 0 auto; text-align: center; color: red; background: #FFF0F0; border: 1px solid red; border-radius: 10px; margin: 2px; }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
    
<div id="container">
    <h2>CAMBIO DE CONTRASEÑA</h2>
    <p> Su nueva contraseña debe ser de 8 caracteres o más <br>y tener por lo menos un número. <br/>
    La contraseña actual no puede ser la misma que la contraseña nueva. </ P>
</div>
    
<?php
      if (isset($_POST["submitted"])) {
        changePassword($_POST['username'],$_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);
        global $message_css;
        if ($message_css == "yes") {
          ?><div class="msg_yes"><?php
         } else {
          ?><div class="msg_no"><?php
          $message[] = "Su contraseña no puede ser cambiada.";
        }
        foreach ( $message as $one ) { echo "<p>$one</p>"; }
      ?></div><?php
      } 
?>
              
<form action="<?php print $_SERVER['PHP_SELF']; ?>" name="passwordChange" method="post">
<table style="width: 450px; margin: 0 auto;">
<tr><th>Usuario ó Correo:</th><td><input name="username" type="text" size="15px" autocomplete="off" /></td></tr>
<tr><th>Contraseña actual:</th><td><input name="oldPassword" size="15px" type="password" /></td></tr>
<tr><th>Nueva contraseña:</th><td><input name="newPassword1" size="15px" type="password" /></td></tr>
<tr><th>Nueva Contraseña (Confirmación):</th><td><input name="newPassword2" size="15px" type="password" /></td></tr>
<tr><td colspan="2" style="text-align: center;" >
<input name="submitted" type="submit" value="Cambiar contraseña"/>
<button onclick="$('frm').action='changepassword.php';$('frm').submit();">Cancelar</button>
</td></tr>
</table>
</form>
</div>
</body>
</html>