<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table class="login" id="notif" cellpadding=5 cellspacing=1 width="300px">
   	<tr><td colspan="2" class="titulo">INGRESE USUARIO Y CLAVE</td></tr>
    <?php echo $form ?>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input id="submit" type="submit" class="boton" value="Ingresar" style="width: 120px;"/>
            </td>
        </tr>
  </table> 
  <br>
  <div style="height: 150px;text-align: top;"></div>
</form>

    <input type="hidden" id="usuario" value="<?php echo $_GET['u']?>">
    <!--<input type="hidden" id="clave" value="<?php echo str_replace("qwerty", "#", $_GET['c'])?>">-->

    
<script>
    
        //document.getElementById('signin_username').value=document.getElementById('usuario').value
        /*document.getElementById('signin_password').value=document.getElementById('clave').value*/
        /*alert(document.getElementById('signin_username').value)
       var submitBtn = document.getElementById('submit');
        if(submitBtn){
           submitBtn.click();
        }*/
   
        
        $(document).ready(function () {
            //$('input#signin_username').gips({ 'theme': 'yellow', autoHide: true, placement: 'right' });
            $('table#notif').gips({ 'theme': 'yellow', autoHide: false, placement: 'right' });
            
        });
</script>

<form name="a" action="http://google.com.ve" method="post">
    
</form>