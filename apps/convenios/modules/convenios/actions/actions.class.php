<?php

/**
 * convenios actions.
 *
 * @package    principal
 * @subpackage convenios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class conveniosActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	
  public function mysql(){
  
  	$conexion=mysql_connect("192.168.3.14","root","");	
	mysql_select_db("dboperadores",$conexion);

  
  }
  public function executeIndex(sfWebRequest $request)
  {
  	$this->mysql();
	$query="select * from operadores,pais 
			where operadores.id_status='1' 
			and operadores.id_tipo_operador='3' 
			and operadores.id_pais=pais.id_pais 
			
			group by operadores.id_pais order by pais ASC";
	
	$rs=mysql_query($query);	
	
	$cont=0;
	while ($row=mysql_fetch_array($rs)){
		$dat[$cont]=$row;
		$cont++;
	}
	
	$this->datos=$dat;

  }
  
  public function executeOperadorespais(sfWebRequest $request)
  {
  	$id_pais = $this->getRequestParameter('idp'); 
  	
    $this->mysql();
	$query="select count(*) as suma from operadores 
			where id_pais='".$id_pais."' and id_tipo_operador=3 and id_status=1";	
	$rs=mysql_query($query);		
	while ($row=mysql_fetch_array($rs)){$t=$row['suma'];}
	$this->total=$t;
	
	
	
	$query="select * from pais 
			where id_pais='".$id_pais."'";	
	$rs=mysql_query($query);		
	while ($row=mysql_fetch_array($rs)){$np=$row['pais'];}
	$this->nombre_pais=$np;
	
  }
  
    public function executeReporte(sfWebRequest $request)
  {
  		$this->id_pais='';
  		$this->id_operador='';
  		$this->mysql();
  	
  		 if ($request->isMethod('post'))
  		{
  			$this->id_pais = $request->getParameter('pais');
  			$this->id_operador = $request->getParameter('operador');
  			$this->accion = $request->getParameter('accion');
  		}
  }
  
    public function executeGenerareporte(sfWebRequest $request)
  {
  	$this->setLayout("layout_reportes");
  	
  	$id_p = $_GET['p'];
   	$this->id_pais=$id_p;
  	$this->id_o = $_GET['o'];
  		
		 $this->mysql();
		$query="select count(*) as suma from operadores 
				where id_pais='".$id_p."' and id_tipo_operador=3 and id_status=1";	
		$rs=mysql_query($query);		
		while ($row=mysql_fetch_array($rs)){$t=$row['suma'];}
		$this->total=$t;

		
		
		$query="select * from pais 
				where id_pais='".$id_p."'";	
		$rs=mysql_query($query);		
		while ($row=mysql_fetch_array($rs)){$np=$row['pais'];}
		$this->nombre_pais=$np;
  }
}
