<?php

class Paginacion{

	protected $pagina;
	protected $cantidad_paginas;
	protected $lista;
	
	public function paginar($tabla,$order_by,$c){
  
  		//PAGINA ACTUAL
  	 	if(isset($_GET['pag']))
			$this->pagina=$_GET['pag']; 
		else $this->pagina=1;	
  		
  		//cuento numero de registros
  		$numero_registros = $tabla::doCount($c); //no se puede usar $tabla, da error en el servidor

  		//cantidad de registros a mostrar
  		$imprime=10;
  		
		//CANTIDAD DE VECES QUE PUEDO PAGINAR
	  	$this->cantidad_paginas= ceil($numero_registros/$imprime);
  		
	  	//CALCULA A PARTIR DE QUE CAMPOS AVANZO SEGUN LA PAGINA
	  	$desde=($imprime*$this->pagina)-$imprime;
  		
	  	$c->setLimit($imprime);
		$c->setOffset($desde);
		
		$c->addAscendingOrderByColumn($order_by);
		
		$this->lista = $tabla::doSelect($c);
  }
  
  public function getPagina(){
  	
  	return $this->pagina;
  
  }
  
  public function getCantidadPaginas(){
  	
  	return $this->cantidad_paginas;
  
  }
  
  public function getLista(){
  	
  	return $this->lista;
  
  }
}
