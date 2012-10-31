<div class="titulo_modulo">ELIJA LA ACCIÓN QUE DESEA REALIZAR</div>
<script> 
         var seconds = 1; 

        var divid = "contenido"; 
        var url = "/Telesur/web/index.php/ajax/hora?idtk=0";

        window.onload = function(){
                refreshdiv(); // corremos inmediatamente la funcion
        }
</script>
       <div id='contenido' style="font-size:50px; font-family:Georgia; font-style:italic; color:red;"></div>
	<table border="0" width="500px" cellpadding="15px">
		<tr align="center">
                    <td><a href="<?php echo url_for("visitas/form_ingreso")?>"><img src="<?php echo image_path("visitas/access.png")?>" width="80px"><br>REGISTRAR VISITAS</a></td>
                    <td><a href="<?php echo url_for("solicitud/formulariocorrespondencia")?>"><img src="<?php echo image_path("visitas/search.png")?>" width="80px"><br>CONSULTAR VISITAS</a></td>
                        
		</tr>
                
                
                <tr align="center">
                    <td><a href="<?php echo url_for("visitas/registrarsalida")?>"><img src="<?php echo image_path("visitas/salida.png")?>" width="80px"><br>REGISTRAR SALIDA</a></td>
                    <td><a href="<?php echo url_for("usuarios_admin/index")?>"><img src="<?php echo image_path("visitas/trabajador.png")?>" width="80px"><br>LISTADO VISITANTES</a></td>
                    
		</tr>  
                
                 <tr align="center">
                    
                     <td colspan="2" aling="center"><a href="<?php echo url_for("solicitud/formulariocorrespondencia")?>"><img src="<?php echo image_path("visitas/graph.png")?>" width="50px"><br>REPORTES</a></td>                    
		</tr>                   
	</table>
<div class="iconos">
    <a href="/principal/web"><?php echo image_tag('volver.jpg')?>&nbsp;&nbsp;Volver</a>
</div>
