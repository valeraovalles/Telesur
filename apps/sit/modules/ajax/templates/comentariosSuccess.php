<div style="overflow: AUTO;width: 500px; height: 100px;text-align: justify;">
	<?php 
	
		if(!isset($comentarios[0])) echo "No existen comentarios"; 
		else{
			
			$cont=0;
			
			foreach ($comentarios as $c) {
				echo "<span style='background-color:#E7EEF6;'>".ucfirst($comentarios_u[$cont]->getNombre1()).' '.ucfirst($comentarios_u[$cont]->getApellido1()).' ('.$c->getFecha("d/m/Y").' '.$c->getHora("G:i:s").")".': <br>';
				echo $c->getComentario().'</span><br><br>';
			
				$cont++;
			}
		}
	?>
</div>
