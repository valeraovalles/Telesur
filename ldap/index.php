<?php include("cambiar.php");?>

<html>
<head>
<title>Cambio de Contraseña</title>
<script src="js/gips.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/gips.css">  
<script>
        $(document).ready(function () {
            $('#notif').gips({ 'theme': 'purple', autoHide: true, text: 'This is purple tooltip, auto hide after pausess time elapses.' });
        });
</script>
<style type="text/css">
    body { font-family: Verdana; font-size: 11px; background-color: #EDEDED; margin-top:0px;padding-top: 0px;}
    th { text-align: right; padding: 0.8em; font-size: 11px; }
    #container { text-align: center; width: 500px; }
    .msg_yes { margin: 0 auto; text-align: center; color: green; background: #E7EEF6; border: 1px solid green; border-radius: 10px; margin: 2px; }
    .msg_no { margin: 0 auto; text-align: center; color: red; background: #E7EEF6; border: 1px solid red; border-radius: 10px; margin: 2px; }
    table{background-color: #E8E8E8;}
    table tr{background-color: white;}
    table th{background-color: #E7EEF6;}
    .contenido{background-color: white; width: 900px;}

    
    
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<div align='center'>
<div class="contenido">
<div class="banner"><img src="imagenes/banner_telesur.jpg"></div>


<div id="container">
    
    <h2>CAMBIO DE CONTRASEÑA</h2>
      
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
      ?></div></div><?php
      } 
?>
              
<form action="<?php print $_SERVER['PHP_SELF']; ?>" name="passwordChange" method="post">
    <table id="notif" style="width: 495px; margin: 0 auto;" cellspacing="1" cellpadding="5px">
        <tr><th>Usuario o Correo:</th><td><input name="username" type="text" size="15px" autocomplete="off" /></td></tr>
        <tr><th>Contraseña actual:</th><td><input name="oldPassword" size="15px" type="password" /></td></tr>
        <tr><th>Nueva contraseña:</th><td><input name="newPassword1" size="15px" type="password" /></td></tr>
        <tr><th>Nueva Contraseña (Confirmación):</th><td><input name="newPassword2" size="15px" type="password" /></td></tr>
        <tr><td colspan="2" style="text-align: center;" >
        <input name="submitted" type="submit" value="Cambiar"/>
        <button onclick="$('frm').action='changepassword.php';$('frm').submit();">Cancelar</button>
        </td></tr>
    </table><br>
</form>
    
    
    <p> Su nueva contraseña debe ser de 8 caracteres o más <br>y tener por lo menos un número. <br/>
    La contraseña actual no puede ser la misma que la contraseña nueva. </ P>
    <br><br>
</div>
</div>
    
</div>    
</body>
</html>

