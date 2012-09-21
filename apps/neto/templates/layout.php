<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <link rel="shortcut icon" href="/principal/web/favicon.ico" />
  </head>
  <body>
  	<div align="center">
  		<div class="contenedor">
  			<div class="banner"></div>
  			<div class="menu_menu"><?php include_partial('global/menu')?></div>
                        <div class="borde_menu"></div>
  			<div class="contenido"><?php echo $sf_content ?></div>
  			<div class="pie">
    			La Nueva Televisión del Sur C.A. (TVSUR) TeleSUR © | Todo el contenido de esta página es exclusivo para el uso interno del canal. RIF. G-20004500-0 
    		</div>
    	</div>
    </div>
  </body>
</html>

