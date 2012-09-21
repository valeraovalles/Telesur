<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table class="login" id="notif" cellpadding=5 cellspacing=1 width="300px">
   	<tr><td colspan="2" class="titulo">INGRESE USUARIO Y CLAVE</td></tr>
    <?php echo $form ?>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" class="boton" value="Ingresar" style="width: 120px;"/>
            </td>
        </tr>
  </table> 

<br>
<div style="height: 150px;text-align: top;">

	
	
</div>

</form>

<script>
        $(document).ready(function () {
            //$('input#signin_username').gips({ 'theme': 'yellow', autoHide: true, placement: 'right' });
            $('table#notif').gips({ 'theme': 'yellow', autoHide: false, placement: 'right' });
            
        });
</script>