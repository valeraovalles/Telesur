<?php     

      $a=new JasperReport;
   
      $a->generar("php-jasper/usuarios.jrxml", array('titulo'=>'USUARIOS TELESUR','ruta'=>$_SERVER['DOCUMENT_ROOT'].image_path("telesur.jpeg")), "pdf", "usuarios");

?>